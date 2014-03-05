<?php

namespace backend\widgets;

use Yii;
use yii\base\Widget;

class Header extends Widget
{
    public function run()
    {
        return $this->render('header');
    }
}