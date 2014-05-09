<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php')
);

return [
    'id' => 'kato-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
        ],
        'urlManager' => [
            'class' => 'kato\components\UrlManager',
            'adminUrl' => 'api',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'demo'],
            ]
        ],
        'request'=> [
            'class' => 'kato\components\Request',
            'web'=> '/api/web',
            'adminUrl' => '/api',
            //TODO enable this
            'enableCsrfValidation'=>false,
            'enableCookieValidation'=>true,
        ],
    ],
    'params' => $params,
];
