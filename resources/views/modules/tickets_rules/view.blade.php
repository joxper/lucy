@extends('layouts.view')

@section('title', trans('lucy.word.view').' - TicketsRules')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.TicketsRules').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\TicketsRuleController@index') !!}">{{ trans('modules.TicketsRules') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'ticketid', 'Ticketid', $data['ticketid']) !!}
    {!! Form::group('static', 'executed', 'Executed', $data['executed']) !!}
    {!! Form::group('static', 'name', 'Name', $data['name']) !!}
    {!! Form::group('static', 'cond_status', 'Cond Status', $data['cond_status']) !!}
    {!! Form::group('static', 'cond_priority', 'Cond Priority', $data['cond_priority']) !!}
    {!! Form::group('static', 'cond_timeelapsed', 'Cond Timeelapsed', $data['cond_timeelapsed']) !!}
    {!! Form::group('static', 'cond_datetime', 'Cond Datetime', $data['cond_datetime']) !!}
    {!! Form::group('static', 'act_status', 'Act Status', $data['act_status']) !!}
    {!! Form::group('static', 'act_priority', 'Act Priority', $data['act_priority']) !!}
    {!! Form::group('static', 'act_assignto', 'Act Assignto', $data['act_assignto']) !!}
    {!! Form::group('static', 'act_notifyadmins', 'Act Notifyadmins', $data['act_notifyadmins']) !!}
    {!! Form::group('static', 'act_addreply', 'Act Addreply', $data['act_addreply']) !!}
    {!! Form::group('static', 'reply', 'Reply', nl2br($data['reply'])) !!}
@endsection