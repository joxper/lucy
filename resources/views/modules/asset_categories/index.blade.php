@extends('layouts.list')

@section('title', 'AssetCategories')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.AssetCategories').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.AssetCategories') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'AssetCategories List')

@section('add-link', action('Modules\AssetCategoryController@create'))

@section('table-id', 'asset_categories-table')

@section('table-th')
    <th class="center-align">Name</th>
    <th class="center-align">Color</th>
@endsection

@section('ajax-datatables', action('Modules\AssetCategoryController@datatables'))

@section('datatables-columns')
    {data: 'name', name: 'name'},
    {data: 'color', name: 'color'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection