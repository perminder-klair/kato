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
    <html class="no-js lt-ie9" lang="<?= Yii::$app->language ?>"> <![endif]-->
    <!--[if gt IE 8]><!-->
    <html class="no-js" lang="<?= Yii::$app->language ?>"> <!--<![endif]-->
    <head>
        <title><?= Html::encode($this->title) ?></title>

        <?php $this->registerTheme(); ?>
        <?php $this->head() ?>

    </head>
    <body class="header-fixed-top">
    <?php $this->beginBody() ?>

    <?= backend\widgets\LeftSide::widget(); ?>
    <?= backend\widgets\RightSide::widget(); ?>
    <?= $content ?>

    <!-- Scroll to top link, check main.js - scrollToTop() -->
    <a href="javascript:void(0)" id="to-top"><i class="fa fa-angle-up"></i></a>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>