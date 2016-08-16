@extends('layouts.view')

@section('title', trans('lucy.word.view').' - Credentials')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Credentials').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\CredentialController@index') !!}">{{ trans('modules.Credentials') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'client_id', 'Client Id', $data['client_id']) !!}
    {!! Form::group('static', 'asset_id', 'Asset Id', $data['asset_id']) !!}
    {!! Form::group('static', 'type', 'Type', $data['type']) !!}
    {!! Form::group('static', 'username', 'Username', $data['username']) !!}
    {!! Form::group('static', 'password', 'Password', $data['password']) !!}
@endsection