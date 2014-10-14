<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 * @var common\models\UserProfile $profile
 * @var yii\bootstrap\ActiveForm $form
 */
?>

<div class="block-title">
    <ul class="nav nav-tabs" data-toggle="tabs">
        <li class="active"><a href="#form">Home</a></li>
        <li class=""><a href="#profile">Profile</a></li>
    </ul>
</div>

<div class="tab-content">

    <div class="tab-pane active" id="form">

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'status')->dropDownList($model->listStatus()); ?>

            <?= $form->field($model, 'role')->dropDownList($model->listRoles()); ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

        <?php ActiveForm::end(); ?>

    </div>

    <div class="tab-pane" id="profile">

        <?= \common\widgets\UserProfileForm::widget([
            'profile' => $profile,
        ]); ?>

    </div>

</div>
