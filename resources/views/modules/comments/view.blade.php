@extends('layouts.view')

@section('title', trans('lucy.word.view').' - Comments')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Comments').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\CommentController@index') !!}">{{ trans('modules.Comments') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'user_id', 'User Id', $data['user_id']) !!}
    {!! Form::group('static', 'client_id', 'Client Id', $data['client_id']) !!}
    {!! Form::group('static', 'project_id', 'Project Id', $data['project_id']) !!}
    {!! Form::group('static', 'ticket_id', 'Ticket Id', $data['ticket_id']) !!}
    {!! Form::group('static', 'issue_id', 'Issue Id', $data['issue_id']) !!}
    {!! Form::group('static', 'comment', 'Comment', nl2br($data['comment'])) !!}
    {!! Form::group('static', 'timestamp', 'Timestamp', $data['timestamp']) !!}
@endsection