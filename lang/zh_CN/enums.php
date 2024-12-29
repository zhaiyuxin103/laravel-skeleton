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
        GenderEnum::MAN->name     => '男',
        GenderEnum::WOMAN->name   => '女',
        GenderEnum::UNKNOWN->name => '未知',
    ],
    IdentityTypeEnum::class => [
        IdentityTypeEnum::NAME->value   => '用户名',
        IdentityTypeEnum::EMAIL->value  => '邮箱',
        IdentityTypeEnum::PHONE->value  => '手机号',
        IdentityTypeEnum::GITHUB->value => 'GitHub',
        IdentityTypeEnum::WECHAT->value => '微信',
    ],
    // 响应状态码
    ResponseEnum::class => [
        // 标准 HTTP 状态码
        HttpStatusCode::HTTP_OK->value           => '操作成功',
        HttpStatusCode::HTTP_UNAUTHORIZED->value => '授权失败',

        // 业务操作成功
        ResponseEnum::SERVICE_REGISTER_SUCCESS->value => '注册成功',
        ResponseEnum::SERVICE_LOGIN_SUCCESS->value    => '登录成功',

        // 业务操作失败：授权业务
        ResponseEnum::SERVICE_REGISTER_ERROR->value => '注册失败',
        ResponseEnum::SERVICE_LOGIN_ERROR->value    => '登录失败',

        // 客户端错误
        ResponseEnum::CLIENT_PARAMETER_ERROR->value => '参数错误',
        ResponseEnum::CLIENT_CREATED_ERROR->value   => '数据已存在',
        ResponseEnum::CLIENT_DELETED_ERROR->value   => '数据不存在',

        // 服务端错误
        ResponseEnum::SYSTEM_ERROR->value              => '服务器错误',
        ResponseEnum::SYSTEM_UNAVAILABLE->value        => '服务器正在维护，暂不可用',
        ResponseEnum::SYSTEM_CACHE_CONFIG_ERROR->value => '缓存配置错误',
        ResponseEnum::SYSTEM_CACHE_MISSED_ERROR->value => '缓存未命中',
        ResponseEnum::SYSTEM_CONFIG_ERROR->value       => '系统配置错误',
    ],
    UserTypeEnum::class => [
        UserTypeEnum::ADMINISTRATOR->value       => '管理员',
        UserTypeEnum::MODERATOR->value           => '版主',
        UserTypeEnum::SUBSCRIBER->value          => '订阅者',
        UserTypeEnum::SUPER_ADMINISTRATOR->value => '超级管理员',
    ],
    VerificationCodeEnum::class => [
        VerificationCodeEnum::REGISTER->name => '注册',
    ],
    DiscussionStatusEnum::class => [
        DiscussionStatusEnum::PENDING->name => '待审核',
    ],
    DiscussionTypeEnum::class => [
        DiscussionTypeEnum::FEED->name => '动态',
    ],
];
