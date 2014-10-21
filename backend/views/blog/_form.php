<?php

use yii\helpers\Html;
use backend\models\Tag;
use backend\widgets\Media;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use kato\sirtrevorjs\SirTrevor;

$tag = new Tag;

/**
 * @var yii\web\View $this
 * @var backend\models\Blog $model
 * @var backend\models\Media $media
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="block-title">
    <ul class="nav nav-tabs" data-toggle="tabs">
        <li class="active"><a href="#form">Form</a></li>
        <li><a href="#media">Media</a></li>
        <li><a href="#revisions" data-toggle="tab">Revisions</a></li>
    </ul>
</div>

<div class="tab-content">

    <div class="tab-pane active" id="form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => 70]) ?>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => 70]) ?>

        <?= $form->field($model, 'content')->widget(SirTrevor::classname(), [
            'imageUploadUrl' => Yii::$app->urlManager->createAdminUrl(['block/upload']),
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

    <div class="tab-pane" id="revisions">
        <?php if ($model->revisions): ?>
            <?= \yii\grid\GridView::widget([
                'options' => ['class' => 'table-responsive'],
                'tableOptions' => ['id' => 'general-table', 'class' => 'table table-striped table-hover'],
                'showFooter' => true,
                'dataProvider' => $model->revisionsProvider(),
                'columns' => [
                    'update_time',
                    [
                        'label' => 'Author',
                        'format' => 'text',
                        'value' => function ($data) {
                            if ($data->user) {
                                return $data->user->displayName;
                            }
                            return false;
                        },
                    ],
                    [
                        'label' => 'Actions',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Html::a('Restore', ['restore', 'id' => $data->id], ['class' => 'btn btn-warning btn-xs', 'target' => '_blank']);
                        },
                    ],
                ],
            ]); ?>
        <?php else: ?>
            <p>No revisions available!</p>
        <?php endif; ?>
    </div>

</div>