<?php
use yii\helpers\Html;
?>
<a class="pull-left" href="#">
    <img class="media-object" src="http://placehold.it/64x64" alt="...">
</a>
<div class="media-body">
    <h4 class="media-heading"><?= Html::a(Html::encode($model->title), $model->permalink); ?></h4>
    <p><?= Html::encode($model->short_desc); ?></p>
</div>