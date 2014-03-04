<?php
/**
 * @var yii\web\View $this
 */
$this->title = 'Kato';
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
                        <i class="glyphicon-brush animation-expandUp"></i>Blank<br><small>A clean page to help you start!</small>
                    </h1>
                </a>
            </div>
            <ul class="breadcrumb breadcrumb-top">
                <li><i class="fa fa-file-o"></i></li>
                <li>Pages</li>
                <li><a href="">Blank</a></li>
            </ul>
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