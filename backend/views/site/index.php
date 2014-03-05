<?php
/**
 * @var yii\web\View $this
 */
$this->title = kato\helpers\KatoHtml::setting('site_name');
$this->params['breadcrumbs'][] = $this->title;

use yii\widgets\Breadcrumbs;
?>
<div id="page-container">

    <?= backend\widgets\Header::widget(); ?>

    <!-- FX Container -->
    <!-- In the PHP version you can set the following options from the config file -->
    <!--
        All effects apply in resolutions larger than 1200px width
        Add one of the following classes to #fx-container for setting an effect to main content when one of the sidebars are opened
        'fx-none'           remove all effects (better website performance)
        'fx-opacity'        opacity effect
        'fx-move'           move effect
        'fx-push'           push effect
        'fx-rotate'         rotate effect
        'fx-push-move'      push-move effect
        'fx-push-rotate'    push-rotate effect
    -->
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
            <!-- END Blank Content -->
        </div>
        <!-- END Page Content -->

        <?= backend\widgets\Footer::widget(); ?>

    </div>
    <!-- END FX Container -->
</div>
<!-- END Page Container -->