@extends('layouts.form')

@section('title', $title.' - Comments')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Comments').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\CommentController@index') !!}">{{ trans('modules.Comments') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'user_id', 'User Id', $data['user_id'], ['options' => DB::table('users')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'client_id', 'Client Id', $data['client_id'], ['options' => DB::table('clients')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'project_id', 'Project Id', $data['project_id'], ['options' => DB::table('projects')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'ticket_id', 'Ticket Id', $data['ticket_id'], ['options' => DB::table('tickets')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'issue_id', 'Issue Id', $data['issue_id'], ['options' => DB::table('issues')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('textarea', 'comment', 'Comment', $data['comment']) !!}
    {!! Form::group('text', 'timestamp', 'Timestamp', $data['timestamp']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\CommentRequest') !!}
@endsection