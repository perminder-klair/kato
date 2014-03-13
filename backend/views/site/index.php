<?php
/**
 * @var yii\web\View $this
 */
$this->title = \Yii::$app->kato->setting('site_name');
$this->params['breadcrumbs'][] = $this->title;

use yii\widgets\Breadcrumbs;
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
                        <i class="fa fa-coffee animation-expandUp"></i>Dashboard<br><small>A clean page to help you start!</small>
                    </h1>
                </a>
            </div>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => 'breadcrumb breadcrumb-top'],
                'encodeLabels' => false,
                'homeLink' => ['label' => '<i class="fa fa-coffee"></i>'],
            ]) ?>
            <!-- END Blank Header -->

            <!-- Blank Content -->
            <p>Create your content..</p>

            <?= \kato\DropZone::widget(); ?>

            <!-- END Blank Content -->
        </div>
        <!-- END Page Content -->

        <?= backend\widgets\Footer::widget(); ?>

    </div>
    <!-- END FX Container -->
</div>
<!-- END Page Container -->