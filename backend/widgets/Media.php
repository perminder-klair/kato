<?php

namespace backend\widgets;

use Yii;
use yii\base\Widget;

class Media extends Widget
{
    public $model;

    public function run()
    {
        return $this->render('media', [
            'model' => $this->model,
        ]);
    }
}