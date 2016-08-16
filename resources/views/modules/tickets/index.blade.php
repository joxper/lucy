@extends('layouts.list')

@section('title', 'Tickets')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Tickets').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Tickets') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Tickets List')

@section('add-link', action('Modules\TicketController@create'))

@section('table-id', 'tickets-table')

@section('table-th')
    <th class="center-align">Ticket</th>
    <th class="center-align">Client Id</th>
    <th class="center-align">User Id</th>
    <th class="center-align">Admin Id</th>
    <th class="center-align">Asset Id</th>
    <th class="center-align">Email</th>
    <th class="center-align">Subject</th>
    <th class="center-align">Status</th>
    <th class="center-align">Priority</th>
    <th class="center-align">Timestamp</th>
    <th class="center-align">Notes</th>
    <th class="center-align">Ccs</th>
@endsection

@section('ajax-datatables', action('Modules\TicketController@datatables'))

@section('datatables-columns')
    {data: 'ticket', name: 'ticket'},
    {data: 'client_id', name: 'client_id'},
    {data: 'user_id', name: 'user_id'},
    {data: 'admin_id', name: 'admin_id'},
    {data: 'asset_id', name: 'asset_id'},
    {data: 'email', name: 'email'},
    {data: 'subject', name: 'subject'},
    {data: 'status', name: 'status'},
    {data: 'priority', name: 'priority'},
    {data: 'timestamp', name: 'timestamp'},
    {data: 'notes', name: 'notes'},
    {data: 'ccs', name: 'ccs'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection