@extends('layouts.list')

@section('title', 'LcensesAssets')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.LcensesAssets').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.LcensesAssets') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'LcensesAssets List')

@section('add-link', action('Modules\IcensesAssetController@create'))

@section('table-id', 'lcenses_assets-table')

@section('table-th')
    <th class="center-align">License Id</th>
    <th class="center-align">Asset Id</th>
@endsection

@section('ajax-datatables', action('Modules\IcensesAssetController@datatables'))

@section('datatables-columns')
    {data: 'license_id', name: 'license_id'},
    {data: 'asset_id', name: 'asset_id'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection