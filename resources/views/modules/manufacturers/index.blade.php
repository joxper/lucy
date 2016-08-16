@extends('layouts.list')

@section('title', 'Manufacturers')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Manufacturers').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Manufacturers') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Manufacturers List')

@section('add-link', action('Modules\ManufacturerController@create'))

@section('table-id', 'manufacturers-table')

@section('table-th')
    <th class="center-align">Name</th>
@endsection

@section('ajax-datatables', action('Modules\ManufacturerController@datatables'))

@section('datatables-columns')
    {data: 'name', name: 'name'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection