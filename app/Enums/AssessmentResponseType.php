<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AssessmentResponseType extends Enum
{
    static $responseType = [
        1 => 'Yes',
        2 => 'No',
        3 => 'Need to Repair',
    ];
}
