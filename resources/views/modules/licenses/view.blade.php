@extends('layouts.view')

@section('title', trans('lucy.word.view').' - Licenses')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Licenses').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\LicenseController@index') !!}">{{ trans('modules.Licenses') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'client_id', 'Client Id', $data['client_id']) !!}
    {!! Form::group('static', 'status_id', 'Status Id', $data['status_id']) !!}
    {!! Form::group('static', 'category_id', 'Category Id', $data['category_id']) !!}
    {!! Form::group('static', 'supplier_id', 'Supplier Id', $data['supplier_id']) !!}
    {!! Form::group('static', 'tag', 'Tag', $data['tag']) !!}
    {!! Form::group('static', 'name', 'Name', $data['name']) !!}
    {!! Form::group('static', 'serial', 'Serial', $data['serial']) !!}
    {!! Form::group('static', 'notes', 'Notes', nl2br($data['notes'])) !!}
@endsection