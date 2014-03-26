<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Tag;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use kartik\markdown\MarkdownEditor;
use kartik\widgets\SwitchInput;

$tag = new Tag;

/**
 * @var yii\web\View $this
 * @var frontend\models\Demo $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="block-title">
    <ul class="nav nav-tabs" data-toggle="tabs">
        <li class="active"><a href="#form">Form</a></li>
        <li class=""><a href="#media">Media</a></li>
    </ul>
</div>

<div class="tab-content">

    <div class="tab-pane active demo-form" id="form">

        <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->widget(MarkdownEditor::classname()) ?>

    <?= $form->field($model, 'tags')->widget(Select2::classname(), [
            'language' => 'en',
            'options' => [
                'multiple' => true,
                'placeholder' => 'Select a tag ...'
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'tags' => $tag->listTags($model->className()),
            ],
        ]) ?>

    <?= $form->field($model, 'create_time')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder' => 'Select date ...',
                ],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ],
            ]) ?>

    <?= $form->field($model, 'update_time')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder' => 'Select date ...',
                ],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ],
            ]) ?>

    <?= $form->field($model, 'active')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                    'size' => 'small'
                ],
            ]) ?>

    <?= $form->field($model, 'deleted')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                    'size' => 'small'
                ],
            ]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <div class="tab-pane" id="media">

        media here

    </div>

</div>
