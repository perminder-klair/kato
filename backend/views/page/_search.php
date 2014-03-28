<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\search\PageSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="page-search">

	<?php $form = ActiveForm::begin([
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'title') ?>

		<?= $form->field($model, 'short_desc') ?>

		<?= $form->field($model, 'slug') ?>

		<?php // echo $form->field($model, 'create_time') ?>

		<?php // echo $form->field($model, 'created_by') ?>

		<?php // echo $form->field($model, 'update_time') ?>

		<?php // echo $form->field($model, 'updated_by') ?>

		<?php // echo $form->field($model, 'level') ?>

		<?php // echo $form->field($model, 'layout') ?>

		<?php // echo $form->field($model, 'parent_id') ?>

		<?php // echo $form->field($model, 'type') ?>

		<?php // echo $form->field($model, 'status')->checkbox() ?>

		<?php // echo $form->field($model, 'deleted')->checkbox() ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
