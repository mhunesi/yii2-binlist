<?php
/**
 * (developer comment)
 *
 * @link http://www.mustafaunesi.com.tr/
 * @copyright Copyright (c) 2022 Polimorf IO
 * @product PhpStorm.
 * @author : Mustafa Hayri ÜNEŞİ <mhunesi@gmail.com>
 * @date: 14.01.2022
 * @time: 14:39
 */

namespace mhunesi\binlist\enums;

class Type extends BaseEnum
{
    public const CREDIT_CARD = 'credit';

    public const DEBIT_CARD = 'debit';

    public static $list = [
        self::CREDIT_CARD => 'Credit Card',
        self::DEBIT_CARD => 'Debit Card',
    ];
}