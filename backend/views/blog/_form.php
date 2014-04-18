<?php

use yii\helpers\Html;
use backend\models\Tag;
use backend\widgets\Media;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use ijackua\lepture\Markdowneditor;

$tag = new Tag;

/**
 * @var yii\web\View $this
 * @var common\models\Blog $model
 * @var backend\models\Media $media
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

    <div class="tab-pane active" id="form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => 70]) ?>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => 70]) ?>

        <?= $form->field($model, 'content')->widget(Markdowneditor::classname(), [
            'leptureOptions' => []
        ]); ?>

        <?= $form->field($model, 'tags')->widget(Select2::classname(), [
            'language' => 'en',
            'options' => [
                'multiple' => true,
                'placeholder' => 'Select a state ...'
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'tags' => $tag->listTags($model->className()),
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

    </div>

    <div class="tab-pane" id="media">

        <?= Media::widget([
            'model' => $model,
        ]); ?>

    </div>

</div>