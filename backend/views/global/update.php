<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/**
 * @var yii\web\View $this
 * @var backend\models\Blog $model
 * @var $meta
 */

$this->description = $meta['description'];
$this->pageIcon = $meta['pageIcon'];
$this->title = 'Update ' . $meta['title'] . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => $meta['title'], 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div id="page-container">

    <?= backend\widgets\Header::widget(); ?>

    <div id="fx-container" class="fx-opacity">
        <!-- Page content -->
        <div id="page-content" class="block">
            <!-- Blank Header -->
            <div class="block-header">
                <!-- If you do not want a link in the header, instead of .header-title-link you can use a div with the class .header-section -->
                <a href="" class="header-title-link">
                    <h1>
                        <i class="<?= Html::encode($this->pageIcon) ?> animation-expandUp"></i><?= Html::encode($this->title) ?><br>
                        <small><?= Html::encode($this->description) ?></small>
                    </h1>
                </a>
            </div>
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => 'breadcrumb breadcrumb-top'],
                'encodeLabels' => false,
                'homeLink' => ['label' => '<i class="' . Html::encode($this->pageIcon) . '"></i>'],
            ]) ?>
            <!-- END Blank Header -->

            <!-- Blank Content -->
            <div class="block block-tabs full">

                <?php echo $this->render('_form', [
                    'model' => $model,
                ]); ?>

            </div>
            <!-- END Blank Content -->
        </div>
        <!-- END Page Content -->

        <?= backend\widgets\Footer::widget(); ?>

    </div>
    <!-- END FX Container -->
</div>
<!-- END Page Container -->