@extends('layouts.list')

@section('title', 'TicketsPeople')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.TicketsPeople').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.TicketsPeople') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'TicketsPeople List')

@section('add-link', action('Modules\TicketsPersonController@create'))

@section('table-id', 'tickets_people-table')

@section('table-th')
    <th class="center-align">User Id</th>
    <th class="center-align">Ticket Id</th>
@endsection

@section('ajax-datatables', action('Modules\TicketsPersonController@datatables'))

@section('datatables-columns')
    {data: 'user_id', name: 'user_id'},
    {data: 'ticket_id', name: 'ticket_id'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection