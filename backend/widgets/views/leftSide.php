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

            <?= common\widgets\AdminMenu::widget(); ?>

        </div>
        <!-- END Wrapper for scrolling functionality -->
    </div>
    <!-- END Sidebar Content -->
</div>
<!-- END Left Sidebar -->