<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Carbon;
use Jiannei\Enum\Laravel\Support\Traits\EnumEnhance;

enum CacheEnum: string
{
    use EnumEnhance;

    // key => 过期时间计算方法
    // 警告：方法名不能相同
    case AUTHORIZATION_USER = 'authorizationUser'; // 将调用下面定义的 authorizationUser 方法获取缓存过期时间

    // 授权用户信息过期时间定义：将在 Jwt token 过期时一同失效
    // @phpstan-ignore-next-line
    private static function authorizationUser(): float
    {
        $expiration = Carbon::now()->addMinutes((int) config('sanctum.expiration'));

        return Carbon::now()->diffInSeconds($expiration);
    }
}
