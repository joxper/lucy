@extends('layouts.list')

@section('title', 'Projects')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Projects').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Projects') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Projects List')

@section('add-link', action('Modules\ProjectController@create'))

@section('table-id', 'projects-table')

@section('table-th')
    <th class="center-align">Client Id</th>
    <th class="center-align">Tag</th>
    <th class="center-align">Name</th>
    <th class="center-align">Notes</th>
    <th class="center-align">Description</th>
    <th class="center-align">Startdate</th>
    <th class="center-align">Deadline</th>
    <th class="center-align">Progress</th>
@endsection

@section('ajax-datatables', action('Modules\ProjectController@datatables'))

@section('datatables-columns')
    {data: 'client_id', name: 'client_id'},
    {data: 'tag', name: 'tag'},
    {data: 'name', name: 'name'},
    {data: 'notes', name: 'notes'},
    {data: 'description', name: 'description'},
    {data: 'startdate', name: 'startdate'},
    {data: 'deadline', name: 'deadline'},
    {data: 'progress', name: 'progress'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection