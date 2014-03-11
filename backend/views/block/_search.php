<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\search\BlockSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="block-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'title') ?>

		<?= $form->field($model, 'slug') ?>

		<?= $form->field($model, 'content') ?>

		<?= $form->field($model, 'content_html') ?>

		<?php // echo $form->field($model, 'create_time') ?>

		<?php // echo $form->field($model, 'created_by') ?>

		<?php // echo $form->field($model, 'update_time') ?>

		<?php // echo $form->field($model, 'updated_by') ?>

		<?php // echo $form->field($model, 'parent') ?>

		<?php // echo $form->field($model, 'listing_order') ?>

		<?php // echo $form->field($model, 'status') ?>

		<?php // echo $form->field($model, 'deleted') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
