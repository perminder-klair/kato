<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kato\sirtrevorjs\SirTrevor;

/**
 * @var yii\web\View $this
 * @var backend\models\Block $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="block-form">

	<?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => 70]) ?>

        <?= $form->field($model, 'content')->widget(SirTrevor::classname(), [
            'imageUploadUrl' => Yii::$app->urlManager->createAdminUrl(['block/upload']),
        ]); ?>

        <?= $form->field($model, 'status')->dropDownList($model->listStatus()); ?>

        <?= $form->field($model, 'parent')->dropDownList($model->listParents(), ['prompt'=>'No Parent']); ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
