<!DOCTYPE html>
<html>
    <head>
        {!! Html::meta(null, null, ['charset' => 'utf-8']) !!}
        {!! Html::meta(null, 'IE=edge,chrome=1', ['http-equiv' => 'X-UA-Compatible']) !!}
        {!! Html::meta('robots', 'noindex, nofollow') !!}
        {!! Html::meta('csrf-token', csrf_token()) !!}
        {!! Html::meta('product', lucy_config('APP_NAME')) !!}
        {!! Html::meta('description', lucy_config('APP_DESC')) !!}
        {!! Html::meta('author', 'Roni Yusuf Manalu') !!}
        {!! Html::meta('viewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') !!}

        <title>@yield('title') - {{ lucy_config('APP_NAME') }}</title>


        <!-- BEGIN GLOBAL MANDATORY STYLES -->

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

       {!! Html::style('assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}
       {!! Html::style('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
       {!! Html::style('assets/global/plugins/bootstrap/css/bootstrap.min.css') !!}
       {!! Html::style('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
        <!-- END GLOBAL MANDATORY STYLES -->


        <!-- BEGIN THEME GLOBAL STYLES -->
       {!! Html::style('assets/global/css/components-md.min.css', ['id'=>'style_components']); !!}
       {!! Html::style('assets/global/css/plugins-md.css') !!}
        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->
       {!! Html::style('assets/layouts/layout4/css/layout.min.css') !!}
       {!! Html::style('assets/layouts/layout4/css/themes/default.min.css', ['id'=>'style_color']); !!}
       {!! Html::style('assets/layouts/layout4/css/custom.css') !!}
        <!-- END THEME LAYOUT STYLES -->



        @yield('header')


        <link rel="icon" type="image/png" sizes="32x32" href="{!! asset('favicon.png') !!}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">

                <!-- BEGIN LOGO -->
                 <div class="page-logo">
                    <a href="{!! action('DashboardController@index') !!}" class="logo" title="{{ lucy_config('APP_NAME') }}">
                        <span class="logo-mini"><b>{{ lucy_config('APP_INITIAL') }}</b></span>
                        <span class="logo-lg"><b><h2>{{ lucy_config('APP_NAME') }}</h2></b></span>
                    </a>
                    <div class="menu-toggler sidebar-toggler"></div>
                </div>
                <!-- END LOGO -->


                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                        <!-- BEGIN PAGE ACTIONS -->
                        <!-- DOC: Remove "hide" class to enable the page header actions -->
                        <div class="page-actions">
                            <div class="btn-group">
                                <button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="hidden-sm hidden-xs">Actions&nbsp;</span>
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-docs"></i> New Post </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-tag"></i> New Comment </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-share"></i> Share </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-flag"></i> Comments
                                            <span class="badge badge-success">4</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-users"></i> Feedbacks
                                            <span class="badge badge-danger">2</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- END PAGE ACTIONS -->
                        <!-- BEGIN PAGE TOP -->
                        <div class="page-top">
                            <!-- BEGIN HEADER SEARCH BOX -->
                            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                            <form class="search-form" action="page_general_search_2.html" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control input-sm" placeholder="Search..." name="query">
                                    <span class="input-group-btn">
                                        <a href="javascript:;" class="btn submit">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </span>
                                </div>
                            </form>
                            <!-- END HEADER SEARCH BOX -->
                           <!-- BEGIN TOP NAVIGATION MENU -->
                            <div class="top-menu">
                                <ul class="nav navbar-nav pull-right">
                                    <li class="separator hide"> </li>
                                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                                    <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <i class="icon-bell"></i>
                                            <span class="badge badge-success"> 7 </span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="external">
                                                <h3>
                                                    <span class="bold">12 pending</span> notifications</h3>
                                                <a href="page_user_profile_1.html">view all</a>
                                            </li>
                                            <li>
                                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="time">just now</span>
                                                            <span class="details">
                                                                <span class="label label-sm label-icon label-success">
                                                                    <i class="fa fa-plus"></i>
                                                                </span> New user registered. </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="time">3 mins</span>
                                                            <span class="details">
                                                                <span class="label label-sm label-icon label-danger">
                                                                    <i class="fa fa-bolt"></i>
                                                                </span> Server #12 overloaded. </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="time">10 mins</span>
                                                            <span class="details">
                                                                <span class="label label-sm label-icon label-warning">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </span> Server #2 not responding. </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="time">14 hrs</span>
                                                            <span class="details">
                                                                <span class="label label-sm label-icon label-info">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </span> Application error. </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="time">2 days</span>
                                                            <span class="details">
                                                                <span class="label label-sm label-icon label-danger">
                                                                    <i class="fa fa-bolt"></i>
                                                                </span> Database overloaded 68%. </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="time">3 days</span>
                                                            <span class="details">
                                                                <span class="label label-sm label-icon label-danger">
                                                                    <i class="fa fa-bolt"></i>
                                                                </span> A user IP blocked. </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="time">4 days</span>
                                                            <span class="details">
                                                                <span class="label label-sm label-icon label-warning">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </span> Storage Server #4 not responding dfdfdfd. </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="time">5 days</span>
                                                            <span class="details">
                                                                <span class="label label-sm label-icon label-info">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </span> System Error. </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="time">9 days</span>
                                                            <span class="details">
                                                                <span class="label label-sm label-icon label-danger">
                                                                    <i class="fa fa-bolt"></i>
                                                                </span> Storage server failed. </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- END NOTIFICATION DROPDOWN -->
                                    <li class="separator hide"> </li>
                                    <!-- BEGIN INBOX DROPDOWN -->
                                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                                    <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <i class="icon-envelope-open"></i>
                                            <span class="badge badge-danger"> 4 </span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="external">
                                                <h3>You have
                                                    <span class="bold">7 New</span> Messages</h3>
                                                <a href="app_inbox.html">view all</a>
                                            </li>
                                            <li>
                                                <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                                    <li>
                                                        <a href="#">
                                                            <span class="photo">
                                                                <img src="/assets/layouts/layout4/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                            <span class="subject">
                                                                <span class="from"> Lisa Wong </span>
                                                                <span class="time">Just Now </span>
                                                            </span>
                                                            <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <span class="photo">
                                                                <img src="/assets/layouts/layout4/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                            <span class="subject">
                                                                <span class="from"> Richard Doe </span>
                                                                <span class="time">16 mins </span>
                                                            </span>
                                                            <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <span class="photo">
                                                                <img src="/assets/layouts/layout4/img/avatar1.jpg" class="img-circle" alt=""> </span>
                                                            <span class="subject">
                                                                <span class="from"> Bob Nilson </span>
                                                                <span class="time">2 hrs </span>
                                                            </span>
                                                            <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <span class="photo">
                                                                <img src="/assets/layouts/layout4/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                            <span class="subject">
                                                                <span class="from"> Lisa Wong </span>
                                                                <span class="time">40 mins </span>
                                                            </span>
                                                            <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <span class="photo">
                                                                <img src="/assets/layouts/layout4/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                            <span class="subject">
                                                                <span class="from"> Richard Doe </span>
                                                                <span class="time">46 mins </span>
                                                            </span>
                                                            <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- END INBOX DROPDOWN -->
                                    <li class="separator hide"> </li>
                                    <!-- BEGIN TODO DROPDOWN -->
                                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                                    <li class="dropdown dropdown-extended dropdown-tasks dropdown-dark" id="header_task_bar">
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <i class="icon-calendar"></i>
                                            <span class="badge badge-primary"> 3 </span>
                                        </a>
                                        <ul class="dropdown-menu extended tasks">
                                            <li class="external">
                                                <h3>You have
                                                    <span class="bold">12 pending</span> tasks</h3>
                                                <a href="?p=page_todo_2">view all</a>
                                            </li>
                                            <li>
                                                <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="task">
                                                                <span class="desc">New release v1.2 </span>
                                                                <span class="percent">30%</span>
                                                            </span>
                                                            <span class="progress">
                                                                <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                    <span class="sr-only">40% Complete</span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="task">
                                                                <span class="desc">Application deployment</span>
                                                                <span class="percent">65%</span>
                                                            </span>
                                                            <span class="progress">
                                                                <span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                                    <span class="sr-only">65% Complete</span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="task">
                                                                <span class="desc">Mobile app release</span>
                                                                <span class="percent">98%</span>
                                                            </span>
                                                            <span class="progress">
                                                                <span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
                                                                    <span class="sr-only">98% Complete</span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="task">
                                                                <span class="desc">Database migration</span>
                                                                <span class="percent">10%</span>
                                                            </span>
                                                            <span class="progress">
                                                                <span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                                    <span class="sr-only">10% Complete</span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="task">
                                                                <span class="desc">Web server upgrade</span>
                                                                <span class="percent">58%</span>
                                                            </span>
                                                            <span class="progress">
                                                                <span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                                                    <span class="sr-only">58% Complete</span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="task">
                                                                <span class="desc">Mobile development</span>
                                                                <span class="percent">85%</span>
                                                            </span>
                                                            <span class="progress">
                                                                <span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                                    <span class="sr-only">85% Complete</span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <span class="task">
                                                                <span class="desc">New UI release</span>
                                                                <span class="percent">38%</span>
                                                            </span>
                                                            <span class="progress progress-striped">
                                                                <span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                                                                    <span class="sr-only">38% Complete</span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- END TODO DROPDOWN -->
                                    <!-- BEGIN USER LOGIN DROPDOWN -->
                                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                                    <li class="dropdown dropdown-user dropdown-dark">
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <span class="username username-hide-on-mobile"> {{ user_info('full_name') }} </span>
                                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                            <img src="{{ link_to_avatar(user_info('avatar')) }}" alt="{{ user_info('full_name') }}" class="img-circle">
                                            <i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-default">
                                            <li>
                                                 <a href="{!! action('ProfileController@index') !!}"><i class="icon-user"></i> {{ trans('lucy.app.profile') }}</a>
                                            </li>
                                            <li>
                                                <a href="app_calendar.html">
                                                    <i class="icon-calendar"></i> My Calendar </a>
                                            </li>
                                            <li>
                                                <a href="app_inbox.html">
                                                    <i class="icon-envelope-open"></i> My Inbox
                                                    <span class="badge badge-danger"> 3 </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="app_todo_2.html">
                                                    <i class="icon-rocket"></i> My Tasks
                                                    <span class="badge badge-success"> 7 </span>
                                                </a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="page_user_lock_1.html">
                                                    <i class="icon-lock"></i> Lock Screen </a>
                                            </li>
                                            <li>
                                                <a href="{!! action('Auth\AuthController@getLogout') !!}"><i class="icon-key"></i> {{ trans('lucy.auth.log-out') }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- END USER LOGIN DROPDOWN -->
                                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                                    <li class="dropdown dropdown-extended quick-sidebar-toggler">
                                        <span class="sr-only">Toggle Quick Sidebar</span>
                                        <i class="icon-logout"></i>
                                    </li>
                                    <!-- END QUICK SIDEBAR TOGGLER -->
                                </ul>
                            </div>
                        </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDE MENU -->
            @include('layouts.menu')
            <!-- END SIDE MENU -->
             <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        @yield('page-header')
                        @include('layouts.toolbar')
                        <div style="float: right;">
                        <!-- BEGIN PAGE BREADCRUMB -->
                        @yield('breadcrumb')
                        <!-- END PAGE BREADCRUMB -->
                        </div>
                    </div>
                    <!-- END PAGE HEAD-->
                    <div class="row">
                        @include('flash::message')
                    </div>
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        @yield('content')
                    </div>

                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            @include('layouts.quickbar')
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> {!! date('Y') !!} &copy; JorgV
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>



<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js')!!}></script>
<script src=" assets/global/plugins/excanvas.min.js')!!}></script>
<![endif]-->


<!-- BEGIN CORE PLUGINS -->
{!! Html::script('assets/global/plugins/jquery.min.js') !!}
{!! Html::script('assets/global/plugins/bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('assets/global/plugins/js.cookie.min.js') !!}
{!! Html::script('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}
{!! Html::script('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
{!! Html::script('assets/global/plugins/jquery.blockui.min.js') !!}
{!! Html::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
<!-- END CORE PLUGINS -->



<!-- BEGIN THEME GLOBAL SCRIPTS -->
{!! Html::script('assets/global/scripts/app.min.js') !!}
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
{!! Html::script('assets/layouts/layout4/scripts/layout.min.js') !!}
{!! Html::script('assets/layouts/layout4/scripts/demo.min.js') !!}
{!! Html::script('assets/layouts/global/scripts/quick-sidebar.min.js') !!}
<!-- END THEME LAYOUT SCRIPTS -->
    
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        @yield('scripts')
        <!-- END PAGE LEVEL SCRIPTS -->
    </body>
</html>