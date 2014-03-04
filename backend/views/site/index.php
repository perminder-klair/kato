<div id="page-container">
    <!-- Header -->
    <!-- In the PHP version you can set the following options from the config file -->
    <!-- Add the class .navbar-default or .navbar-inverse for a light or dark header respectively -->
    <!-- Add the class .navbar-fixed-top or .navbar-fixed-bottom for a fixed header on top or bottom respectively -->
    <!-- If you add the class .navbar-fixed-top remember to add the class .header-fixed-top to <body> element -->
    <!-- If you add the class .navbar-fixed-bottom remember to add the class .header-fixed-bottom to <body> element -->
    <header class="navbar navbar-default navbar-fixed-top">
        <!-- Right Header Navigation -->
        <ul class="nav header-nav pull-right">
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cogs"></i>
                </a>
                <ul class="dropdown-menu dropdown-custom pull-right">
                    <li class="dropdown-header text-center">HEADER</li>
                    <li>
                        <div class="btn-group btn-group-justified btn-group-sm">
                            <a href="javascript:void(0)" class="btn btn-default" id="options-header-default">Default</a>
                            <a href="javascript:void(0)" class="btn btn-default" id="options-header-inverse">Inverse</a>
                        </div>
                    </li>
                    <li>
                        <div class="btn-group btn-group-justified btn-group-sm">
                            <a href="javascript:void(0)" class="btn btn-default" id="options-header-top">Top</a>
                            <a href="javascript:void(0)" class="btn btn-default" id="options-header-bottom">Bottom</a>
                        </div>
                    </li>
                    <li class="hidden-xs hidden-sm dropdown-header text-center">FULL WIDTH PAGE</li>
                    <li class="hidden-xs hidden-sm">
                        <div class="btn-group btn-group-justified btn-group-sm">
                            <a href="javascript:void(0)" class="btn btn-default" id="options-fw-disable">Disable</a>
                            <a href="javascript:void(0)" class="btn btn-default" id="options-fw-enable">Enable</a>
                        </div>
                    </li>
                    <li class="visible-lg dropdown-header text-center">PIN SIDEBARS</li>
                    <li class="visible-lg">
                        <div class="btn-group btn-group-justified btn-group-sm">
                            <a href="javascript:void(0)" class="btn btn-default" id="options-pin-left">Pin Left</a>
                            <a href="javascript:void(0)" class="btn btn-default" id="options-pin-right">Pin Right</a>
                        </div>
                    </li>
                    <li class="visible-lg dropdown-header text-center">SIDEBARS MOUSE HOVER</li>
                    <li class="visible-lg">
                        <div class="btn-group btn-group-justified btn-group-sm">
                            <a href="javascript:void(0)" class="btn btn-default" id="options-hover-left">Left</a>
                            <a href="javascript:void(0)" class="btn btn-default" id="options-hover-right">Right</a>
                        </div>
                    </li>
                    <li class="visible-lg hidden-lt-ie9 dropdown-header text-center">EFFECT WHEN SIDEBARS OPEN</li>
                    <li class="visible-lg hidden-lt-ie9 text-center">
                        <div class="btn-group-vertical btn-group-sm" id="option-effects">
                            <button class="btn btn-default" data-fx="fx-none">None</button>
                            <button class="btn btn-default" data-fx="fx-opacity">Opacity</button>
                            <button class="btn btn-default" data-fx="fx-move">Move</button>
                            <button class="btn btn-default" data-fx="fx-push">Push</button>
                            <button class="btn btn-default" data-fx="fx-rotate">Rotate</button>
                            <button class="btn btn-default" data-fx="fx-push-move">Push and Move</button>
                            <button class="btn btn-default" data-fx="fx-push-rotate">Push and Rotate</button>
                        </div>
                    </li>
                </ul>
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
        <a href="index.html" class="navbar-brand">
            <img src="img/template/drop.png" alt="FreshUI">
            <span>FreshUI</span>
        </a>
        <!-- END Header Brand -->
    </header>
    <!-- END Header -->

    <!-- FX Container -->
    <!-- In the PHP version you can set the following options from the config file -->
    <!--
        All effects apply in resolutions larger than 1200px width
        Add one of the following classes to #fx-container for setting an effect to main content when one of the sidebars are opened
        'fx-none'           remove all effects (better website performance)
        'fx-opacity'        opacity effect
        'fx-move'           move effect
        'fx-push'           push effect
        'fx-rotate'         rotate effect
        'fx-push-move'      push-move effect
        'fx-push-rotate'    push-rotate effect
    -->
    <div id="fx-container" class="fx-opacity">
        <!-- Page content -->
        <div id="page-content" class="block">
            <!-- Blank Header -->
            <div class="block-header">
                <!-- If you do not want a link in the header, instead of .header-title-link you can use a div with the class .header-section -->
                <a href="" class="header-title-link">
                    <h1>
                        <i class="glyphicon-brush animation-expandUp"></i>Blank<br><small>A clean page to help you start!</small>
                    </h1>
                </a>
            </div>
            <ul class="breadcrumb breadcrumb-top">
                <li><i class="fa fa-file-o"></i></li>
                <li>Pages</li>
                <li><a href="">Blank</a></li>
            </ul>
            <!-- END Blank Header -->

            <!-- Blank Content -->
            <p>Create your content..</p>
            <!-- END Blank Content -->
        </div>
        <!-- END Page Content -->

        <!-- Footer -->
        <footer class="clearfix">
            <div class="pull-right">
                Crafted with <i class="fa fa-heart"></i> by <a href="http://goo.gl/vNS3I" target="_blank">pixelcave</a>
            </div>
            <div class="pull-left">
                <span id="year-copy"></span> &copy; <a href="javascript:void(0)" target="_blank">FreshUI 1.4</a>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END FX Container -->
</div>
<!-- END Page Container -->