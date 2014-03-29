<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
	'id' => 'kato-frontend',
	'basePath' => dirname(__DIR__),
    'preload' => ['log'],
	'controllerNamespace' => 'frontend\controllers',
	'modules' => [
	],
	'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
        ],
        'request'=>[
            'class' => 'kato\components\Request',
            'web'=> '/frontend/web',
            //TODO enable this
            'enableCsrfValidation'=>false,
            'enableCookieValidation'=>true,
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
                '<action>' => 'site/<action>',
                'blog/<id:[0-9]+>/<title>' => 'blog/view',
                'static/<slug>' => 'page/view',
            ]
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@webroot/themes/basic'
                ],
                'baseUrl' => '@web/themes/basic',
                'basePath' => '@web/themes/basic',
            ],
        ],
	],
	'params' => $params,
];
