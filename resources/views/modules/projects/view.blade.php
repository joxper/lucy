@extends('layouts.view')

@section('title', trans('lucy.word.view').' - Projects')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Projects').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\ProjectController@index') !!}">{{ trans('modules.Projects') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'client_id', 'Client Id', $data['client_id']) !!}
    {!! Form::group('static', 'tag', 'Tag', $data['tag']) !!}
    {!! Form::group('static', 'name', 'Name', $data['name']) !!}
    {!! Form::group('static', 'notes', 'Notes', nl2br($data['notes'])) !!}
    {!! Form::group('static', 'description', 'Description', nl2br($data['description'])) !!}
    {!! Form::group('static', 'startdate', 'Startdate', $data['startdate']) !!}
    {!! Form::group('static', 'deadline', 'Deadline', $data['deadline']) !!}
    {!! Form::group('static', 'progress', 'Progress', $data['progress']) !!}
@endsection