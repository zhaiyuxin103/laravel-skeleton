<?php

declare(strict_types=1);

return [
    /*
     * 接口频率限制
     */
    'rate_limits' => [
        // 访问频率限制，次数/分钟
        'access' => env('API_RATE_LIMITS', '60,1'),
        // 登录相关，次数/分钟
        'sign' => env('API_SIGN_RATE_LIMITS', '10,1'),
    ],
    'domain' => env('API_DOMAIN', ''),

    'prefix' => env('API_PREFIX', 'api'),
];
