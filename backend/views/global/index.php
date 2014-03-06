<?php
/**
 * @var backend\components\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\search\BlogSearch $searchModel
 * @var $meta ;
 * @var $getColumns;
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

            <!-- Blank Content -->
            <div class="block">

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <? // Html::a('Create Blog', ['create'], ['class' => 'btn btn-success']) ?>

                <div class="block-title">
                    <h2><?= Html::encode($this->title) ?></h2>
                </div>
                <?php echo GridView::widget([
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