@extends('layouts.form')

@section('title', $title.' - Credentials')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Credentials').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\CredentialController@index') !!}">{{ trans('modules.Credentials') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'client_id', 'Client Id', $data['client_id'], ['options' => DB::table('clients')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'asset_id', 'Asset Id', $data['asset_id'], ['options' => DB::table('assets')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('text', 'type', 'Type', $data['type']) !!}
    {!! Form::group('text', 'username', 'Username', $data['username']) !!}
    {!! Form::group('text', 'password', 'Password', $data['password']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\CredentialRequest') !!}
@endsection