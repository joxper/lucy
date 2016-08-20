@extends('layouts.view')

@section('title', trans('lucy.word.view').' - Files')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Files').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\FileController@index') !!}">{{ trans('modules.Files') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'client_id', 'Client Id', $data['client_id']) !!}
    {!! Form::group('static', 'project_id', 'Project Id', $data['project_id']) !!}
    {!! Form::group('static', 'asset_id', 'Asset Id', $data['asset_id']) !!}
    {!! Form::group('static', 'ticketreply_id', 'Ticketreply Id', $data['ticketreply_id']) !!}
    {!! Form::group('static', 'name', 'Name', $data['name']) !!}
    {!! Form::group('static', 'file', 'File', $data['file']) !!}
@endsection