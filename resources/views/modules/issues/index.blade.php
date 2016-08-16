@extends('layouts.list')

@section('title', 'Issues')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Issues').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Issues') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Issues List')

@section('add-link', action('Modules\IssueController@create'))

@section('table-id', 'issues-table')

@section('table-th')
    <th class="center-align">Client Id</th>
    <th class="center-align">Asset Id</th>
    <th class="center-align">Project Id</th>
    <th class="center-align">User Id</th>
    <th class="center-align">Issue Type</th>
    <th class="center-align">Priority</th>
    <th class="center-align">Status</th>
    <th class="center-align">Name</th>
    <th class="center-align">Description</th>
    <th class="center-align">Duedate</th>
    <th class="center-align">Timespent</th>
    <th class="center-align">Dateadded</th>
@endsection

@section('ajax-datatables', action('Modules\IssueController@datatables'))

@section('datatables-columns')
    {data: 'client_id', name: 'client_id'},
    {data: 'asset_id', name: 'asset_id'},
    {data: 'project_id', name: 'project_id'},
    {data: 'user_id', name: 'user_id'},
    {data: 'issue_type', name: 'issue_type'},
    {data: 'priority', name: 'priority'},
    {data: 'status', name: 'status'},
    {data: 'name', name: 'name'},
    {data: 'description', name: 'description'},
    {data: 'duedate', name: 'duedate'},
    {data: 'timespent', name: 'timespent'},
    {data: 'dateadded', name: 'dateadded'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection