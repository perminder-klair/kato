<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var string $name
 * @var string $message
 * @var Exception $exception
 */

$this->title = $name;
?>
<!--<div class="site-error">

	<h1><?= Html::encode($this->title) ?></h1>

	<div class="alert alert-danger">
		<?= nl2br(Html::encode($message)) ?>
	</div>

	<p>
		The above error occurred while the Web server was processing your request.
	</p>
	<p>
		Please contact us if you think this is a server error. Thank you.
	</p>

</div>-->

<div id="fx-container" class="fx-opacity">
    <!-- Page content -->
    <div id="page-content" class="block full">
        <!-- 404 Error Header -->
        <div class="block-header">
            <!-- If you do not want a link in the header, instead of .header-title-link you can use a div with the class .header-section -->
            <a href="" class="header-title-link">
                <h1>
                    <i class="fa fa-times-circle-o animation-expandUp"></i><?= Html::encode($this->title) ?><br>
                    <small>An error occurred while the Web server was processing your request.</small>
                </h1>
            </a>
        </div>

        <!-- Error Content -->
        <div class="row gutter30 error-container animation-expandUp">
            <div class="col-xs-6 text-right">
                <i class="fa fa-times text-danger"></i>
            </div>
            <div class="col-xs-6 text-left">
                <h1><?= Html::encode($this->title) ?></h1>
                <small><?= nl2br(Html::encode($message)) ?>
                    <br/>Please contact us if you think this is a server error.
                    <br/>Thank you.
                </small>
            </div>
        </div>
        <form action="#" method="post">
            <div class="input-group input-group-lg">

                <input type="text" id="search-term" name="search-term" class="form-control"
                       placeholder="But cheer up! Search..">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search fa-fw"></i>
                                </button>
                            </span>
            </div>
        </form>
        <!-- END Error Content -->
    </div>
    <!-- END Page Content -->

    <!-- Footer -->
    <footer class="clearfix">
        <div class="pull-right">
            Crafted with <i class="fa fa-heart"></i> by <a href="http://goo.gl/vNS3I" target="_blank">webonise</a>
        </div>
        <div class="pull-left">
            <span id="year-copy"></span> &copy; <a href="javascript:void(0)" target="_blank">Kato</a>
        </div>
    </footer>
    <!-- END Footer -->
</div>
<!-- END FX Container -->
</div>
<!-- END Page Container -->
