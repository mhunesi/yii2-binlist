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

class Reward extends BaseEnum
{
    public const BONUS = 'bonus';

    public const WORLD = 'world';

    public const AXESS = 'axess';

    public const MAXIMUM = 'maximum';

    public const BANKKART = 'bankkart';

    public const PARAF = 'paraf';

    public const ADVANTAGE = 'advantage';

    public static $list = [
        self::BONUS => 'Bonus',
        self::WORLD => 'World',
        self::AXESS => 'Axess',
        self::MAXIMUM => 'Maximum',
        self::BANKKART => 'Bankkart',
        self::PARAF => 'Paraf',
        self::ADVANTAGE => 'Advantage',
    ];
}