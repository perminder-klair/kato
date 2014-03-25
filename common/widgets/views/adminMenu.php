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
                <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('block/index'); ?>">All Text Blocks</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#" class="menu-link"><i class="fa fa-user"></i>Users</a>
        <ul>
            <li>
                <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('user/index'); ?>">All Users</a>
            </li>
            <li>
                <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('user/create'); ?>">Add New</a>
            </li>
        </ul>
    </li>
    <!--<li>
        <h2 class="sidebar-header">Extras</h2>
    </li>
    <li>
        <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('demo/admin'); ?>"><i class="fa fa-bars"></i>Demo</a>
    </li>-->
</ul>
<!-- END Sidebar Navigation -->