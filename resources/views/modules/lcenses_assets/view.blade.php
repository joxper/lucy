@extends('layouts.view')

@section('title', trans('lucy.word.view').' - LcensesAssets')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.LcensesAssets').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\IcensesAssetController@index') !!}">{{ trans('modules.LcensesAssets') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'license_id', 'License Id', $data['license_id']) !!}
    {!! Form::group('static', 'asset_id', 'Asset Id', $data['asset_id']) !!}
@endsection