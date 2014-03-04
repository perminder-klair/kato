<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\markdown\MarkdownEditor;

/**
 * @var yii\web\View $this
 * @var common\models\Blog $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="blog-form">

	<?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => 70]) ?>

		<?= MarkdownEditor::widget([
            'model' => $model,
            'attribute' => 'content',
        ]); ?>

		<?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'publish_time')->textInput() ?>

		<?= $form->field($model, 'parent_id')->textInput() ?>

		<?= $form->field($model, 'status')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
