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
	'preload' => ['log'],
	'controllerNamespace' => 'backend\controllers',
	'modules' => [
        'markdown' => [
            // the module class
            'class' => 'kartik\markdown\Module',
            // the controller action route used for markdown editor preview
            'previewAction' => '/markdown/parse/preview',
            // the list of custom conversion patterns for post processing
            'customConversion' => [
                '<table>' => '<table class="table table-bordered table-striped">'
            ],
            // whether to use PHP SmartyPantsTypographer to process Markdown output
            'smartyPants' => false
        ],
    ],
	'components' => [
        'kato' => 'kato\components\Kato',
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
                '<action:(login|logout|index)>' => 'site/<action>',
                'post/<id:[0-9]+>' => 'post/view'
            ]
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'view' => [
            'class' => 'backend\components\View',
        ],
        'request'=>[
            //TODO enable this
            'enableCsrfValidation'=>false,
            'enableCookieValidation'=>true,
        ],
	],
	'params' => $params,
];
