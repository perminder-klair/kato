<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\Block $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="block-form">

	<?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => 70]) ?>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => 70]) ?>

        <?= Html::activeLabel($model, 'content') ?>
        <?= kartik\markdown\MarkdownEditor::widget([
            'model' => $model,
            'attribute' => 'content',
        ]); ?>

        <?= $form->field($model, 'status')->dropDownList($model->listStatus()); ?>

        <?= $form->field($model, 'parent')->dropDownList($model->listParents(), ['prompt'=>'No Parent']); ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
