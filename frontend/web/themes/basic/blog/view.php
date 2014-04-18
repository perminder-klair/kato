<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/**
 * @var yii\web\View $this
 * @var common\models\Blog $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">

	<h1><?= Html::encode($this->title) ?></h1>

    <?= HtmlPurifier::process($model->content_html) ?>

</div>
