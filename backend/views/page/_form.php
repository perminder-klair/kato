<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\Page $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="block-title">
    <h2>Update Form</h2>
</div>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 70]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => 70]) ?>

    <?= Html::activeLabel($model, 'content') ?>
    <?= kartik\markdown\MarkdownEditor::widget([
        'model' => $model,
        'attribute' => 'content',
    ]); ?>

    <?= $form->field($model, 'parent_id')->dropDownList($model->listParents(), ['prompt'=>'Select Parent']); ?>

    <?= $form->field($model, 'status')->dropDownList($model->listStatus()); ?>

    <?= $form->field($model, 'layout')->dropDownList($model->listLayouts()); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>