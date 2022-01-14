<?php

namespace mhunesi\binlist\models;

use mhunesi\binlist\enums\Type;
use Yii;

/**
 * This is the model class for table "binlist".
 *
 * @property int $id
 * @property string|null $bank_code
 * @property string|null $bank_name
 * @property int|null $bin_code
 * @property string|null $organization_id
 * @property string|null $class
 * @property string|null $type
 * @property string|null $reward
 * @property int|null $is_business
 */
class Binlist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'binlist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bin_code', 'is_business'], 'integer'],
            [['bank_code', 'reward'], 'string', 'max' => 10],
            [['bank_name'], 'string', 'max' => 255],
            [['organization_id', 'class'], 'string', 'max' => 15],
            [['type'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bank_code' => 'Bank Code',
            'bank_name' => 'Bank Name',
            'bin_code' => 'Bin Code',
            'organization_id' => 'Organization ID',
            'class' => 'Class',
            'type' => 'Type',
            'reward' => 'Reward',
            'is_business' => 'Is Business',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BinlistQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BinlistQuery(get_called_class());
    }

    /**
     * @return bool
     */
    public function isCreditCard()
    {
        return $this->type === Type::CREDIT_CARD;
    }

    /**
     * @return bool
     */
    public function isDebitCard()
    {
        return $this->type === Type::DEBIT_CARD;
    }
}
