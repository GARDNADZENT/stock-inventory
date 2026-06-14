<?php

return [
    'default' => env('MAIL_MAILER', 'log'),
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'onboarding@resend.dev'),
        'name' => env('MAIL_FROM_NAME', 'Maasai Shop'),
    ],
];
