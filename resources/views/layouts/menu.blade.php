<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
<!-- BEGIN SIDEBAR -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="nav-item start {!! (action('DashboardController@index') == Request::url()) ? ' active' : '' !!}">
            <a href="{!! action('DashboardController@index') !!}" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">{{ trans('lucy.app.dashboard') }}</span>
            </a>
        </li>
        @access('crud.view')        
        <li class="heading">
            <h3 class="uppercase">Administration</h3>
        </li>
        @endaccess        
        <li class="nav-item{!! (Request::is('crud*')) ? ' active' : '' !!}  ">
            <a href="{!! action('CrudGeneratorController@index') !!}" class="nav-link nav-toggle">
                <i class="fa fa-cogs"></i>
                <span class="title">{{ trans('lucy.app.crud-generator') }}</span>
            </a>
        </li>
        @access(['users.view', 'roles.view', 'permissions.view'], true)        
        <li class="nav-item  {{ (Request::is('users-management/*')) ? ' active open' : '' }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-briefcase"></i>
                <span class="title">{{ trans('lucy.app.user-management') }}</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                @access('users.view')
                    <li class="nav-item {!! (Request::is('users-management/users*')) ? ' active' : '' !!}">
                        <a href="{!! action('Lucy\UserController@index') !!}" title="{{ trans('lucy.app.users') }}">
                            <i class="fa fa-users"></i> <span>{{ trans('lucy.app.users') }}</span>
                        </a>
                    </li>                          
                @endaccess
                @access('roles.view')
                    <li class="nav-item {!! (Request::is('users-management/roles*')) ? ' active' : '' !!}">
                        <a href="{!! action('Lucy\RoleController@index') !!}" title="{{ trans('lucy.app.roles') }}">
                            <i class="fa fa-user"></i> <span>{{ trans('lucy.app.roles') }}</span>
                        </a>
                    </li>
                @endaccess
                @access('permissions.view')
                    <li class="nav-item {!! (Request::is('users-management/permissions*')) ? ' active' : '' !!}">
                        <a href="{!! action('Lucy\PermissionController@index') !!}" title="{{ trans('lucy.app.permissions') }}">
                            <i class="fa fa-key"></i> <span>{{ trans('lucy.app.permissions') }}</span>
                        </a>
                    </li>
                @endaccess
                @access('logs.view')
                    <li class="nav-item {!! (Request::is('users-management/logs*')) ? ' active' : '' !!}">
                        <a href="{!! action('Lucy\LogController@index') !!}" title="{{ trans('lucy.app.logs') }}">
                            <i class="fa fa-history"></i> <span>{{ trans('lucy.app.logs') }}</span>
                        </a>
                    </li>
                @endaccess
            </ul>
        </li>
        @endaccess
        @access(['settings.*'])
        <li class="nav-item  {{ (Request::is('settings/*')) ? ' active open' : '' }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-briefcase"></i>
                <span class="title">{{ trans('lucy.app.settings') }}</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a> 
            <ul class="sub-menu">           
                @access('settings.general')
                    <li class="nav-item {!! (Request::is('settings/general*')) ? ' active open' : '' !!}">
                        <a href="{!! action('Settings\GeneralController@index') !!}" title="{{ trans('lucy.app.general') }}">
                            <i class="fa fa-desktop"></i> <span>{{ trans('lucy.app.general') }}</span>
                        </a>
                    </li>
                @endaccess
                @access('settings.socialite')
                    <li class="nav-item {!! (Request::is('settings/socialite*')) ? ' active open' : '' !!}">
                        <a href="{!! action('Settings\SocialiteController@index') !!}" title="{{ trans('lucy.app.socialite') }}">
                            <i class="fa fa-share-alt"></i> <span>{{ trans('lucy.app.socialite') }}</span>
                        </a>
                    </li>
                @endaccess
                @access('settings.auth')
                    <li class="nav-item {!! (Request::is('settings/auth*')) ? ' active open' : '' !!}">
                        <a href="{!! action('Settings\AuthController@index') !!}" title="{{ trans('lucy.app.authentication') }}">
                            <i class="fa fa-sign-in"></i> <span>{{ trans('lucy.app.authentication') }}</span>
                        </a>
                    </li>
                @endaccess
                @access('settings.reg')
                    <li class="nav-item {!! (Request::is('settings/reg*')) ? ' active open' : '' !!}">
                        <a href="{!! action('Settings\RegController@index') !!}" title="{{ trans('lucy.app.registration') }}">
                            <i class="fa fa-user-plus"></i> <span>{{ trans('lucy.app.registration') }}</span>
                        </a>
                    </li>
                @endaccess
                @access('settings.mail')
                    <li class="nav-item {!! (Request::is('settings/mail*')) ? ' active open' : '' !!}">
                        <a href="{!! action('Settings\MailController@index') !!}" title="{{ trans('lucy.app.mail') }}">
                            <i class="fa fa-envelope"></i> <span>{{ trans('lucy.app.mail') }}</span>
                        </a>
                    </li>
                @endaccess
            </ul>
        </li>
        @endaccess
        <li>
            <a href="{!! action('DocsController@show') !!}" title="{{ trans('lucy.app.docs') }}" target="_blank">
                <i class="fa fa-book"></i> <span>{{ trans('lucy.app.docs') }}</span>
            </a>
        </li>
        @include('layouts.modules-menu')

    </ul>
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->