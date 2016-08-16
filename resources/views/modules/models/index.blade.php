@extends('layouts.list')

@section('title', 'Models')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Models').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Models') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Models List')

@section('add-link', action('Modules\ModelController@create'))

@section('table-id', 'models-table')

@section('table-th')
    <th class="center-align">Manufacturer Id</th>
    <th class="center-align">Name</th>
@endsection

@section('ajax-datatables', action('Modules\ModelController@datatables'))

@section('datatables-columns')
    {data: 'manufacturer_id', name: 'manufacturer_id'},
    {data: 'name', name: 'name'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection