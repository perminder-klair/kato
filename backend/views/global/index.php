<?php
/**
 * @var backend\components\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\search\BlogSearch $searchModel
 * @var $meta
 * @var $getColumns
 */
$this->title = $meta['title'];
$this->description = $meta['description'];
$this->pageIcon = $meta['pageIcon'];
$this->params['breadcrumbs'][] = $this->title;

use yii\widgets\Breadcrumbs;
use yii\grid\GridView;
use yii\helpers\Html;

?>
<div id="page-container">

    <?= backend\widgets\Header::widget(); ?>

    <div id="fx-container" class="fx-opacity">
        <!-- Page content -->
        <div id="page-content" class="block">
            <!-- Blank Header -->
            <div class="block-header">
                <!-- If you do not want a link in the header, instead of .header-title-link you can use a div with the class .header-section -->
                <a href="" class="header-title-link">
                    <h1>
                        <i class="<?= Html::encode($this->pageIcon) ?> animation-expandUp"></i><?= Html::encode($this->title) ?><br>
                        <small><?= Html::encode($this->description) ?></small>
                    </h1>
                </a>
            </div>
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => 'breadcrumb breadcrumb-top'],
                'encodeLabels' => false,
                'homeLink' => ['label' => '<i class="' . Html::encode($this->pageIcon) . '"></i>'],
            ]) ?>
            <!-- END Blank Header -->

            <?= \backend\widgets\Alert::widget(); ?>


            <div class="collapse-group">
                <div class="text-center remove-margin">
                    <a data-toggle="collapse" data-target=".search-container" class="btn btn-xs btn-primary"><i class="fa fa-angle-down"></i> Search <?= Html::encode($this->title) ?></a>
                </div>
                <div class="block search-container collapse">
                    <div class="block-title">
                        <h2>Search <?= Html::encode($this->title) ?></h2>
                    </div>
                    <?= $this->render('_search', ['model' => $searchModel]); ?>
                </div>
            </div>

            <!-- Blank Content -->
            <div class="block">

                <div class="block-title">
                    <div class="block-options pull-right">
                        <div class="btn-group">
                            <?= Html::a('<i class="fa fa-plus"></i> Create', ['create'], ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <h2><?= Html::encode($this->title) ?></h2>
                </div>
                <?= GridView::widget([
                    'options' => ['class' => 'table-responsive'],
                    'tableOptions' => ['id' => 'general-table', 'class' => 'table table-striped'],
                    'showFooter' => true,
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => $getColumns,
                ]); ?>
            </div>
            <!-- END Blank Content -->
        </div>
        <!-- END Page Content -->

        <?= backend\widgets\Footer::widget(); ?>

    </div>
    <!-- END FX Container -->
</div>
<!-- END Page Container -->