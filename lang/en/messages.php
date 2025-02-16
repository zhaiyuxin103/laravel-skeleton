<?php

declare(strict_types=1);

return [
    'failed' => [
        'verification_code_issued'        => 'Failed to issue verification code.',
        'verification_key_enum_not_match' => 'Verification key enum does not match.',
        'verification_code_expired'       => 'Verification code expired.',
        'verification_code_not_match'     => 'Verification code does not match.',
        'register'                        => 'Failed to register.',
        'current_password_not_match'      => 'Current password does not match.',
        'password_same_current_password'  => 'New password is the same as the current password.',
    ],
    'success' => [
        'verification_code_issued' => 'Verification code issued successfully.',
        'register'                 => 'Register successfully.',
        'auth'                     => 'Login successfully.',
        'fetch'                    => 'Data fetch successfully.',
        'created'                  => 'Created successfully.',
        'updated'                  => 'Updated successfully.',
    ],
];
