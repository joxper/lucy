@extends('layouts.list')

@section('title', 'ProjectsAdmins')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.ProjectsAdmins').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.ProjectsAdmins') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'ProjectsAdmins List')

@section('add-link', action('Modules\ProjectsAdminController@create'))

@section('table-id', 'projects_admins-table')

@section('table-th')
    <th class="center-align">Project Id</th>
    <th class="center-align">User Id</th>
@endsection

@section('ajax-datatables', action('Modules\ProjectsAdminController@datatables'))

@section('datatables-columns')
    {data: 'project_id', name: 'project_id'},
    {data: 'user_id', name: 'user_id'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection