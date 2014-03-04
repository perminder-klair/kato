<?php

namespace frontend\controllers;

use yii\web\Controller;
use backend\models\Page;

class PageController extends Controller
{
    /**
     * Displays a single Page model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {
        if (!$_GET['slug']) {
            //throw error
        }
        $model = Page::find()
            ->where(['slug' => $_GET['slug']])
            ->one();

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}