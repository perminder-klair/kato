<?php

use kato\helpers\KatoBase;
use kato\DropZone;

/**
 * @var backend\models\Media $media
 */

?>

<div class="block full">
    <!-- Dropzone Title -->
    <div class="block-title">
        <h2><i class="fa fa-cloud-upload"></i> File Upload <small>Drag and Drop files to upload them!</small></h2>
    </div>
    <!-- END Dropzone Title -->

    <!-- Dropzone Content -->
    <!-- Dropzone.js, You can check out https://github.com/enyo/dropzone/wiki for usage examples -->
    <?= DropZone::widget([
        'options' => [
            'url' => \Yii::$app->urlManager->createUrl(['site/upload', 'content_id' => $model->id, 'content_type' => $model->className()]),
            'addRemoveLinks' => true,
            'maxFilesize' => KatoBase::formatBytes(Yii::$app->params['maxUploadSize'], 'MB', '0', true),
        ],
        'clientEvents' => [
            'success' => "function(file, responseText){console.log(responseText)}",
        ]
    ]); ?>
    <!-- END Dropzone Content -->
</div>

<div class="table-responsive">
    <table id="general-table" class="table table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Mime Type</th>
            <th>Size</th>
            <th>Published</th>
            <th>Type</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($model->media as $media): ?>
            <tr>
                <td><a href="<?= $media->render() ?>"><?= $media->filename ?></a></td>
                <td><?= $media->mimeType ?></td>
                <td><?= \kato\helpers\KatoBase::formatBytes($media->byteSize, 'MB') ?></td>
                <td><?= $media->statusLabel ?></td>
                <td><?= ucfirst($media->media_type) ?></td>
                <td class="text-center">
                    <div class="btn-group btn-group-xs">
                        <a href="<?= \Yii::$app->urlManager->createAdminUrl(['media/update', 'id' => $media->id]); ?>" class="btn btn-default" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="<?= \Yii::$app->urlManager->createAdminUrl(['media/delete', 'id' => $media->id]); ?>" class="btn btn-default" data-original-title="Delete" data-confirm="Are you sure to delete this item?" data-method="post" data-pjax="0"><i class="fa fa-times"></i></a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>