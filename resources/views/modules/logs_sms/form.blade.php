@extends('layouts.form')

@section('title', $title.' - LogsSms')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.LogsSms').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\LogsSmController@index') !!}">{{ trans('modules.LogsSms') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'user_id', 'User Id', $data['user_id'], ['options' => DB::table('users')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'client_id', 'Client Id', $data['client_id'], ['options' => DB::table('clients')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('text', 'mobile', 'Mobile', $data['mobile']) !!}
    {!! Form::group('text', 'sms', 'Sms', $data['sms']) !!}
    {!! Form::group('text', 'timestamp', 'Timestamp', $data['timestamp']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\LogsSmRequest') !!}
@endsection