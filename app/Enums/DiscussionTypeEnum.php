<?php

declare(strict_types=1);

namespace App\Enums;

use Jiannei\Enum\Laravel\Support\Traits\EnumEnhance;

enum DiscussionTypeEnum: string
{
    use EnumEnhance;

    case FEED = 'feed';
}
