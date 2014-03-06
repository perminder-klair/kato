<div id="sidebar-right">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- User Info -->
        <div class="user-info">
            <div class="user-details"><a href="page_special_user_profile.html">pixelcave</a><br><em>Web Designer</em></div>
            <img src="<?= \Yii::$app->urlManager->baseUrl; ?>/img/template/avatar.png" alt="Avatar">
        </div>
        <!-- END User Info -->

        <!-- Wrapper for scrolling functionality -->
        <div class="sidebar-right-scroll">
            <!-- Color Themes -->
            <div class="sidebar-section">
                <h2 class="sidebar-header">Color Themes</h2>
                <!-- Change Color Theme functionality can be found in main.js - templateOptions() -->
                <ul class="theme-colors clearfix">
                    <li class="active">
                        <a href="javascript:void(0)" class="themed-background-default themed-border-default" data-theme="default" data-toggle="tooltip" title="Default"></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-river themed-border-river" data-theme="css/themes/river.css" data-toggle="tooltip" title="River"></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-amethyst themed-border-amethyst" data-theme="css/themes/amethyst.css" data-toggle="tooltip" title="Amethyst"></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-dragon themed-border-dragon" data-theme="css/themes/dragon.css" data-toggle="tooltip" title="Dragon"></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-emerald themed-border-emerald" data-theme="css/themes/emerald.css" data-toggle="tooltip" title="Emerald"></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-grass themed-border-grass" data-theme="css/themes/grass.css" data-toggle="tooltip" title="Grass"></a>
                    </li>
                </ul>
            </div>
            <!-- END Color Themes -->

            <!-- User Menu -->
            <ul class="sidebar-nav">
                <li>
                    <h2 class="sidebar-header">Explore</h2>
                </li>
                <li>
                    <a href="page_special_timeline.html"><i class="fa fa-clock-o"></i> Updates</a>
                </li>
                <li>
                    <a href="page_special_user_profile.html"><i class="fa fa-pencil-square"></i> Profile</a>
                </li>
                <li>
                    <a href="page_special_message_center.html"><i class="fa fa-envelope-o"></i> Messages</a>
                </li>
                <li>
                    <a href="javascript:void(0)"><i class="fa fa-cog"></i> Settings</a>
                </li>
                <li>
                    <a href="page_special_login.html"><i class="fa fa-power-off"></i> Logout</a>
                </li>
            </ul>
            <!-- END User Menu -->

            <!-- Notifications -->
            <div class="sidebar-section">
                <h2 class="sidebar-header">Notifications</h2>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <small><em>2 hours ago</em></small><br>
                    PHP version updated successfully on <a href="javascript:void(0)">Server #5</a>
                </div>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <small><em>3 hours ago</em></small><br>
                    <a href="javascript:void(0)">Game Server</a> crashed but restored!
                </div>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <small><em>5 hours ago</em></small><br>
                    <a href="javascript:void(0)">FTP Server</a> went down for maintenance!
                </div>
            </div>
            <!-- END Notifications -->

            <!-- Messages -->
            <div class="sidebar-section">
                <h2 class="sidebar-header">Messages</h2>
                <div class="alert alert-info">
                    <small><a href="page_special_user_profile.html">Claire</a>, 2 minutes ago</small><br>
                    Hi John, I just wanted to let you know that.. <a href="page_special_message_center.html">more</a>
                </div>
                <div class="alert alert-info">
                    <small><a href="page_special_user_profile.html">Michael</a>, 5 minutes ago</small><br>
                    The project is moving along just fine and we.. <a href="page_special_message_center.html">more</a>
                </div>
            </div>
            <!-- END Messages -->
        </div>
        <!-- END Wrapper for scrolling functionality -->
    </div>
    <!-- END Sidebar Content -->
</div>
<!-- END Right Sidebar -->