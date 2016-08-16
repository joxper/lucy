@extends('layouts.form')

@section('title', $title.' - '.trans('lucy.app.permissions'))

@section('page-header', trans('lucy.app.permissions').' <small>'.$title.'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-key"></i> {{ trans('lucy.app.home') }}</a></li>
        <li><a href="#">{{ trans('lucy.app.user-management') }}</a></li>
        <li><a href="{!! action('Lucy\PermissionController@index') !!}">{{ trans('lucy.app.permissions') }}</a></li>
        <li class="active">{{ $title }}</li>
    </ol>
@endsection

@section('form')
    {!! Form::group('text', 'name', trans('lucy.form.name'), $data['name'], $data['readonly']) !!}
    {!! Form::group('text', 'display_name', trans('lucy.form.display_name'), $data['display_name']) !!}
    {!! Form::group('textarea', 'description', trans('lucy.form.description'), $data['description']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Lucy\PermissionRequest') !!}
@endsection