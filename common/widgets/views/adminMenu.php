<!-- Sidebar Navigation -->
<ul class="sidebar-nav">
    <li>
        <h2 class="sidebar-header">Welcome</h2>
    </li>
    <li>
        <a href="<?= \Yii::$app->urlManagerBackend->createUrl('site/index'); ?>"><i class="fa fa-coffee"></i>Dashboard</a>
    </li>
    <li>
        <h2 class="sidebar-header">Kato</h2>
    </li>
    <li>
        <a href="#" class="menu-link"><i class="fa fa-book"></i>Blog</a>
        <ul>
            <li>
                <a href="<?= \Yii::$app->urlManagerBackend->createUrl('blog/index'); ?>">All Posts</a>
            </li>
            <li>
                <a href="<?= \Yii::$app->urlManagerBackend->createUrl('blog/create'); ?>">Add New</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#" class="menu-link"><i class="fa fa-th"></i>Pages</a>
        <ul>
            <li>
                <a href="<?= \Yii::$app->urlManagerBackend->createUrl('page/index'); ?>">All Pages</a>
            </li>
            <li>
                <a href="<?= \Yii::$app->urlManagerBackend->createUrl('page/create'); ?>">Add New</a>
            </li>
            <li>
                <a href="<?= \Yii::$app->urlManagerBackend->createUrl('block/index'); ?>">All Text Blocks</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#" class="menu-link"><i class="fa fa-user"></i>Users</a>
        <ul>
            <li>
                <a href="<?= \Yii::$app->urlManagerBackend->createUrl('user/index'); ?>">All Users</a>
            </li>
            <li>
                <a href="<?= \Yii::$app->urlManagerBackend->createUrl('user/create'); ?>">Add New</a>
            </li>
        </ul>
    </li>
    <li>
        <h2 class="sidebar-header">Extras</h2>
    </li>
    <?php foreach ($items as $item): ?>
    <li>
        <a href="<?= \Yii::$app->urlManagerFrontend->createUrl($item['controller'] . '/admin'); ?>"><i class="<?= $item['icon']; ?>"></i><?= $item['title']; ?></a>
    </li>
    <?php endforeach; ?>
</ul>
<!-- END Sidebar Navigation -->