@extends('layouts.list')

@section('title', trans('lucy.app.permissions'))

@section('page-header', trans('lucy.app.permissions').' <small>'.trans('lucy.word.list').'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-key"></i> {{ trans('lucy.app.home') }}</a></li>
        <li><a href="#">{{ trans('lucy.app.user-management') }}</a></li>
        <li class="active">{{ trans('lucy.app.permissions') }}</li>
    </ol>
@endsection

@section('table-name', trans('lucy.app.permissions-list'))

@section('add-link', action('Lucy\PermissionController@create'))

@section('table-id', 'permissions-table')

@section('table-th')
    <th class="center-align">{{ trans('lucy.form.name') }}</th>
    <th class="center-align">{{ trans('lucy.form.description') }}</th>
@endsection

@section('ajax-datatables', action('Lucy\PermissionController@datatables'))

@section('datatables-columns')
    {data: 'display_name', name: 'display_name'},
    {data: 'description', name: 'description'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection