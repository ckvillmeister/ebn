<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CircuitStyle extends Enum
{
    static $circuits = [
        1 => 'Conventional',
        2 => 'Hybrid',
        3 => 'Addressable',
        4 => 'Semi-addressable'
    ];
}
