<?php

namespace mhunesi\binlist\models;

/**
 * This is the ActiveQuery class for [[Binlist]].
 *
 * @see Binlist
 */
class BinlistQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Binlist[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Binlist|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $binCode
     * @return Binlist|array|null
     */
    public function bin($binCode)
    {
        return $this->andWhere(['bin_code' => $binCode])->one();
    }
}
