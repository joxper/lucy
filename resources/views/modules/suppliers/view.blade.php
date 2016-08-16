@extends('layouts.view')

@section('title', trans('lucy.word.view').' - Suppliers')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Suppliers').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\SupplierController@index') !!}">{{ trans('modules.Suppliers') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'name', 'Name', $data['name']) !!}
    {!! Form::group('static', 'address', 'Address', nl2br($data['address'])) !!}
    {!! Form::group('static', 'contact_name', 'Contact Name', $data['contact_name']) !!}
    {!! Form::group('static', 'phone', 'Phone', $data['phone']) !!}
    {!! Form::group('static', 'email', 'Email', $data['email']) !!}
    {!! Form::group('static', 'web', 'Web', $data['web']) !!}
    {!! Form::group('static', 'notes', 'Notes', nl2br($data['notes'])) !!}
@endsection