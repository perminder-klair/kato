<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\Blog $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">

	<h1><?= Html::encode($this->title) ?></h1>

    <?= $model->renderContent() ?>

</div>
