<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<title><?= Html::encode($this->title) ?></title>

    <?= Html::csrfMetaTags() ?>
	<?php $this->head() ?>
</head>
<body>
	<?php $this->beginBody() ?>
	<?php
		NavBar::begin([
			'brandLabel' => \Yii::$app->kato->setting('site_name'),
			'brandUrl' => Yii::$app->homeUrl,
			'options' => [
				'class' => 'navbar-inverse navbar-fixed-top',
			],
		]);
        $items = \Yii::$app->kato->menuItems();
        if (Yii::$app->user->isGuest) {
            $items[] = ['label' => 'Signup', 'url' => ['/account/signup']];
            $items[] = ['label' => 'Login', 'url' => ['/account/login']];
        } else {
            $items[] = ['label' => 'Account', 'url' => ['/account/index']];
            $items[] = [
                'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/account/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }

    echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => $items,
		]);
		NavBar::end();
	?>

	<div class="container">
	<?= Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
	<?= Alert::widget() ?>
	<?= $content ?>
	</div>

	<footer class="footer">
		<div class="container">
		<p class="pull-left">&copy; <?= \Yii::$app->kato->setting('site_name'); ?> <?= date('Y') ?></p>
		<p class="pull-right">Powered by Kato</p>
		</div>
	</footer>

	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
