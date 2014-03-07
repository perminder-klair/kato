<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\Demo $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="demo-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'create_time')->textInput() ?>

		<?= $form->field($model, 'update_time')->textInput() ?>

		<?= $form->field($model, 'listing_order')->textInput() ?>

		<?= $form->field($model, 'active')->textInput() ?>

		<?= $form->field($model, 'deleted')->textInput() ?>

		<?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
