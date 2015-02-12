<?php

use kato\helpers\KatoBase;
use kato\DropZone;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

/**
 * @var kato\web\View $this
 */
$this->title = $meta['title'];
$this->description = $meta['description'];
$this->pageIcon = $meta['pageIcon'];
$this->params['breadcrumbs'][] = $this->title;

?>

<?=
Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => ['class' => 'breadcrumb breadcrumb-top'],
    'encodeLabels' => false,
    'homeLink' => ['label' => '<i class="' . Html::encode($this->pageIcon) . '"></i>'],
]) ?>

<?= \backend\widgets\Alert::widget(); ?>

<div class="row">
    <div class="col-lg-12">
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
                    'url' => \Yii::$app->urlManagerFrontend->createUrl(['media/default/upload']),
                    'addRemoveLinks' => true,
                    'maxFilesize' => KatoBase::formatBytes(Yii::$app->params['maxUploadSize'], 'MB', '0', true),
                    'acceptedFiles' => implode(",", Yii::$app->params['acceptedUploadTypes']),
                ],
                'clientEvents' => [
                    'success' => "function(file, responseText){
                $.get( '" . \Yii::$app->urlManagerFrontend->createUrl(['media/default/render-row']) . "?id=' + responseText.id, function(data) {
                    $('.media-container').prepend(data);
                });
            }",
                ]
            ]); ?>
            <!-- END Dropzone Content -->
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Media List
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?= GridView::widget([
                    'options' => ['class' => 'table-responsive'],
                    'tableOptions' => ['id' => 'general-table', 'class' => 'table table-striped table-hover'],
                    'showFooter' => true,
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => $getColumns,
                ]); ?>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>
