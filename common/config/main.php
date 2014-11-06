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
        'assetManager' => [
            'linkAssets' => true,
        ],
        'kato' => [
            'class' => 'kato\components\Kato',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'view' => [
            'class' => 'backend\components\View',
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/basic'
                ],
                'baseUrl' => '@web/themes/basic',
                'basePath' => '@web/themes/basic',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'], //'admin', 'user'
            'itemTable' => 'kato_auth_item',
            'itemChildTable' => 'kato_auth_item_child',
            'assignmentTable' => 'kato_auth_assignment',
            'ruleTable' => 'kato_auth_rule',
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