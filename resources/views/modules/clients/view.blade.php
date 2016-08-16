@extends('layouts.view-dash')

@section('title', trans('lucy.word.view').' - Clients')

@section('page-header', '<div class="page-title"><h1>'.$data['name'].'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('header')
{!! Html::style('bower_components/metronic/assets/global/plugins/morris/morris.css') !!}
@endsection


@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\ClientController@index') !!}">{{ trans('modules.Clients') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('tabs')
    <li class="active">
        <a href="#summary" data-toggle="tab" aria-expanded="true"> Summary </a>
    </li>
    <li class="">
        <a href="#assets" data-toggle="tab" aria-expanded="false"> Assets </a>
    </li>
    <li class="">
        <a href="#licenses" data-toggle="tab" aria-expanded="false"> Licenses </a>
    </li>
    <li class="">
        <a href="#projects" data-toggle="tab" aria-expanded="false"> Projects </a>
    </li>    
    <li class="">
        <a href="#issues" data-toggle="tab" aria-expanded="false"> Issues </a>
    </li>
    <li class="">
        <a href="#tickets" data-toggle="tab" aria-expanded="false"> Tickets </a>
    </li>
    <li class="">
        <a href="#credentials" data-toggle="tab" aria-expanded="false"> Credentials </a>
    </li>  
    <li class="">
        <a href="#users" data-toggle="tab" aria-expanded="false"> Users </a>
    </li>
    <li class="">
        <a href="#files" data-toggle="tab" aria-expanded="false"> Files </a>
    </li>  
@endsection

@section('actions')
    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
        <i class="icon-cloud-upload"></i>
    </a>
    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
        <i class="icon-wrench"></i>
    </a>
    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
        <i class="icon-trash"></i>
    </a>
@endsection

@section('tab-content')
	@include('modules.clients.tabs.summary')
	@include('modules.clients.tabs.assets')
	@include('modules.clients.tabs.licenses')
	@include('modules.clients.tabs.projects')
	@include('modules.clients.tabs.issues')
	@include('modules.clients.tabs.tickets')
    @include('modules.clients.tabs.credentials')
    @include('modules.clients.tabs.users')
    @include('modules.clients.tabs.files')
@endsection

@section('scripts')
    {!! Html::script('bower_components/metronic/assets/global/plugins/counterup/jquery.waypoints.min.js') !!}
    {!! Html::script('bower_components/metronic/assets/global/plugins/counterup/jquery.counterup.min.js') !!}
    {!! Html::script('bower_components/metronic/assets/global/plugins/morris/morris.min.js') !!}
    {!! Html::script('bower_components/metronic/assets/global/plugins/morris/raphael-min.js') !!}
    {!! Html::script('bower_components/metronic/assets/pages/scripts/charts-morris.min.js') !!}   
@endsection    
