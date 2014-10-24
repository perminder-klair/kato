<?php

namespace backend\widgets;

use Yii;
use yii\base\Widget;

class Media extends Widget
{
    public $model;

    public function init()
    {
        parent::init();

        Yii::setAlias('@mediaAsset', dirname(__FILE__));
        $this->registerAsset();
    }

    public function run()
    {
        return $this->render('media', [
            'model' => $this->model,
        ]);
    }

    protected function registerAsset()
    {
        $view = $this->getView();
        MediaAsset::register($view);
    }
}