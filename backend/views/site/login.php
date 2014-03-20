<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="site-login">
	<h1><?= Html::encode($this->title) ?></h1>

	<p>Please fill out the following fields to login:</p>

	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
				<?= $form->field($model, 'username') ?>
				<?= $form->field($model, 'password')->passwordInput() ?>
				<?= $form->field($model, 'rememberMe')->checkbox() ?>
				<div class="form-group">
					<?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
				</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>-->


<!-- Login Container -->
<div id="login-container">
    <!-- Page Content -->
    <div id="page-content" class="block remove-margin animation-bigEntrance">
        <!-- Login Title -->
        <div class="block-header">
            <div class="header-section">
                <h1 class="text-center">Welcome to Kato<br><small>Please Login or Register</small></h1>
            </div>
        </div>
        <!-- END Login Title -->

        <!-- Login Form -->
        <form action="index.html" method="post" id="form-login" class="form-horizontal">
            <div class="form-group">
                <!-- Social Login -->
                <div class="col-xs-6">
                    <a href="javascript:void(0)" class="btn btn-lg btn-info btn-block"><i class="fa fa-facebook"></i> Facebook</a>
                </div>
                <div class="col-xs-6">
                    <a href="javascript:void(0)" class="btn btn-lg btn-info btn-block"><i class="fa fa-twitter"></i> Twitter</a>
                </div>
                <!-- END Social Login -->
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="text" id="login-email" name="login-email" class="form-control input-lg" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="password" id="login-password" name="login-password" class="form-control input-lg" placeholder="Password">

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
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Login</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <p class="text-center remove-margin"><small>Don't have an account?</small> <a href="javascript:void(0)" id="link-login"><small>Create one for free!</small></a></p>
                </div>
            </div>
        </form>
        <!-- END Login Form -->

        <!-- Register Form -->
        <form action="page_special_login.html" method="post" id="form-register" class="form-horizontal display-none" onsubmit="return false;">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                        <input type="text" id="register-username" name="register-username" class="form-control input-lg" placeholder="Username">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                        <input type="text" id="register-email" name="register-email" class="form-control input-lg" placeholder="Email">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-asterisk fa-fw"></i></span>
                        <input type="password" id="register-password" name="register-password" class="form-control input-lg" placeholder="Password">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-asterisk fa-fw"></i></span>
                        <input type="password" id="register-password-verify" name="register-password-verify" class="form-control input-lg" placeholder="Verify Password">
                    </div>

                    <!--
                    Hidden checkbox. Its checked property will be toggled every time the terms (#btn-terms) button is clicked (js code at the bottom)
                    You can add the checked property by default (the button will be enabled automatically)
                    -->
                    <input type="checkbox" id="register-terms" name="register-terms" hidden>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-8">
                    <div class="btn-group">
                        <a href="#modal-terms" class="btn btn-sm btn-primary" data-toggle="modal">Terms</a>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="button" id="btn-terms"><i class="fa fa-check"></i> Agree</button>
                    </div>
                </div>
                <div class="col-xs-4 text-right">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-angle-right"></i> Register</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <p class="text-center remove-margin"><small>Oops, you have an account?</small> <a href="javascript:void(0)" id="link-register"><small>Login!</small></a></p>
                </div>
            </div>
        </form>
        <!-- END Register Form -->

        <!-- Modal Terms -->
        <div id="modal-terms" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Terms &amp; Conditions</h4>
                    </div>
                    <div class="modal-body">
                        <h4>Title</h4>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <h4>Title</h4>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <h4>Title</h4>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <h4>Title</h4>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal Terms -->
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

        /* Login & Register show-hide */
        var formLogin = $('#form-login'),
            formRegister = $('#form-register');

        $('#link-login').click(function() {
            formLogin.slideUp(250);
            formRegister.slideDown(250);
        });
        $('#link-register').click(function() {
            formRegister.slideUp(250);
            formLogin.slideDown(250);
        });
    });
</script>