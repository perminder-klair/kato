<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use backend\models\Tag;

$tag = new Tag;
/**
 * @var yii\web\View $this
 * @var common\models\Blog $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="block-title">
    <h2>Update Form</h2>
</div>


<?php $form = ActiveForm::begin([
    'options' => ['enctype'=>'multipart/form-data']
]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 70]) ?>

    <?= Html::activeLabel($model, 'content') ?>
    <?/* kartik\markdown\MarkdownEditor::widget([
        'model' => $model,
        'attribute' => 'content',
    ]); */?>

    <?= $form->field($model, 'tags')->widget(Select2::classname(), [
        'language' => 'en',
        'options' => [
            'multiple' => true,
            'placeholder' => 'Select a state ...'
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => $tag->listTags(),
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

    <? /*  \kato\widgets\FileUpload::widget([
        'form' => $form,
    ]);*/ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

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