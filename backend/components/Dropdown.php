<?php

namespace backend\components;

use yii\helpers\Html;

class Dropdown extends \yii\bootstrap\Dropdown
{
    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        //parent::init();

        Html::addCssClass($this->options, 'nav nav-second-level collapse');
        $this->_containerOptions = $this->options;
    }
}