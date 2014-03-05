<?php

namespace backend\widgets;

use Yii;
use yii\base\Widget;

class LeftSide extends Widget
{
    public function run()
    {
        return $this->render('leftSide');
    }
}