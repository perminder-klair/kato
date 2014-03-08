<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;

/**
 * @var yii\web\View $this
 * @var common\models\Blog $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="block-title">
    <h2>Update Form</h2>
</div>


<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 70]) ?>

    <?= Html::activeLabel($model, 'content') ?>
    <?= kartik\markdown\MarkdownEditor::widget([
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

    <?= $form->field($model, 'publish_time')->widget(DatePicker::classname(), [
        'options' => [
            'placeholder' => 'Select issue date ...',
        ],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ],
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList($model->listStatus()); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

