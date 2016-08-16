@extends('layouts.list')

@section('title', 'TicketsRules')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.TicketsRules').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.TicketsRules') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'TicketsRules List')

@section('add-link', action('Modules\TicketsRuleController@create'))

@section('table-id', 'tickets_rules-table')

@section('table-th')
    <th class="center-align">Ticketid</th>
    <th class="center-align">Executed</th>
    <th class="center-align">Name</th>
    <th class="center-align">Cond Status</th>
    <th class="center-align">Cond Priority</th>
    <th class="center-align">Cond Timeelapsed</th>
    <th class="center-align">Cond Datetime</th>
    <th class="center-align">Act Status</th>
    <th class="center-align">Act Priority</th>
    <th class="center-align">Act Assignto</th>
    <th class="center-align">Act Notifyadmins</th>
    <th class="center-align">Act Addreply</th>
    <th class="center-align">Reply</th>
@endsection

@section('ajax-datatables', action('Modules\TicketsRuleController@datatables'))

@section('datatables-columns')
    {data: 'ticketid', name: 'ticketid'},
    {data: 'executed', name: 'executed'},
    {data: 'name', name: 'name'},
    {data: 'cond_status', name: 'cond_status'},
    {data: 'cond_priority', name: 'cond_priority'},
    {data: 'cond_timeelapsed', name: 'cond_timeelapsed'},
    {data: 'cond_datetime', name: 'cond_datetime'},
    {data: 'act_status', name: 'act_status'},
    {data: 'act_priority', name: 'act_priority'},
    {data: 'act_assignto', name: 'act_assignto'},
    {data: 'act_notifyadmins', name: 'act_notifyadmins'},
    {data: 'act_addreply', name: 'act_addreply'},
    {data: 'reply', name: 'reply'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection