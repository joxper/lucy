@extends('layouts.form')

@section('title', $title.' - HostsHistory')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.HostsHistory').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\HostsHistoryController@index') !!}">{{ trans('modules.HostsHistory') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'check_id', 'Check Id', $data['check_id'], ['options' => DB::table('hosts_checks')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('text', 'status', 'Status', $data['status']) !!}
    {!! Form::group('text', 'latency', 'Latency', $data['latency']) !!}
    {!! Form::group('text', 'timestamp', 'Timestamp', $data['timestamp']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\HostsHistoryRequest') !!}
@endsection