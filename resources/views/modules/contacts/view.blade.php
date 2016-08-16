@extends('layouts.view')

@section('title', trans('lucy.word.view').' - Contacts')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Contacts').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\ContactController@index') !!}">{{ trans('modules.Contacts') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'name', 'Name', $data['name']) !!}
    {!! Form::group('static', 'email', 'Email', $data['email']) !!}
@endsection