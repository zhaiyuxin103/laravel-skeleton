<?php

declare(strict_types=1);

namespace App\Enums;

use Jiannei\Enum\Laravel\Support\Traits\EnumEnhance;

enum DiscussionStatusEnum: string
{
    use EnumEnhance;

    case PENDING = 'pending';
}
