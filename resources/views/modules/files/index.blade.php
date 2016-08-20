@extends('layouts.list')

@section('title', 'Files')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Files').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Files') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Files List')

@section('add-link', action('Modules\FileController@create'))

@section('table-id', 'files-table')

@section('table-th')
    <th class="center-align">Client Id</th>
    <th class="center-align">Project Id</th>
    <th class="center-align">Asset Id</th>
    <th class="center-align">Ticketreply Id</th>
    <th class="center-align">Name</th>
    <th class="center-align">File</th>
@endsection

@section('ajax-datatables', action('Modules\FileController@datatables'))

@section('datatables-columns')
    {data: 'client_id', name: 'client_id'},
    {data: 'project_id', name: 'project_id'},
    {data: 'asset_id', name: 'asset_id'},
    {data: 'ticketreply_id', name: 'ticketreply_id'},
    {data: 'name', name: 'name'},
    {data: 'file', name: 'file'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection