<?php
$rootDir = __DIR__ . '/../..';

$params = array_merge(
	require($rootDir . '/common/config/params.php'),
	require($rootDir . '/common/config/params-local.php'),
	require(__DIR__ . '/params.php'),
	require(__DIR__ . '/params-local.php')
);

return [
	'id' => 'kato-frontend',
	'basePath' => dirname(__DIR__),
	'vendorPath' => $rootDir . '/vendor',
	'controllerNamespace' => 'frontend\controllers',
	'modules' => [
	],
	'extensions' => require($rootDir . '/vendor/yiisoft/extensions.php'),
	'components' => [
        'kato' => 'kato\components\Kato',
		'db' => $params['components.db'],
		'cache' => $params['components.cache'],
		'mail' => $params['components.mail'],
		'user' => [
			'identityClass' => 'common\models\User',
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
        'urlManager' => [
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
            ],
        ],
	],
	'params' => $params,
];
