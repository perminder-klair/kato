<?php
use yii\helpers\Html;
?>
<a class="pull-left" href="#">
    <img class="media-object" src="http://placehold.it/64x64" alt="...">
</a>
<div class="media-body">
    <?php if (isset($model->media[0])): $media = $model->media[0]; ?>
        <img src="<?= $media->render(); ?>" alt="dummy">
    <?php endif; ?>
    <h4 class="media-heading"><?= Html::a(Html::encode($model->title), $model->permalink); ?></h4>
    <ul>
        <li><?= Html::encode(date('jS M Y', strtotime($model->create_time)));?></li>
    </ul>
    <p><?= Html::encode($model->short_desc); ?></p>
</div>