<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'kato-backend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'backend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'loginUrl' => ['/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<action:(login|logout|index|settings)>' => 'site/<action>',
            ]
        ],
        'request' => [
            'class' => 'kato\components\Request',
            'web' => '/backend/web',
            'adminUrl' => '/admin',
            //TODO enable this
            'enableCsrfValidation' => false,
            'enableCookieValidation' => true,
        ],
        'view' => [
            'class' => 'kato\web\View',
        ],
    ],
    'params' => $params,
];
