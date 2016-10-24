@extends('layouts.list')

@section('title', 'Labels')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Labels').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Labels') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Labels List')

@section('add-link', action('Modules\LabelController@create'))

@section('table-id', 'labels-table')

@section('table-th')
    <th class="center-align">Name</th>
@endsection

@section('ajax-datatables', action('Modules\LabelController@datatables'))

@section('datatables-columns')
    {data: 'name', name: 'name', class: 'center-align'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection