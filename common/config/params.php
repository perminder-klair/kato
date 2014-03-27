<?php

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'maxUploadSize' => 2097152,
    'uploadPath' => dirname(dirname(__DIR__)) . '/frontend/web/files/',
    'mediaTypes' => ['featured', 'other'],
    'adminMenu' => [
        ['controller' => 'demo', 'title' => 'Demo', 'icon' => 'fa fa-bars'],
    ],
];
