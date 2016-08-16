@extends('layouts.form')

@section('title', $title.' - Hosts')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Hosts').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\HostController@index') !!}">{{ trans('modules.Hosts') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'client_id', 'Client Id', $data['client_id'], ['options' => DB::table('clients')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    {!! Form::group('text', 'address', 'Address', $data['address']) !!}
    {!! Form::group('text', 'status', 'Status', $data['status']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\HostRequest') !!}
@endsection