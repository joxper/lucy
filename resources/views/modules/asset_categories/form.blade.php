@extends('layouts.form')

@section('title', $title.' - AssetCategories')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.AssetCategories').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\AssetCategoryController@index') !!}">{{ trans('modules.AssetCategories') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    {!! Form::group('text', 'color', 'Color', $data['color']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\AssetCategoryRequest') !!}
@endsection