<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Page;

/**
 * @var backend\components\View $this
 * @var backend\models\Page $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

$this->params['block'] = [
    'id' => $model->id,
    'layout' => $model->layout,
];
?>
<div class="page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->loadBlock('details'); ?>
    <?= $this->loadBlock('demo-text'); ?>
    <?= $this->loadBlock('sir-trevor'); ?>
</div>
