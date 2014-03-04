/*
 *  Document   : main.js
 *  Author     : pixelcave
 *  Description: Custom scripts and plugin initializations
 */

var webApp = function() {

    /* Cache variables of some often used jquery objects */
    var body    = $('body');
    var header  = $('header');

    // Used for sidebar functionality, check handleSidebars()
    var sLToggle = $('#sidebar-left-toggle');
    var sRToggle = $('#sidebar-right-toggle');
    var sLScroll = $('.sidebar-left-scroll');
    var sRScroll = $('.sidebar-right-scroll');

    // 50 is the height of .sidebar-search and .user-info in pixels
    var sScrollHeight = $(window).height() - 51;

    /* Initialization UI Code */
    var uiInit = function() {

        // Add the correct copyright year at the footer
        var yearCopy = $('#year-copy'), d = new Date();

        if (d.getFullYear() === 2013) {
            yearCopy.html('2013');
        } else {
            yearCopy.html('2013-' + d.getFullYear());
        }

        // Add opacity to the header when scrolling (you can comment/remove the following line if you prefer a solid header)
        $(window).scroll(function() { if ($(this).scrollTop() > 60) { header.addClass('add-opacity'); } else { header.removeClass('add-opacity'); } });

        // Initialize tabs
        $('[data-toggle="tabs"] a, .enable-tabs a').click(function(e){ e.preventDefault(); $(this).tab('show'); });

        // Initialize Tooltips
        $('[data-toggle="tooltip"], .enable-tooltip').tooltip({container: 'body', animation: false});

        // Initialize Popovers
        $('[data-toggle="popover"], .enable-popover').popover({container: 'body', animation: false});

        // Initialize single image lightbox
        $('[data-toggle="lightbox-image"]').magnificPopup({type: 'image', image: {titleSrc: 'title'}});

        // Initialize image gallery lightbox
        $('[data-toggle="lightbox-gallery"]').magnificPopup({
            delegate: 'a.gallery-link',
            type: 'image',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                arrowMarkup: '<button type="button" class="mfp-arrow mfp-arrow-%dir%" title="%title%"></button>',
                tPrev: 'Previous',
                tNext: 'Next',
                tCounter: '<span class="mfp-counter">%curr% of %total%</span>'
            },
            image: {titleSrc: 'title'}
        });

        // Initialize Elastic
        $('textarea.textarea-elastic').elastic();

        // Initialize Editor
        $('.textarea-editor').wysihtml5();

        // Initialize Chosen
        $('.select-chosen').chosen();

        // Initialize Tags Input
        $('.input-tags').tagsInput({ width: 'auto', height: 'auto'});

        // Initialize Datepicker
        $('.input-datepicker, .input-daterange').datepicker();
        $('.input-datepicker-close').datepicker().on('changeDate', function(e){ $(this).datepicker('hide'); });

        // Initialize Timepicker
        $('.input-timepicker').timepicker({minuteStep: 1,showSeconds: true,showMeridian: true});
        $('.input-timepicker24').timepicker({minuteStep: 1,showSeconds: true,showMeridian: false});

        /* Easy Pie Chart */
        $('.pie-chart').easyPieChart({
            barColor: '#f39c12',
            trackColor: '#eeeeee',
            scaleColor: false,
            lineWidth: 3,
            size: $(this).data('size'),
            animate: 1200
        });
    };

    /* Sidebar Navigation functionality */
    var handleNav = function() {

        // Animation Speed, change the values for different results
        var upSpeed     = 250;
        var downSpeed   = 300;

        // Get all vital links
        var allTopLinks     = $('.sidebar-nav a');
        var menuLinks       = $('.menu-link');
        var submenuLinks    = $('.submenu-link');

        // Initialize number idicators on menu and submenu links
        menuLinks.each(function(n, e){ $(e).append('<span>' + $(e).next('ul').find('a').not('.submenu-link').length + '</span>'); });
        submenuLinks.each(function(n, e){ $(e).append('<span>' + $(e).next('ul').children().length + '</span>'); });

        // Icon animation on hover
        allTopLinks
            .mouseenter(function(){ $('i', this).addClass('animation-bigEntrance'); })
            .mouseleave(function(){ $('i', this).removeClass('animation-bigEntrance'); });

        // Primary Accordion functionality
        menuLinks.click(function(){
            var link = $(this);

            if (link.parent().hasClass('active') !== true) {
                if (link.hasClass('open')) {
                    link.removeClass('open').next().slideUp(upSpeed);
                }
                else {
                    $('.menu-link.open').removeClass('open').next().slideUp(upSpeed);
                    link.addClass('open').next().slideDown(downSpeed);
                }
            }

            return false;
        });

        // Submenu Accordion functionality
        submenuLinks.click(function(){
            var link = $(this);

            if (link.parent().hasClass('active') !== true) {
                if (link.hasClass('open')) {
                    link.removeClass('open').next().slideUp(upSpeed);
                }
                else {
                    link.closest('ul').find('.submenu-link.open').removeClass('open').next().slideUp(upSpeed);
                    link.addClass('open').next().slideDown(downSpeed);
                }
            }

            return false;
        });
    };

    /* Handle Sidebars, show/hide sidebars */
    var handleSidebars = function(mode) {

        if (mode === 'init') {

            // Init Sidebar Scrolling
            sLScroll.add(sRScroll).slimScroll({ height: sScrollHeight, color: '#fff', size: '3px', touchScrollStep: 100 });
            $(window).resize(function(){ handleSidebars('resize-scroll'); });
            $(window).bind('orientationchange', handleSidebars('resize-scroll'));

            // Init Left Sidebar
            sLToggle.click(function(){ handleSidebars('toggle-left'); });
            $('#sidebar-left')
                .mouseenter(function(){ handleSidebars('open-left'); })
                .mouseleave(function(){ handleSidebars('close-left'); });

            // Init Right Sidebar
            sRToggle.click(function(){ handleSidebars('toggle-right'); });
            $('#sidebar-right')
                .mouseenter(function(){ handleSidebars('open-right'); })
                .mouseleave(function(){ handleSidebars('close-right'); });

            // Init Swipe Functionality
            $('.sidebars-swipe').swipe({
                swipeRight: function(event, direction, distance, duration, fingerCount) {
                    if (body.hasClass('sidebar-right-open')) {
                        handleSidebars('close-right');
                    } else {
                        handleSidebars('open-left');
                    }
                },
                swipeLeft: function(event, direction, distance, duration, fingerCount) {
                    if (body.hasClass('sidebar-left-open')) {
                        handleSidebars('close-left');
                    } else {
                        handleSidebars('open-right');
                    }
                }
            });
        }
        else if (mode === 'resize-scroll') { // Resize Scroll Height

            // 50 is the height of .sidebar-search and .user-info in pixels
            sLScroll.add(sRScroll).css('height', $(window).height() - 51);
        }
        else if (mode === 'open-left') { // Open Left Sidebar

            body.removeClass('sidebar-right-open').addClass('sidebar-left-open');

            sLToggle.parent('li').addClass('active');
            sRToggle.parent('li').removeClass('active');
            sRToggle.blur();
        }
        else if (mode === 'close-left') { // Close Left Sidebar

            body.removeClass('sidebar-left-open');

            sLToggle.parent('li').removeClass('active');
            sLToggle.blur();
        }
        else if (mode === 'toggle-left') { // Toggle Left Sidebar

            body.removeClass('sidebar-right-open').toggleClass('sidebar-left-open');

            sLToggle.parent('li').toggleClass('active');
            if ( ! sLToggle.hasClass('active')) { sLToggle.blur(); }
            sRToggle.parent('li').removeClass('active');
            sRToggle.blur();
        }
        else if (mode === 'open-right') { // Open Right Sidebar

            body.removeClass('sidebar-left-open').addClass('sidebar-right-open');

            sRToggle.parent('li').addClass('active');
            sLToggle.parent('li').removeClass('active');
            sLToggle.blur();
        }
        else if (mode === 'close-right') { // Close Right Sidebar

            body.removeClass('sidebar-right-open');

            sRToggle.parent('li').removeClass('active');
            sRToggle.blur();
        }
        else if (mode === 'toggle-right') { // Toggle Left Sidebar

            body.removeClass('sidebar-left-open').toggleClass('sidebar-right-open');

            sRToggle.parent('li').toggleClass('active');
            if ( ! sRToggle.hasClass('active')) { sRToggle.blur(); }
            sLToggle.parent('li').removeClass('active');
            sLToggle.blur();
        }
    };

    /* Scroll to top functionality */
    var scrollToTop = function() {

        // Get link
        var link = $('#to-top');

        $(window).scroll(function() {
            // If the user scrolled a bit (150 pixels) show the link
            if ($(this).scrollTop() > 150) {
                link.fadeIn(100);
            } else {
                link.fadeOut(100);
            }
        });

        // On click get to top
        link.click(function() {
            $('html, body').animate({scrollTop: 0}, 200);
            return false;
        });
    };

    /* Template Options, change features functionality */
    var templateOptions = function() {

        /*
         * Color Themes
         */
        var colorList = $('.theme-colors');
        var themeLink = $('#theme-link');
        var theme;

        if (themeLink.length) {
            theme = themeLink.attr('href');

            $('li', colorList).removeClass('active');
            $('a[data-theme="' + theme + '"]', colorList).parent('li').addClass('active');
        }

        $('a', colorList).click(function(e){
            // Get theme name
            theme = $(this).data('theme');

            $('li', colorList).removeClass('active');
            $(this).parent('li').addClass('active');

            if (theme === 'default') {
                if (themeLink.length) {
                    themeLink.remove();
                    themeLink = $('#theme-link');
                }
            } else {
                if (themeLink.length) {
                    themeLink.attr('href', theme);
                } else {
                    $('link[href="css/themes.css"]').before('<link id="theme-link" rel="stylesheet" href="' + theme + '">');
                    themeLink = $('#theme-link');
                }
            }
        });

        // Prevent template options dropdown from closing on clicking options
        $('.dropdown-custom a').click(function(e){ e.stopPropagation(); });

        /* Full width page option */
        var pageCon         = $('#page-container');
        var optFwDisable    = $('#options-fw-disable');
        var optFwEnable     = $('#options-fw-enable');

        if (pageCon.hasClass('full-width')) {
            optFwEnable.addClass('active');
        } else {
            optFwDisable.addClass('active');
        }

        optFwDisable.click(function() {
            pageCon.removeClass('full-width');
            $(this).addClass('active');
            optFwEnable.removeClass('active');
        });

        optFwEnable.click(function() {
            pageCon.addClass('full-width');
            $(this).addClass('active');
            optFwDisable.removeClass('active');
        });

        /* Pin Sidebars Option */
        var optPinLeft      = $('#options-pin-left');
        var optPinRight     = $('#options-pin-right');

        if (body.hasClass('sidebar-left-pinned')) {
            optPinLeft.addClass('active');
        }

        if (body.hasClass('sidebar-right-pinned')) {
            optPinRight.addClass('active');
        }

        optPinLeft.click(function() {
            if ($(this).hasClass('active')) {
                body.removeClass('sidebar-left-pinned');
                $(this).removeClass('active');
            }
            else
            {
                body.addClass('sidebar-left-pinned');
                $(this).addClass('active');
            }
        });

        optPinRight.click(function() {
            if ($(this).hasClass('active')) {
                body.removeClass('sidebar-right-pinned');
                $(this).removeClass('active');
            }
            else
            {
                body.addClass('sidebar-right-pinned');
                $(this).addClass('active');
            }
        });

        /* Header options */
        var optHeaderDefault = $('#options-header-default');
        var optHeaderInverse = $('#options-header-inverse');
        var optHeaderTop = $('#options-header-top');
        var optHeaderBottom = $('#options-header-bottom');

        if (header.hasClass('navbar-default')) {
            optHeaderDefault.addClass('active');
        } else {
            optHeaderInverse.addClass('active');
        }

        if (header.hasClass('navbar-fixed-top')) {
            optHeaderTop.addClass('active');
        } else {
            optHeaderBottom.addClass('active');
        }

        optHeaderDefault.click(function() {
            header.removeClass('navbar-inverse').addClass('navbar-default');
            $(this).addClass('active');
            optHeaderInverse.removeClass('active');
        });

        optHeaderInverse.click(function() {
            header.removeClass('navbar-default').addClass('navbar-inverse');
            $(this).addClass('active');
            optHeaderDefault.removeClass('active');
        });

        optHeaderTop.click(function() {
            body.removeClass('header-fixed-bottom').addClass('header-fixed-top');
            header.removeClass('navbar-fixed-bottom').addClass('navbar-fixed-top');
            $(this).addClass('active');
            optHeaderBottom.removeClass('active');
        });

        optHeaderBottom.click(function() {
            body.removeClass('header-fixed-top').addClass('header-fixed-bottom');
            header.removeClass('navbar-fixed-top').addClass('navbar-fixed-bottom');
            $(this).addClass('active');
            optHeaderTop.removeClass('active');
        });

        /* Sidebars mouse hover option */
        var leftSidebar     = $('#sidebar-left');
        var rightSidebar    = $('#sidebar-right');
        var optHoverLeft    = $('#options-hover-left');
        var optHoverRight   = $('#options-hover-right');

        if (leftSidebar.hasClass('enable-hover')) {
            optHoverLeft.addClass('active');
        }

        if (rightSidebar.hasClass('enable-hover')) {
            optHoverRight.addClass('active');
        }

        optHoverLeft.click(function() {
            leftSidebar.toggleClass('enable-hover');
            $(this).toggleClass('active');
        });

        optHoverRight.click(function() {
            rightSidebar.toggleClass('enable-hover');
            $(this).toggleClass('active');
        });

        /* Effect when sidebars open options */
        var fxCon    = $('#fx-container');
        var optEffects  = $('#option-effects');

        $("button[data-fx='" + fxCon.attr('class') + "']", optEffects).addClass('active');

        $('button', optEffects).click(function() {
            fxCon.removeClass().addClass($(this).data('fx'));
            $('button', optEffects).removeClass('active');
            $(this).addClass('active');
        });
    };

    /* Input placeholder for older browsers */
    var oldiePlaceholder = function() {

        // Check if placeholder feature is supported by the browser
        if (!Modernizr.input.placeholder) {
            // If not, add the functionality
            $('[placeholder]').focus(function() {
                var input = $(this);
                if (input.val() === input.attr('placeholder')) {
                    input.val('');
                    input.removeClass('ph');
                }
            }).blur(function() {
                var input = $(this);
                if (input.val() === '' || input.val() === input.attr('placeholder')) {
                    input.addClass('ph');
                    input.val(input.attr('placeholder'));
                }
            }).blur().parents('form').submit(function() {
                $(this).find('[placeholder]').each(function() {
                    var input = $(this);
                    if (input.val() === input.attr('placeholder')) {
                        input.val('');
                    }
                });
            });
        }
    };

    /* Datatables Bootstrap integration */
    var dtIntegration = function() {

        // Set the defaults for DataTables initialization
        $.extend(true, $.fn.dataTable.defaults, {
            "sDom": "<'row'<'col-sm-6 col-xs-5'l><'col-sm-6 col-xs-7'f>r>t<'row'<'col-sm-5 hidden-xs'i><'col-sm-7 col-xs-12 clearfix'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_",
                "sSearch": "<div class=\"input-group\">_INPUT_<span class=\"input-group-addon\"><i class=\"fa fa-search\"></i></span></div>",
                "sInfo": "<strong>_START_</strong>-<strong>_END_</strong> of <strong>_TOTAL_</strong>",
                "oPaginate": {
                    "sPrevious": "",
                    "sNext": ""
                }
            }
        });

        // Default class modification
        $.extend($.fn.dataTableExt.oStdClasses, {
            "sWrapper": "dataTables_wrapper form-inline"
        });

        // API method to get paging information
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        // Bootstrap style pagination control
        $.extend($.fn.dataTableExt.oPagination, {
            "bootstrap": {
                "fnInit": function(oSettings, nPaging, fnDraw) {
                    var oLang = oSettings.oLanguage.oPaginate;
                    var fnClickHandler = function(e) {
                        e.preventDefault();
                        if (oSettings.oApi._fnPageChange(oSettings, e.data.action)) {
                            fnDraw(oSettings);
                        }
                    };

                    $(nPaging).append(
                        '<ul class="pagination pagination-sm remove-margin">' +
                        '<li class="prev disabled"><a href="javascript:void(0)"><i class="fa fa-chevron-left"></i> ' + oLang.sPrevious + '</a></li>' +
                        '<li class="next disabled"><a href="javascript:void(0)">' + oLang.sNext + ' <i class="fa fa-chevron-right"></i></a></li>' +
                        '</ul>'
                        );
                    var els = $('a', nPaging);
                    $(els[0]).bind('click.DT', {action: "previous"}, fnClickHandler);
                    $(els[1]).bind('click.DT', {action: "next"}, fnClickHandler);
                },
                "fnUpdate": function(oSettings, fnDraw) {
                    var iListLength = 5;
                    var oPaging = oSettings.oInstance.fnPagingInfo();
                    var an = oSettings.aanFeatures.p;
                    var i, j, sClass, iStart, iEnd, iHalf = Math.floor(iListLength / 2);

                    if (oPaging.iTotalPages < iListLength) {
                        iStart = 1;
                        iEnd = oPaging.iTotalPages;
                    }
                    else if (oPaging.iPage <= iHalf) {
                        iStart = 1;
                        iEnd = iListLength;
                    } else if (oPaging.iPage >= (oPaging.iTotalPages - iHalf)) {
                        iStart = oPaging.iTotalPages - iListLength + 1;
                        iEnd = oPaging.iTotalPages;
                    } else {
                        iStart = oPaging.iPage - iHalf + 1;
                        iEnd = iStart + iListLength - 1;
                    }

                    for (i = 0, iLen = an.length; i < iLen; i++) {
                        // Remove the middle elements
                        $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                        // Add the new list items and their event handlers
                        for (j = iStart; j <= iEnd; j++) {
                            sClass = (j === oPaging.iPage + 1) ? 'class="active"' : '';
                            $('<li ' + sClass + '><a href="javascript:void(0)">' + j + '</a></li>')
                                .insertBefore($('li:last', an[i])[0])
                                .bind('click', function(e) {
                                e.preventDefault();
                                oSettings._iDisplayStart = (parseInt($('a', this).text(), 10) - 1) * oPaging.iLength;
                                fnDraw(oSettings);
                            });
                        }

                        // Add / remove disabled classes from the static elements
                        if (oPaging.iPage === 0) {
                            $('li:first', an[i]).addClass('disabled');
                        } else {
                            $('li:first', an[i]).removeClass('disabled');
                        }

                        if (oPaging.iPage === oPaging.iTotalPages - 1 || oPaging.iTotalPages === 0) {
                            $('li:last', an[i]).addClass('disabled');
                        } else {
                            $('li:last', an[i]).removeClass('disabled');
                        }
                    }
                }
            }
        });
    };

    return {
        init: function() {
            uiInit(); // Initialize UI Code
            handleSidebars('init'); // Initialize Sidebars Functionality
            handleNav(); // Sidebar Navigation functionality
            scrollToTop(); // Scroll to top functionality
            templateOptions(); // Template Options, change features
            oldiePlaceholder(); // Make input placeholder work in older browsers
        },
        sidebars: function(mode) {
            handleSidebars(mode); // Handle Sidebars Functionality
        },
        datatables: function() {
            dtIntegration(); // Datatables Bootstrap integration
        }
    };
}();

/* Initialize WebApp when page loads */
$(function() { webApp.init(); });