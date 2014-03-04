<?php

namespace backend\widgets;

use Yii;
use yii\base\Widget;

class Footer extends Widget
{
    public function run()
    {
        return $this->render('footer');
    }
}