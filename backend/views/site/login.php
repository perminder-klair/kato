<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\bootstrap\ActiveForm $form
 * @var backend\models\LoginForm $model
 */
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Login Container -->
<div id="login-container">
    <!-- Page Content -->
    <div id="page-content" class="block remove-margin animation-bigEntrance">
        <!-- Login Title -->
        <div class="block-header">
            <div class="header-section">
                <h1 class="text-center">Welcome to Kato<br><small>Please <?= Html::encode($this->title) ?></small></h1>
            </div>
        </div>
        <!-- END Login Title -->

        <!-- Login Form -->
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
        ]); ?>
            <div class="form-group">
                <div class="col-xs-12">
                    <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username', 'class' => 'form-control input-lg'])->label('') ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password', 'class' => 'form-control input-lg'])->label('') ?>

                    <!--
                    Hidden checkbox. Its checked property will be toggled every time the remember me (#btn-remember) button is clicked (js code at the bottom)
                    You can add the checked property by default (the button will be enabled automatically)
                    -->
                    <input type="checkbox" id="login-remember" name="login-remember" hidden>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-8">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-default disabled">Remember me?</button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="button" id="btn-remember"><i class="fa fa-check"></i></button>
                    </div>
                </div>
                <div class="col-xs-4 text-right">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-sm btn-primary']) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <p class="text-center remove-margin"><small>Don't have an account?</small> <a href="#" id="link-login"><small>Create one for free!</small></a></p>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
        <!-- END Login Form -->

    </div>
    <!-- END Page Content -->
</div>
<!-- END Login Container -->

<!-- Javascript code only for this page -->
<script>
    $(function() {
        /* Save buttons (remember me and terms) and hidden checkboxes in variables */
        var checkR = $('#login-remember'),
            checkT = $('#register-terms'),
            btnR = $('#btn-remember'),
            btnT = $('#btn-terms');

        // Add the 'active' class to button if their checkbox has the property 'checked'
        if (checkR.prop('checked'))
            btnR.addClass('active');
        if (checkT.prop('checked'))
            btnT.addClass('active');

        // Toggle 'checked' property of hidden checkboxes when buttons are clicked
        btnR.on('click', function() {
            checkR.prop('checked', !checkR.prop('checked'));
        });
        btnT.on('click', function() {
            checkT.prop('checked', !checkT.prop('checked'));
        });
    });
</script>