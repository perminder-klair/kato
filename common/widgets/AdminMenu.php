<?php

namespace common\widgets;

class AdminMenu extends \yii\base\Widget
{
    public function run()
    {
        return $this->render('adminMenu');
    }
}