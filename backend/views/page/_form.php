<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\Page;
use kato\modules\media\widgets\Media;
/**
 * @var yii\web\View $this
 * @var backend\models\Page $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>

<div class="row">
    <div class="col-lg-12">
        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label' => 'col-sm-4',
                    'offset' => 'col-sm-offset-4',
                    'wrapper' => 'col-sm-8',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#info" data-toggle="tab">Basic Info</a></li>
                    <li><a href="#media" data-toggle="tab">Media</a></li>
                    <li><a href="#meta" data-toggle="tab">Meta</a></li>
                    <li><a href="#menu" data-toggle="tab">Menu</a></li>
                    <li><a href="#revisions" data-toggle="tab">Revisions</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="info">

                        <?= $form->field($model, 'title')->textInput(['maxlength' => 70]) ?>

                        <?= $form->field($model, 'parent_id')->dropDownList($model->listParents(), ['prompt'=>'No Parent']); ?>

                        <?= $form->field($model, 'status')->dropDownList($model->listStatus()); ?>

                        <?= $form->field($model, 'layout')->dropDownList($model->listLayouts()); ?>

                        <?= $form->field($model, 'type')->dropDownList([Page::TYPE_STATIC => 'Static', Page::TYPE_NON_STATIC => 'Dynamic']); ?>
                    </div>

                    <div class="tab-pane fade in" id="media">
                        <?= Media::widget([
                            'model' => $model,
                        ]); ?>
                    </div>

                    <div class="tab-pane fade in" id="meta">
                        <?= $form->field($model, 'short_desc')->textarea(['maxlength' => 160]) ?>

                        <?= $form->field($model, 'slug')->textInput(['maxlength' => 70]) ?>
                    </div>

                    <div class="tab-pane fade in" id="menu">
                        <?= $form->field($model, 'menu_title')->textInput(['maxlength' => 70]) ?>

                        <?= $form->field($model, 'menu_hidden')->dropDownList([Page::MENU_HIDDEN_NO => 'No', Page::MENU_HIDDEN_YES => 'Yes']) ?>

                        <?= $form->field($model, 'listing_order')->dropDownList($model->listingOrderArray) ?>
                    </div>

                    <div class="tab-pane fade in" id="revisions">
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
                                            if ($data->author) {
                                                return $data->author->displayName;
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
            </div>
            <!-- /.panel-body -->
            <div class="panel-footer">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <a href="<?= $model->permalink ?>" class="btn btn-default" target="_blank">Preview</a>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php if ($model->blocks) echo $this->render('_inLineBlocks', [
    'model' => $model,
]); ?>
