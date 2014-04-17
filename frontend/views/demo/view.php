<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var frontend\models\Demo $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Demos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'tags',
            'create_time',
            'update_time',
            'active',
            'deleted',
        ],
    ]) ?>

</div>
