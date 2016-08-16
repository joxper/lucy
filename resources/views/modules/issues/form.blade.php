@extends('layouts.form')

@section('title', $title.' - Issues')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Issues').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\IssueController@index') !!}">{{ trans('modules.Issues') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'client_id', 'Client Id', $data['client_id'], ['options' => DB::table('clients')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'asset_id', 'Asset Id', $data['asset_id'], ['options' => DB::table('assets')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'project_id', 'Project Id', $data['project_id'], ['options' => DB::table('projects')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'user_id', 'User Id', $data['user_id'], ['options' => DB::table('users')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('text', 'issue_type', 'Issue Type', $data['issue_type']) !!}
    {!! Form::group('text', 'priority', 'Priority', $data['priority']) !!}
    {!! Form::group('text', 'status', 'Status', $data['status']) !!}
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    {!! Form::group('textarea', 'description', 'Description', $data['description']) !!}
    {!! Form::group('text', 'duedate', 'Duedate', $data['duedate']) !!}
    {!! Form::group('number', 'timespent', 'Timespent', $data['timespent']) !!}
    {!! Form::group('text', 'dateadded', 'Dateadded', $data['dateadded']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\IssueRequest') !!}
@endsection