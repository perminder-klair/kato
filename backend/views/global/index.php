<?php
/**
 * @var backend\components\View $this
 * @var $meta;
 * @var $dataProvider;
 * @var $searchModel;
 */
$this->title = $meta['title'];
$this->description = $meta['description'];
$this->pageIcon = $meta['pageIcon'];
$this->params['breadcrumbs'][] = $this->title;

use yii\widgets\Breadcrumbs;
use yii\grid\GridView;
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
                        <i class="<?= $this->pageIcon; ?> animation-expandUp"></i><?= $meta['title']; ?><br>
                        <small><?= $this->description; ?></small>
                    </h1>
                </a>
            </div>
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => 'breadcrumb breadcrumb-top'],
                'encodeLabels' => false,
                'homeLink' => ['label' => '<i class="' . $this->pageIcon . '"></i>'],
            ]) ?>
            <!-- END Blank Header -->

            <!-- Blank Content -->
            <?php echo GridView::widget([
                'options' => ['class' => 'table-responsive'],
                'tableOptions' => ['id' => 'general-table', 'class' => 'table'],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'title',
                    'created_by',
                    'update_time',
                    'publish_time',
                    'status',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <!-- END Blank Content -->
        </div>
        <!-- END Page Content -->

        <?= backend\widgets\Footer::widget(); ?>

    </div>
    <!-- END FX Container -->
</div>
<!-- END Page Container -->