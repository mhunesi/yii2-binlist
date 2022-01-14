<?php

namespace mhunesi\binlist\migrations;

use yii\db\Migration;

/**
 * Class m211213_092326_binlist_data
 */
class m211213_092326_binlist_data extends Migration
{
    private const CSV_DELIMITER = ';';
    private const INSERT_ROWS = 10000;
    private const DATA_PATH = __DIR__ . '/data/binlist.csv';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%binlist}}',$this->getFields());

        $this->createIndex(
            'bin_code',
            '{{%binlist}}',
            'bin_code'
        );

        $this->loadFromCsv('{{%binlist}}', array_keys($this->getFields()), self::DATA_PATH);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%binlist}}');
        echo "m211213_092326_binlist_data cannot be reverted.\n";

        return true;
    }

    public function getFields()
    {
        return [
            'id' => $this->primaryKey(),
            'bank_code' => $this->string(10),
            'bank_name' => $this->string(),
            'bin_code' => $this->integer(6)->unsigned(),
            'organization_id' => $this->string(15),
            'class' => $this->string(15),
            'type' => $this->string(6),
            'reward' => $this->string(10),
            'is_business' => $this->boolean()
        ];
    }


    public function loadFromCsv($tableName, $columns, $csvFile, $options = '')
    {
        if (pathinfo($csvFile, PATHINFO_EXTENSION) === 'gz') {
            $csvFile = static::ungzip($csvFile);
        }

        echo '    > load into ' . $tableName . ' from ' . $csvFile . ' ...';
        flush();
        $time = microtime(true);

        try {
            switch ($this->db->driverName) {
                case 'pgsql':
                    $transaction = $this->db->beginTransaction();
                    try {
                        $this->db
                            ->createCommand("COPY $tableName FROM '$csvFile' DELIMITER '" . static::CSV_DELIMITER . "' QUOTE '\"' ESCAPE '\"' CSV")
                            ->execute();
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                    }
                    $transaction->commit();
                    break;
                case 'mssql':
                    $this->db
                        ->createCommand("BULK INSERT $tableName FROM '$csvFile' WITH(FIELDTERMINATOR='" . static::CSV_DELIMITER . "', TABLOCK)")
                        ->execute();
                    break;
                case 'mysql':
                case 'oracle':
                default:
                    $this->db
                        ->createCommand("LOAD DATA INFILE '$csvFile' INTO TABLE $tableName FIELDS TERMINATED BY '" . static::CSV_DELIMITER . "' ENCLOSED BY '\"' ESCAPED BY '\"' " . $options)
                        ->execute();
            }
            echo ' done (time: ' . sprintf('%.3f', microtime(true) - $time) . 's)' . PHP_EOL;
        } catch (\Exception $e) {
            echo PHP_EOL. ' filed: ' . $e->getMessage() . PHP_EOL;
            echo '    > trying batch insert ...' . PHP_EOL;
            flush();

            $csv = fopen($csvFile, 'r');
            do {
                $rows = [];
                for ($i = 1; ($row = fgetcsv($csv, 1024, static::CSV_DELIMITER)) && $i < static::INSERT_ROWS; ++$i) {
                    $row = array_map(function($v){return$v?:null;}, $row);
                    $row[1] === 'bank_code' ?: $rows[] = $row;
                }

                $this->batchInsert($tableName, $columns, $rows);
                echo '    > inserted ' . count($rows) . ' rows' . PHP_EOL;
                flush();
            } while ($row);

            fclose($csv);
        }
    }

    public static function ungzip($file)
    {
        // Remove .gz from the file name
        $outFile = substr($file, 0, -3);

        // Open files in binary mode
        $gz = gzopen($file, 'rb');
        $out = fopen($outFile, 'wb');

        while(!gzeof($gz)) {
            fwrite($out, gzread($gz, 4096));
        }

        fclose($out);
        gzclose($gz);

        return $outFile;
    }
}
