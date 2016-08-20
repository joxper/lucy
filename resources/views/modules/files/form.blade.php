@extends('layouts.form')

@section('title', $title.' - Files')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Files').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\FileController@index') !!}">{{ trans('modules.Files') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'client_id', 'Client Id', $data['client_id'], ['options' => DB::table('clients')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'project_id', 'Project Id', $data['project_id'], ['options' => DB::table('projects')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'asset_id', 'Asset Id', $data['asset_id'], ['options' => DB::table('assets')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'ticketreply_id', 'Ticketreply Id', $data['ticketreply_id'], ['options' => DB::table('tickets_replies')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    {!! Form::group('text', 'file', 'File', $data['file']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\FileRequest') !!}
@endsection