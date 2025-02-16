<?php

declare(strict_types=1);

use App\Enums\DiscussionStatusEnum;
use App\Enums\DiscussionTypeEnum;
use App\Enums\GenderEnum;
use App\Enums\IdentityTypeEnum;
use App\Enums\ResponseEnum;
use App\Enums\UserTypeEnum;
use App\Enums\VerificationCodeEnum;
use Jiannei\Enum\Laravel\Support\Enums\HttpStatusCode;

return [
    GenderEnum::class => [
        GenderEnum::MAN->name     => 'Man',
        GenderEnum::WOMAN->name   => 'Woman',
        GenderEnum::UNKNOWN->name => 'Unknown',
    ],
    IdentityTypeEnum::class => [
        IdentityTypeEnum::NAME->value   => 'Username',
        IdentityTypeEnum::EMAIL->value  => 'Email',
        IdentityTypeEnum::PHONE->value  => 'Phone Number',
        IdentityTypeEnum::GITHUB->value => 'GitHub',
        IdentityTypeEnum::WECHAT->value => 'WeChat',
    ],
    // Response status codes
    ResponseEnum::class => [
        // Standard HTTP status codes
        HttpStatusCode::HTTP_OK->value           => 'Operation successful',
        HttpStatusCode::HTTP_UNAUTHORIZED->value => 'Authorization failed',

        // Business operation successful
        ResponseEnum::SERVICE_REGISTER_SUCCESS->value => 'Registration successful',
        ResponseEnum::SERVICE_LOGIN_SUCCESS->value    => 'Login successful',

        // Business operation failed: authorization business
        ResponseEnum::SERVICE_REGISTER_ERROR->value => 'Registration failed',
        ResponseEnum::SERVICE_LOGIN_ERROR->value    => 'Login failed',

        // Client errors
        ResponseEnum::CLIENT_PARAMETER_ERROR->value => 'Parameter error',
        ResponseEnum::CLIENT_CREATED_ERROR->value   => 'Data already exists',
        ResponseEnum::CLIENT_DELETED_ERROR->value   => 'Data does not exist',

        // Server errors
        ResponseEnum::SYSTEM_ERROR->value              => 'Server error',
        ResponseEnum::SYSTEM_UNAVAILABLE->value        => 'Server is under maintenance and temporarily unavailable',
        ResponseEnum::SYSTEM_CACHE_CONFIG_ERROR->value => 'Cache configuration error',
        ResponseEnum::SYSTEM_CACHE_MISSED_ERROR->value => 'Cache miss',
        ResponseEnum::SYSTEM_CONFIG_ERROR->value       => 'System configuration error',
    ],
    UserTypeEnum::class => [
        UserTypeEnum::ADMINISTRATOR->value       => 'Administrator',
        UserTypeEnum::MODERATOR->value           => 'Moderator',
        UserTypeEnum::SUBSCRIBER->value          => 'Subscriber',
        UserTypeEnum::SUPER_ADMINISTRATOR->value => 'Super Administrator',
    ],
    VerificationCodeEnum::class => [
        VerificationCodeEnum::REGISTER->name        => 'Register',
        VerificationCodeEnum::FORGOT_PASSWORD->name => 'Forgot Password',
    ],
    DiscussionTypeEnum::class => [
        DiscussionTypeEnum::FEED->value => 'Feed',
    ],
    DiscussionStatusEnum::class => [
        DiscussionStatusEnum::PENDING->value => 'Pending',
    ],
];
