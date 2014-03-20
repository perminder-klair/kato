<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/**
 * @var \backend\components\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <!--[if IE 8]>
    <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!-->
    <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title><?= Html::encode($this->title) ?></title>

        <?php $this->registerTheme(); ?>
        <?php $this->head() ?>
    </head>

    <!-- Body -->
    <body>
    <?php $this->beginBody() ?>
    <!-- Header -->
    <header class="navbar navbar-default navbar-fixed-top">
        <!-- Header Brand -->
        <a href="page_special_login.html" class="navbar-brand">
            <img src="img/template/drop.png" alt="FreshUI">
            <span>Kato</span>
        </a>
        <!-- END Header Brand -->
    </header>
    <!-- END Header -->

    <?= $content ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>