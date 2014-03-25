<?php

namespace common\widgets;

use Yii;

class AdminMenu extends \yii\base\Widget
{
    public $items = [];

    public function run()
    {
        return $this->render('adminMenu', [
            'items' => Yii::$app->params['adminMenu'],
        ]);
    }
}