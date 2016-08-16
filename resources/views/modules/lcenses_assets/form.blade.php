@extends('layouts.form')

@section('title', $title.' - LcensesAssets')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.LcensesAssets').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\IcensesAssetController@index') !!}">{{ trans('modules.LcensesAssets') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'license_id', 'License Id', $data['license_id'], ['options' => DB::table('licenses')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'asset_id', 'Asset Id', $data['asset_id'], ['options' => DB::table('assets')->orderBy('id')->lists('id', 'id')]) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\IcensesAssetRequest') !!}
@endsection