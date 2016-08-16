@extends('layouts.list')

@section('title', 'Comments')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Comments').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Comments') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Comments List')

@section('add-link', action('Modules\CommentController@create'))

@section('table-id', 'comments-table')

@section('table-th')
    <th class="center-align">User Id</th>
    <th class="center-align">Client Id</th>
    <th class="center-align">Project Id</th>
    <th class="center-align">Ticket Id</th>
    <th class="center-align">Issue Id</th>
    <th class="center-align">Comment</th>
    <th class="center-align">Timestamp</th>
@endsection

@section('ajax-datatables', action('Modules\CommentController@datatables'))

@section('datatables-columns')
    {data: 'user_id', name: 'user_id'},
    {data: 'client_id', name: 'client_id'},
    {data: 'project_id', name: 'project_id'},
    {data: 'ticket_id', name: 'ticket_id'},
    {data: 'issue_id', name: 'issue_id'},
    {data: 'comment', name: 'comment'},
    {data: 'timestamp', name: 'timestamp'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection