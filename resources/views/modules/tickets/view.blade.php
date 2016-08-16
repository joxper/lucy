@extends('layouts.view')

@section('title', trans('lucy.word.view').' - Tickets')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Tickets').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\TicketController@index') !!}">{{ trans('modules.Tickets') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'ticket', 'Ticket', $data['ticket']) !!}
    {!! Form::group('static', 'client_id', 'Client Id', $data['client_id']) !!}
    {!! Form::group('static', 'user_id', 'User Id', $data['user_id']) !!}
    {!! Form::group('static', 'admin_id', 'Admin Id', $data['admin_id']) !!}
    {!! Form::group('static', 'asset_id', 'Asset Id', $data['asset_id']) !!}
    {!! Form::group('static', 'email', 'Email', $data['email']) !!}
    {!! Form::group('static', 'subject', 'Subject', $data['subject']) !!}
    {!! Form::group('static', 'status', 'Status', $data['status']) !!}
    {!! Form::group('static', 'priority', 'Priority', $data['priority']) !!}
    {!! Form::group('static', 'timestamp', 'Timestamp', $data['timestamp']) !!}
    {!! Form::group('static', 'notes', 'Notes', nl2br($data['notes'])) !!}
    {!! Form::group('static', 'ccs', 'Ccs', $data['ccs']) !!}
@endsection