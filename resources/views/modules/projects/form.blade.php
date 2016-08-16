@extends('layouts.form')

@section('title', $title.' - Projects')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Projects').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\ProjectController@index') !!}">{{ trans('modules.Projects') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'client_id', 'Client Id', $data['client_id'], ['options' => DB::table('clients')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('text', 'tag', 'Tag', $data['tag']) !!}
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    {!! Form::group('textarea', 'notes', 'Notes', $data['notes']) !!}
    {!! Form::group('textarea', 'description', 'Description', $data['description']) !!}
    {!! Form::group('text', 'startdate', 'Startdate', $data['startdate']) !!}
    {!! Form::group('text', 'deadline', 'Deadline', $data['deadline']) !!}
    {!! Form::group('number', 'progress', 'Progress', $data['progress']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\ProjectRequest') !!}
@endsection