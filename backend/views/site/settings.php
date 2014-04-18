<?php
/**
 * @var yii\web\View $this
 * @var backend\models\Setting $settings
 */
$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
                        <i class="fa fa-cogs animation-expandUp"></i>Settings<br><small>Update site settings.</small>
                    </h1>
                </a>
            </div>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => 'breadcrumb breadcrumb-top'],
                'encodeLabels' => false,
                'homeLink' => ['label' => '<i class="fa fa-cogs"></i>'],
            ]) ?>
            <!-- END Blank Header -->

            <!-- Blank Content -->
            <?php $form = ActiveForm::begin([
                'action' => 'site/settings'
            ]);

                foreach ($settings as $index => $setting) {
                    echo $form->field($setting, "[$index]value")->label($setting->defineEncoded());
                }

                echo Html::submitButton('Submit', ['class' => 'btn btn-primary']);

            ActiveForm::end(); ?>
            <!-- END Blank Content -->
        </div>
        <!-- END Page Content -->

        <?= backend\widgets\Footer::widget(); ?>

    </div>
    <!-- END FX Container -->
</div>
<!-- END Page Container -->