<?php
/**
 * @var kato\web\View $this
 * @var $meta
 * @var $controllerName
 */
$this->title = $meta['title'];
$this->description = $meta['description'];
$this->pageIcon = $meta['pageIcon'];
$this->params['breadcrumbs'][] = $this->title;

use yii\widgets\Breadcrumbs;
use yii\grid\GridView;
use yii\helpers\Html;

?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= Html::encode($this->title) ?>
            <div class="pull-right">
                <?= Html::a('<i class="fa fa-plus"></i> Create', ['create'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fa fa-download"></i> Import', ['import'], ['class' => 'btn btn-primary']) ?>
            </div>
        </h1>

    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<?=
Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => ['class' => 'breadcrumb breadcrumb-top'],
    'encodeLabels' => false,
    'homeLink' => ['label' => '<i class="' . Html::encode($this->pageIcon) . '"></i>'],
]) ?>

<?= \backend\widgets\Alert::widget(); ?>

<!--<div class="collapse-group">
    <div class="text-center remove-margin">
        <a data-toggle="collapse" data-target=".search-container" class="btn btn-xs btn-primary search-btn"><i class="fa fa-angle-down"></i> Search <?= Html::encode($this->title) ?></a>
    </div>
    <div class="block search-container collapse">
        <div class="block-title">
            <h2>Search <?= Html::encode($this->title) ?></h2>
        </div>
        <?php //echo $this->render('/' . $controllerName . '/_search', ['model' => $searchModel]); ?>
    </div>
</div>-->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::encode($this->title) ?> List
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- /.table-responsive -->
                <?= \kato\widgets\PageTreeWidget::widget(); ?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>
