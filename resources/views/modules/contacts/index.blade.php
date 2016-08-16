@extends('layouts.list')

@section('title', 'Contacts')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Contacts').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Contacts') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Contacts List')

@section('add-link', action('Modules\ContactController@create'))

@section('table-id', 'contacts-table')

@section('table-th')
    <th class="center-align">Name</th>
    <th class="center-align">Email</th>
@endsection

@section('ajax-datatables', action('Modules\ContactController@datatables'))

@section('datatables-columns')
    {data: 'name', name: 'name'},
    {data: 'email', name: 'email'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection