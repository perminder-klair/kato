<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Blog $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="blog-form">

	<?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => 70]) ?>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => 70]) ?>

        <?= $form->field($model, 'short_desc')->textInput(['maxlength' => 160]) ?>

		<?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'content_html')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'create_time')->textInput() ?>

		<?= $form->field($model, 'created_by')->textInput(['maxlength' => 11]) ?>

		<?= $form->field($model, 'update_time')->textInput() ?>

		<?= $form->field($model, 'publish_time')->textInput() ?>

		<?= $form->field($model, 'updated_by')->textInput() ?>

		<?= $form->field($model, 'published_by')->textInput(['maxlength' => 11]) ?>

		<?= $form->field($model, 'is_revision')->textInput() ?>

		<?= $form->field($model, 'parent_id')->textInput() ?>

		<?= $form->field($model, 'status')->textInput() ?>

		<?= $form->field($model, 'deleted')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
