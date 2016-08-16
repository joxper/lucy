@extends('layouts.form')

@section('title', $title.' - Suppliers')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Suppliers').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\SupplierController@index') !!}">{{ trans('modules.Suppliers') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    {!! Form::group('textarea', 'address', 'Address', $data['address']) !!}
    {!! Form::group('text', 'contact_name', 'Contact Name', $data['contact_name']) !!}
    {!! Form::group('text', 'phone', 'Phone', $data['phone']) !!}
    {!! Form::group('text', 'email', 'Email', $data['email']) !!}
    {!! Form::group('text', 'web', 'Web', $data['web']) !!}
    {!! Form::group('textarea', 'notes', 'Notes', $data['notes']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\SupplierRequest') !!}
@endsection