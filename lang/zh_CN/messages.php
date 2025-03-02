<?php

declare(strict_types=1);

return [
    'failed' => [
        'verification_code_issued'        => '验证码发放失败。',
        'verification_key_enum_not_match' => '验证码键枚举不匹配。',
        'verification_code_expired'       => '验证码已过期。',
        'verification_code_not_match'     => '验证码不匹配。',
        'register'                        => '注册失败。',
        'current_password_not_match'      => '当前密码不匹配。',
        'password_same_current_password'  => '新密码与当前密码相同。',
        'reset_password'                  => '重置密码失败。',
        'uploaded'                        => '文件上传失败。',
    ],
    'success' => [
        'verification_code_issued' => '验证码发放成功。',
        'register'                 => '注册成功。',
        'auth'                     => '登录成功。',
        'fetch'                    => '数据获取成功。',
        'created'                  => '创建成功。',
        'updated'                  => '更新成功。',
        'reset_password'           => '密码重置成功。',
        'uploaded'                 => '上传成功。',
    ],
];
