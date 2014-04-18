<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin();

    echo $form->field($model, 'full_name')->textInput(['maxlength' => 255]);
    echo $form->field($model, 'location')->textInput(['maxlength' => 255]);
    echo $form->field($model, 'website')->textInput(['maxlength' => 255]);
    echo $form->field($model, 'bio')->textArea(['maxlength' => 255]);

    echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);

ActiveForm::end();