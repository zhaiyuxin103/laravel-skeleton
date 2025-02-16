<?php

declare(strict_types=1);

namespace App\Enums;

use Jiannei\Enum\Laravel\Support\Traits\EnumEnhance;

enum VerificationCodeEnum: string
{
    use EnumEnhance;

    case REGISTER        = 'register';
    case FORGOT_PASSWORD = 'forgot_password';
}
