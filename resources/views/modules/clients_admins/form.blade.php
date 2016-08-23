@extends('layouts.form')

@section('title', $title.' - ClientsAdmins')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.ClientsAdmins').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\ClientsAdminController@index') !!}">{{ trans('modules.ClientsAdmins') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'user_id', 'User Id', $data['user_id'], ['options' => DB::table('users')->orderBy('id')->lists('username', 'username')]) !!}
    {!! Form::group('select', 'client_id', 'Client Id', $data['client_id'], ['options' => DB::table('clients')->orderBy('id')->lists('id', 'id')]) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\ClientsAdminRequest') !!}
@endsection