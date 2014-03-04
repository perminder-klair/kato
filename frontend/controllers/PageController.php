<?php

namespace frontend\controllers;

use common\kato\KatoController;
use backend\models\Page;

class PageController extends KatoController
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