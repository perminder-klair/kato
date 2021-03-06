<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/**
 * @var kato\web\View $this
 * @var yii\bootstrap\ActiveForm $form
 * @var frontend\models\ContactForm $model
 */
$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
$this->params['block'] = [
    'slug' => 'contact',
];
?>
<div class="site-contact">
	<h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->loadBlock('details'); ?>

	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
				<?= $form->field($model, 'name') ?>
				<?= $form->field($model, 'email') ?>
				<?= $form->field($model, 'subject') ?>
				<?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
				<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
					'options' => ['class' => 'form-control'],
					'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
				]) ?>
				<div class="form-group">
					<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
				</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>

</div>
