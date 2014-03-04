<header class="navbar navbar-default navbar-fixed-top">
    <!-- Right Header Navigation -->
    <ul class="nav header-nav pull-right">
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cogs"></i>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)" id="sidebar-right-toggle">
                <strong>5</strong> <i class="fa fa-user"></i>
            </a>
        </li>
    </ul>
    <!-- END Right Header Navigation -->

    <!-- Left Header Navigation -->
    <ul class="nav header-nav pull-left">
        <li>
            <a href="javascript:void(0)" id="sidebar-left-toggle">
                <i class="fa fa-bars"></i>
            </a>
        </li>
    </ul>
    <!-- END Left Header Navigation -->

    <!-- Header Brand -->
    <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('site/index'); ?>" class="navbar-brand">
        <img src="<?= \Yii::$app->urlManager->baseUrl; ?>/img/template/drop.png" alt="FreshUI">
        <span>Kato</span>
    </a>
    <!-- END Header Brand -->
</header>
<!-- END Header -->