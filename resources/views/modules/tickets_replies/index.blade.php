@extends('layouts.list')

@section('title', 'TicketsReplies')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.TicketsReplies').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.TicketsReplies') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'TicketsReplies List')

@section('add-link', action('Modules\TicketsReplyController@create'))

@section('table-id', 'tickets_replies-table')

@section('table-th')
    <th class="center-align">Ticket Id</th>
    <th class="center-align">User Id</th>
    <th class="center-align">Message</th>
    <th class="center-align">Timestamp</th>
@endsection

@section('ajax-datatables', action('Modules\TicketsReplyController@datatables'))

@section('datatables-columns')
    {data: 'ticket_id', name: 'ticket_id'},
    {data: 'user_id', name: 'user_id'},
    {data: 'message', name: 'message'},
    {data: 'timestamp', name: 'timestamp'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection