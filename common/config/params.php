<?php

/**
 * Usage: Yii::$app->params['uploadPath'];
 */
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'maxUploadSize' => 2097152,
    'uploadPath' => dirname(dirname(__DIR__)) . '/files/',
    'mediaTypes' => ['featured', 'other'],
    'createRevisions' => false,
    'acceptedUploadTypes' => [
        'image/gif',
        'image/jpeg',
        'image/png',
        'application/pdf',
    ],
    'adminMenu' => [
        ['controller' => 'demo', 'title' => 'Demo', 'icon' => 'fa fa-bars'],
    ],
];
