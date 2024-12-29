<?php

declare(strict_types=1);

return [
    'failed' => [
        'verification_code_issued'        => '認証コードの発行に失敗しました。',
        'verification_key_enum_not_match' => '認証キーが正しくありません。',
        'verification_code_expired'       => '認証コードの有効期限が切れました。',
        'verification_code_not_match'     => '認証コードが正しくありません。',
        'register'                        => 'ユーザー登録に失敗しました。',
    ],
    'success' => [
        'verification_code_issued' => '認証コードを発行しました。',
        'register'                 => 'ユーザー登録に成功しました。',
        'auth'                     => 'ログインに成功しました。',
        'fetch'                    => 'データ取得に成功しました。',
        'created'                  => '作成に成功しました。',
    ],
];
