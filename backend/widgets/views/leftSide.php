<?php
/*NavBar::begin([
    'brandLabel' => 'My Company',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
$menuItems = [
    ['label' => 'Home', 'url' => ['/site/index']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = ['label' => 'Logout (' . Yii::$app->user->identity->username .')' , 'url' => ['/site/logout']];
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();*/
?>
<div id="sidebar-left" class="enable-hover">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Search Form -->
        <form action="" method="post" class="sidebar-search">
            <input type="text" id="sidebar-search-term" name="sidebar-search-term" placeholder="Search..">
        </form>
        <!-- END Search Form -->

        <!-- Wrapper for scrolling functionality -->
        <div class="sidebar-left-scroll">
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
                    <h2 class="sidebar-header">Welcome</h2>
                </li>
                <li>
                    <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('site/index'); ?>"><i class="fa fa-coffee"></i>Dashboard</a>
                </li>
                <li>
                    <h2 class="sidebar-header">Kato</h2>
                </li>
                <li>
                    <a href="#" class="menu-link"><i class="fa fa-book"></i>Blog</a>
                    <ul>
                        <li>
                            <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('blog/index'); ?>">All Posts</a>
                        </li>
                        <li>
                            <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('blog/create'); ?>">Add New</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="menu-link"><i class="fa fa-th"></i>Pages</a>
                    <ul>
                        <li>
                            <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('page/index'); ?>">All Pages</a>
                        </li>
                        <li>
                            <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('page/create'); ?>">Add New</a>
                        </li>
                        <li>
                            <a href="#">All Text Blocks</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="menu-link"><i class="fa fa-user"></i>Users</a>
                    <ul>
                        <li>
                            <a href="#">All Users</a>
                        </li>
                        <li>
                            <a href="#">Add New</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <h2 class="sidebar-header">Extras</h2>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bars"></i>Demo</a>
                </li>
            </ul>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Wrapper for scrolling functionality -->
    </div>
    <!-- END Sidebar Content -->
</div>
<!-- END Left Sidebar -->