<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BidDocAttachmentTypes extends Enum
{
    static $attachmentTypes = [
        1 => 'Notice to Proceed',
        2 => 'Notice of Awards',
        3 => 'Notice to Bidders',
        4 => 'Certificate from Project Proponent'
    ];
}
