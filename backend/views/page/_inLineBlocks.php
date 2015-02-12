<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\Block;
use yii\imperavi\Widget as ImperaviWidget;
use kato\sirtrevorjs\SirTrevor;

/**
 * @var yii\web\View $this
 * @var backend\models\Page $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <?php $catCount = 0; foreach ($model->activeBlocks['categories'] as $category): $catCount++; ?>
                        <li class="<?php echo $catCount==1?'active':''; ?>"><a href="#<?php echo $category; ?>" data-toggle="tab"><?php echo ucwords(str_replace("-", " ", $category)); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="panel-body">
                <!-- Tab panes -->

                <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-4',
                            'offset' => 'col-sm-offset-0',
                            'wrapper' => 'col-sm-12',
                            'error' => '',
                            'hint' => '',
                        ],
                    ],
                ]); ?>

                <div class="tab-content">

                    <?php $catCount = 0; foreach ($model->activeBlocks['blocks'] as $category => $blocks): $catCount++; ?>

                        <div class="tab-pane fade in <?php echo $catCount==1?'active':''; ?>" id="<?php echo $category; ?>">

                            <?php foreach ($blocks as $key => $block): ?>
                                <div class="form-group block">
                                    <?php echo $block->label; ?>
                                    <div class="col-sm-9">
                                        <?php
                                        if ($block->block_type == Block::TYPE_TEXT_AREA) {

                                            echo ImperaviWidget::widget([
                                                'attribute' => 'Block['.$block->title.']',
                                                'value' => $block->content,
                                                // Some options, see http://imperavi.com/redactor/docs/
                                                'options' => [
                                                    'toolbar' => 'classic',
                                                    'minHeight' => 300,
                                                    'autoresize' => true,
                                                    //'convertVideoLinks' => true,
                                                    'imageUpload' => Yii::$app->urlManagerBackend->createUrl(['media/upload']),
                                                    //'imageUploadParam' => 'qqfile',
                                                    //'uploadFields' => array('editorUpload' => true),
                                                    'focus' => true,
                                                    'imageManagerJson' => Yii::$app->urlManagerBackend->createUrl(['media/list-media']),
                                                    //'imageGetJson' => Yii::$app->urlManager->createAdminUrl(['media/list-media']),
                                                ],
                                                'plugins' => [
                                                    /*'pages' => array(
                                                        'js' => array('pages.js',),
                                                    ),*/
                                                    'fullscreen',
                                                    'table',
                                                    'counter',
                                                    'definedlinks',
                                                    'fontsize',
                                                    'textexpander',
                                                    'video',
                                                    'imagemanager',
                                                ],
                                            ]);

                                        } elseif ($block->block_type == Block::TYPE_TEXT_FIELD) {

                                            echo $form->field($block, 'content')->label(false)->textInput(['name' => 'Block['.$block->title.']', 'class' => 'form-control']);

                                        } elseif ($block->block_type == Block::TYPE_SIR_TREVOR) {

                                            echo SirTrevor::widget([
                                                'name' => 'Block['.$block->title.']',
                                                'debug' => true,
                                                'value' => $block->content,
                                                'imageUploadUrl' => Yii::$app->urlManagerBackend->createUrl(['block/upload']),
                                                'blockTypes' => ["Heading", "List", "Quote", "Image", "Video", "Textimage", "Redactor"],
                                            ]);

                                        }
                                        ?>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>

                    <?php endforeach; ?>

                    <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->