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
 * @var backend\models\Media $media
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

        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => 70]) ?>

        <?= Html::activeLabel($model, 'content') ?>
        <?= kartik\markdown\MarkdownEditor::widget([
                'model' => $model,
                'attribute' => 'content',
            ]);
        ?>

        <?=
        $form->field($model, 'tags')->widget(Select2::classname(), [
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

        <?=
        $form->field($model, 'publish_time')->widget(DatePicker::classname(), [
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
            ]);*/
        ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <div class="tab-pane" id="media">

        <?=
        \kato\DropZone::widget([
            'options' => [
                'url' => \Yii::$app->urlManager->createUrl(['site/upload', 'content_id' => $model->id, 'media_type' => $model->className()]),
                'addRemoveLinks' => true,
                'maxFilesize' => kato\helpers\KatoBase::formatBytes(Yii::$app->params['maxUploadSize'], 'MB', '0', true),
            ],
            'clientEvents' => [
                'success' => "function(file, responseText){console.log(responseText)}",
            ]
        ]); ?>

        <div class="table-responsive">
            <table id="general-table" class="table table-striped">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Mime Type</th>
                    <th>Size</th>
                    <th>Published</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model->media as $media): ?>
                <tr>
                    <td><a href="<?= $media->render() ?>"><?= $media->filename ?></a></td>
                    <td><?= $media->mimeType ?></td>
                    <td><?= \kato\helpers\KatoBase::formatBytes($media->byteSize, 'MB') ?></td>
                    <td><?= $media->publishedStatus ?></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-xs">
                            <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default"
                               data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default"
                               data-original-title="Delete"><i class="fa fa-times"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>