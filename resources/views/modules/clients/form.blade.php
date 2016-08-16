@extends('layouts.form')

@section('title', $title.' - Clients')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Clients').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\ClientController@index') !!}">{{ trans('modules.Clients') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    {!! Form::group('text', 'asset_tag_prefix', 'Asset Tag Prefix', $data['asset_tag_prefix']) !!}
    {!! Form::group('text', 'license_tag_prefix', 'License Tag Prefix', $data['license_tag_prefix']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\ClientRequest') !!}
@endsection