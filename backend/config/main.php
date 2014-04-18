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
        ],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
        'urlManager' => [
            'class' => 'kato\components\UrlManager',
            'adminUrl' => 'admin',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<action:(login|logout|index|settings)>' => 'site/<action>',
                'post/<id:[0-9]+>' => 'post/view'
            ]
        ],
        'request'=>[
            'class' => 'kato\components\Request',
            'web'=> '/backend/web',
            'adminUrl' => '/admin',
            //TODO enable this
            'enableCsrfValidation'=>false,
            'enableCookieValidation'=>true,
        ],
	],
	'params' => $params,
];
