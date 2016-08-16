@extends('layouts.view')

@section('title', trans('lucy.word.view').' - Hosts')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Hosts').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\HostController@index') !!}">{{ trans('modules.Hosts') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'client_id', 'Client Id', $data['client_id']) !!}
    {!! Form::group('static', 'name', 'Name', $data['name']) !!}
    {!! Form::group('static', 'address', 'Address', $data['address']) !!}
    {!! Form::group('static', 'status', 'Status', $data['status']) !!}
@endsection