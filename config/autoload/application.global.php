<?php

return [
    'logging' => [
        'enabled' => true
    ],
    'emailCredentials' => [
        'from' => getenv('EMAIL_FROM'),
        'subjectPrefix' => getenv('EMAIL_SUBJECT_PREFIX'),
        'smtp' =>[
            'name'              => getenv('EMAIL_SMTP_NAME'),
            'host'              => getenv('EMAIL_SMTP_HOST'),
            'port'              => getenv('EMAIL_SMTP_PORT'),
            'connection_class'  => getenv('EMAIL_SMTP_CLASS'),
            'connection_config' => [
                'username' => getenv('EMAIL_SMTP_USERNAME'),
                'password' => getenv('EMAIL_SMTP_PASSWORD'),
                'ssl'      => getenv('EMAIL_SMTP_SSL'),
            ]
        ]
    ],
    'smsCredentials' => [
        'url' => getenv('SMS_URL'),
        'token' => getenv('SMS_TOKEN'),
        'from' => getenv('SMS_FROM'),
    ],
    'allowedOrigins' => json_decode(getenv('ALLOWED_ORIGINS'), true),
    'keycloak' => [
        'algorithm' => getenv('KK_ALGORITHM'),
        'publicKey' => "-----BEGIN PUBLIC KEY-----\n" . getenv('KK_PUBLIC_KEY') . "\n-----END PUBLIC KEY-----\n",
        'leeway' => getenv('KK_LEEWAY'),
    ]
];
