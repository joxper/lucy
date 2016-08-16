@extends('layouts.view')

@section('title', trans('lucy.word.view').' - TicketsPeople')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.TicketsPeople').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\TicketsPersonController@index') !!}">{{ trans('modules.TicketsPeople') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'user_id', 'User Id', $data['user_id']) !!}
    {!! Form::group('static', 'ticket_id', 'Ticket Id', $data['ticket_id']) !!}
@endsection