<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
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
        <meta charset="<?= Yii::$app->charset ?>"/>
        <title><?= Html::encode($this->title) ?></title>
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?= \Yii::$app->urlManager->baseUrl; ?>/img/favicon.ico">
        <link rel="apple-touch-icon" href="<?= \Yii::$app->urlManager->baseUrl; ?>/img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="<?= \Yii::$app->urlManager->baseUrl; ?>/img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="<?= \Yii::$app->urlManager->baseUrl; ?>/img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="<?= \Yii::$app->urlManager->baseUrl; ?>/img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="<?= \Yii::$app->urlManager->baseUrl; ?>/img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="<?= \Yii::$app->urlManager->baseUrl; ?>/img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="<?= \Yii::$app->urlManager->baseUrl; ?>/img/icon152.png" sizes="152x152">
        <!-- END Icons -->

        <!-- The Open Sans font is included from Google Web Fonts -->
        <link rel="stylesheet"
              href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic">

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