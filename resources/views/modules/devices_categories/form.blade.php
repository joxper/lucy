@extends('layouts.form')

@section('title', $title.' - DevicesCategories')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.DevicesCategories').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\DeviceCategoryController@index') !!}">{{ trans('modules.DevicesCategories') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    {!! Form::group('text', 'color', 'Color', $data['color']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\DeviceCategoryRequest') !!}
@endsection