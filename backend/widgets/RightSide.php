<?php

namespace backend\widgets;

use Yii;
use yii\base\Widget;

class RightSide extends Widget
{
    public function run()
    {
        return $this->render('rightSide');
    }
}