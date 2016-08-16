@extends('layouts.list')

@section('title', trans('lucy.app.roles'))

@section('page-header', trans('lucy.app.roles').' <small>'.trans('lucy.word.list').'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-user"></i> {{ trans('lucy.app.home') }}</a></li>
        <li><a href="#">{{ trans('lucy.app.user-management') }}</a></li>
        <li class="active">{{ trans('lucy.app.roles') }}</li>
    </ol>
@endsection

@section('table-name', trans('lucy.app.roles-list'))

@section('add-link', action('Lucy\RoleController@create'))

@section('table-id', 'roles-table')

@section('table-th')
    <th class="center-align">{{ trans('lucy.form.slug') }}</th>
    <th class="center-align">{{ trans('lucy.form.name') }}</th>
@endsection

@section('ajax-datatables', action('Lucy\RoleController@datatables'))

@section('datatables-columns')
    {data: 'slug', name: 'slug'},
    {data: 'name', name: 'name'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection