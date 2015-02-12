<?php

namespace frontend\controllers;

use backend\models\Page;
use yii\web\BadRequestHttpException;
use yii\helpers\HtmlPurifier;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class PageController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['preview'], // Define specific actions
                        'allow' => true, // Has access
                        'roles' => ['admin'], // '@' All logged in users / or your access role e.g. 'admin', 'user'
                    ],
                    [
                        'allow' => false, // Do not have access
                        'roles'=>['?'], // Guests '?'
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays a single Page model.
     * TODO use Yii::$app->request->getQueryParams() instead of $_GET
     * @return string
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionView()
    {
        if (!isset($_GET['slug'])) {
            throw new BadRequestHttpException('Page slug not set.');
        }

        $model = Page::find()
            ->where('slug = :slug', [':slug' => HtmlPurifier::process($_GET['slug'])])
            ->one();

        if (is_null($model)) {
            throw new BadRequestHttpException('Requested Page does not found.');
        }

        return $this->render($model->layout, [
            'model' => $model,
        ]);
    }

    /**
     * Preview single Page
     * Only visible to admin user group
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPreview($id)
    {
        if (($model = Page::findOne($id)) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('@theme/page/' . $model->layout, [
            'model' => $model,
        ]);
    }
}
