<?php

declare(strict_types=1);

return [
    'subject' => [
        'register'        => 'Register Authentication Code',
        'forgot_password' => 'Forgot Password Authentication Code',
    ],
    'content' => [
        'register' => '
            ━━━━━━━━━━━━━━━━━<br>
            Authentication code notification<br>
            ━━━━━━━━━━━━━━━━━<br><br>
            You will be provided with a verification code.<br><br>
            Code：:code<br><br>
            Please enter this authentication code into the user registration screen and complete your user registration within :timeout minutes.<br>
        <br>',
        'forgot_password' => '
            ━━━━━━━━━━━━━━━━━<br>
            Authentication code notification<br>
            ━━━━━━━━━━━━━━━━━<br><br>
            You will be provided with a verification code.<br><br>
            Code：:code<br><br>
            Please enter this authentication code into the password reset screen and reset your password within :timeout minutes.<br>',
    ],
    'footer' => '
        <br>
        ＊This email is sent automatically from the system. Please note that we will not be able to respond to any replies you may send.<br>
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
        :name<br>
        URL：<a href=":uri">:uri</a><br>
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>',
];
