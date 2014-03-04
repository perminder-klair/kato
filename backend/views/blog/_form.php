<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\markdown\MarkdownEditor;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;

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

        <?= $form->field($model, 'tags')->widget(Select2::classname(), [
            'language' => 'en',
            'options' => [
                'multiple' => true,
                'placeholder' => 'Select a state ...'
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'tags' => ["red", "green", "blue"],
            ],
        ]); ?>

        <?= '<label>Publist Date</label>'; ?>
        <?= DatePicker::widget([
            'name' => 'publish_time',
            'value' => date('d-M-Y', strtotime('+2 days')),
            'options' => ['placeholder' => 'Select issue date ...'],
            'pluginOptions' => [
                'format' => 'dd-M-yyyy',
                'todayHighlight' => true
            ]
        ]);; ?>

        <?= $form->field($model, 'status')->dropDownList($model->listStatus()); ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
