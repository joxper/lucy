@extends('layouts.list')

@section('title', 'LicenseCategories')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.LicenseCategories').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.LicenseCategories') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'LicenseCategories List')

@section('add-link', action('Modules\LicenseCategoryController@create'))

@section('table-id', 'license_categories-table')

@section('table-th')
    <th class="center-align">Name</th>
    <th class="center-align">Color</th>
@endsection

@section('ajax-datatables', action('Modules\LicenseCategoryController@datatables'))

@section('datatables-columns')
    {data: 'name', name: 'name'},
    {data: 'color', name: 'color'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection