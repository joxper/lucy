@extends('layouts.app')

@section('title', trans('lucy.app.profile'))

@section('page-header', trans('lucy.app.profile'))

@section('header')
    @yield('page-styles')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! Html::style('bower_components/metronic/assets/pages/css/profile.min.css') !!}
    <!-- END PAGE LEVEL STYLES -->
@endsection

@section('breadcrumb')
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{!! action('DashboardController@index') !!}">{{ trans('lucy.app.home') }}</a>
            <i class="fa fa-circle"></i>
        </li>     
        <li>
            <span class="active">{{ trans('lucy.app.profile') }}</span>
        </li>
    </ul>
@include('flash::message')
@endsection

@section('content')
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet bordered">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    @if ($user['avatar'] && file_exists(avatar_path($user['avatar'])))
                        <img src="{!! link_to_avatar($user['avatar']) !!}" width="120" class="img-circle img-responsive">
                    @endif           
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> {!! $user['first_name'] . " " . $user['last_name'] !!}</div>
                    <div class="profile-usertitle-job"> {!! $user['username'] !!} </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                    <button type="button" class="btn btn-circle red btn-sm">Message</button>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="{!! (Request::is('profile')) ? ' active' : '' !!}  ">
                            <a href="{!! action('ProfileController@index') !!}">
                                <i class="icon-home"></i> {{ trans('lucy.app.profile') }} </a>
                        <li class="{!! (Request::is('profile/settings')) ? ' active' : '' !!}  ">
                            <a href="{!! action('ProfileController@settings') !!}">
                                <i class="icon-settings"></i> {{ trans('lucy.app.profile-settings') }} </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->
            <!-- PORTLET MAIN -->
            <div class="portlet light bordered">
                <!-- STAT -->
                <div class="row list-separated profile-stat">
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> 37 </div>
                        <div class="uppercase profile-stat-text"> Projects </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> 51 </div>
                        <div class="uppercase profile-stat-text"> Tasks </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> 61 </div>
                        <div class="uppercase profile-stat-text"> Uploads </div>
                    </div>
                </div>
                <!-- END STAT -->
                <div>
                    <h4 class="profile-desc-title">About Marcus Doe</h4>
                    <span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-globe"></i>
                        <a href="http://www.keenthemes.com">www.keenthemes.com</a>
                    </div>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-twitter"></i>
                        <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
                    </div>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-facebook"></i>
                        <a href="http://www.facebook.com/keenthemes/">keenthemes</a>
                    </div>
                </div>
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        @yield('profile-content')
        <!-- END PROFILE CONTENT -->
    </div>

@endsection

@section('scripts')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    @yield('page-scripts')
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    {!! Html::script('bower_components/metronic/assets/pages/scripts/profile.min.js') !!}
    <!-- END PAGE LEVEL SCRIPTS -->

@endsection