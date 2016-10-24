@extends('layouts.view')

@section('title', trans('lucy.word.view').' - DevicesCategories')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.DevicesCategories').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\DeviceCategoryController@index') !!}">{{ trans('modules.DevicesCategories') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'name', 'Name', $data['name']) !!}
    {!! Form::group('static', 'color', 'Color', $data['color']) !!}
@endsection