<?php

namespace frontend\controllers;

use backend\models\Page;
use yii\web\BadRequestHttpException;
use yii\helpers\HtmlPurifier;

class PageController extends \yii\web\Controller
{
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

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}