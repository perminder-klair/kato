<?php

namespace api\controllers;

use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\rest\ActiveController;

class DemoController extends ActiveController
{
    public $modelClass = 'frontend\models\Demo';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'contentNegotiator' => [
                'formats' => [
                    'application/xml' => Response::FORMAT_JSON,
                ],
            ],
            /*'authenticator' => [
                'class' => QueryParamAuth::className(),
            ],*/
        ]);
    }

    public function actions()
    {
        $actions = parent::actions();

        // disable the "delete" and "create" actions
        //unset($actions['delete'], $actions['create'], $actions['update']);

        return $actions;
    }
}