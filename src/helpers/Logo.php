<?php

namespace mhunesi\binlist\helpers;

use mhunesi\binlist\assets\BinlistAsset;
use Yii;
use yii\base\BaseObject;

/**
 * (developer comment)
 *
 * @link http://www.mustafaunesi.com.tr/
 * @copyright Copyright (c) 2022 Polimorf IO
 * @product PhpStorm.
 * @author : Mustafa Hayri ÜNEŞİ <mhunesi@gmail.com>
 * @date: 14.01.2022
 * @time: 16:19
 */
class Logo extends BaseObject
{
    /**
     * @param $bankCode
     * @return string
     */
    public static function getBankLogo($bankCode)
    {
        $assetBundle = BinlistAsset::register(Yii::$app->view);

        return $assetBundle->baseUrl . "/images/banklogo/{$bankCode}.svg";
    }

    /**
     * @param $reward
     * @return string
     */
    public static function getRewardLogo($reward)
    {
        $assetBundle = BinlistAsset::register(Yii::$app->view);

        return $assetBundle->baseUrl . "/images/rewardlogo/{$reward}.svg";
    }


}