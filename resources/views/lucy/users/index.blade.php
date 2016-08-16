@extends('layouts.list')

@section('title', trans('lucy.app.users'))

@section('page-header')
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>{{ trans('lucy.app.users') }}
            <small>{{ trans('lucy.word.list') }}</small>
        </h1>
    </div>
    <!-- END PAGE TITLE -->
@endsection

@section('breadcrumb')
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{!! action('DashboardController@index') !!}">{{ trans('lucy.app.home') }}</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">{{ trans('lucy.app.user-management') }}</a>
            <i class="fa fa-circle"></i>
        </li>        
        <li>
            <span class="active">{{ trans('lucy.app.users') }}</span>
        </li>
    </ul>
@endsection

@section('table-name', trans('lucy.app.users-list'))

@section('add-link', action('Lucy\UserController@create'))

@section('table-id', 'users-table')

@section('table-th')
    <th class="center-align">{{ trans('lucy.form.name') }}</th>
    <th class="center-align">{{ trans('lucy.form.username') }}</th>
    <th class="center-align">{{ trans('lucy.form.email') }}</th>
    <th class="center-align">{{ trans('lucy.form.role') }}</th>
@endsection

@section('ajax-datatables', action('Lucy\UserController@datatables'))

@section('datatables-columns')
    {data: 'full_name', name: 'full_name'},
    {data: 'username', name: 'username'},
    {data: 'email', name: 'email'},
    {data: 'role', name: 'role', searchable: false},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection