<?php

namespace frontend\controllers;

use kato\KatoController;
use backend\models\Page;
use yii\web\BadRequestHttpException;

class PageController extends KatoController
{
    /**
     * Displays a single Page model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {
        if (!isset($_GET['slug'])) {
            throw new BadRequestHttpException('Page slug not set.');
        }
        $model = Page::find()
            ->where(['slug' => $_GET['slug']])
            ->one();

        if (!$model) {
            throw new BadRequestHttpException('Page not found!');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}