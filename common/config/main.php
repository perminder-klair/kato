<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
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
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'view' => [
            'class' => 'backend\components\View',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
            'itemTable' => 'kato_auth_item',
            'itemChildTable' => 'kato_auth_item_child',
            'assignmentTable' => 'kato_auth_assignment',
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
    ],
];