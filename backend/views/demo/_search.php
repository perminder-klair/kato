<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\search\DemoSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="demo-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'title') ?>

		<?= $form->field($model, 'create_time') ?>

		<?= $form->field($model, 'update_time') ?>

		<?= $form->field($model, 'listing_order') ?>

		<?php // echo $form->field($model, 'active') ?>

		<?php // echo $form->field($model, 'deleted') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
