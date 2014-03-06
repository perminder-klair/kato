<?php

namespace backend\components;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn
{
    public $template = '{update} {delete}';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->buttons['update'] = function ($url, $model) {
            return Html::a('<i class="halfling-pencil"></i>', $url, [
                'title' => Yii::t('yii', 'Update'),
                'data-pjax' => '0',
            ]);
        };
        $this->buttons['delete'] = function ($url, $model) {
            return Html::a('<i class="halfling-trash"></i>', $url, [
                'title' => Yii::t('yii', 'Delete'),
                'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                'data-method' => 'post',
                'data-pjax' => '0',
            ]);
        };
    }
}