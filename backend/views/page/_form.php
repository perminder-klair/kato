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
    <ul class="nav nav-tabs" data-toggle="tabs">
        <li class="active"><a href="#form">Home</a></li>
        <li class=""><a href="#media">Media</a></li>
    </ul>
</div>

<div class="tab-content">

    <div class="tab-pane active" id="form">

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

    </div>

    <div class="tab-pane" id="media">

        <?= \kato\DropZone::widget([
            'options' => [
                'url' => \Yii::$app->urlManager->createUrl(['site/upload', 'content_id' => $model->id, 'media_type' => $model->className()]),
                'addRemoveLinks' => true,
                'maxFilesize' => kato\helpers\KatoBase::formatBytes(Yii::$app->params['maxUploadSize'], 'MB', '0', true),
            ],
            'clientEvents' => [
                'success' => "function(file, responseText){console.log(responseText)}",
            ]
        ]); ?>

    </div>

</div>