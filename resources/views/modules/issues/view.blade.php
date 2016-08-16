@extends('layouts.view')

@section('title', trans('lucy.word.view').' - Issues')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Issues').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\IssueController@index') !!}">{{ trans('modules.Issues') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'client_id', 'Client Id', $data['client_id']) !!}
    {!! Form::group('static', 'asset_id', 'Asset Id', $data['asset_id']) !!}
    {!! Form::group('static', 'project_id', 'Project Id', $data['project_id']) !!}
    {!! Form::group('static', 'user_id', 'User Id', $data['user_id']) !!}
    {!! Form::group('static', 'issue_type', 'Issue Type', $data['issue_type']) !!}
    {!! Form::group('static', 'priority', 'Priority', $data['priority']) !!}
    {!! Form::group('static', 'status', 'Status', $data['status']) !!}
    {!! Form::group('static', 'name', 'Name', $data['name']) !!}
    {!! Form::group('static', 'description', 'Description', nl2br($data['description'])) !!}
    {!! Form::group('static', 'duedate', 'Duedate', $data['duedate']) !!}
    {!! Form::group('static', 'timespent', 'Timespent', $data['timespent']) !!}
    {!! Form::group('static', 'dateadded', 'Dateadded', $data['dateadded']) !!}
@endsection