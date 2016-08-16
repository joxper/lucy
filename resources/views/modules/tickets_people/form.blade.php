@extends('layouts.form')

@section('title', $title.' - TicketsPeople')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.TicketsPeople').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\TicketsPersonController@index') !!}">{{ trans('modules.TicketsPeople') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'user_id', 'User Id', $data['user_id'], ['options' => DB::table('users')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'ticket_id', 'Ticket Id', $data['ticket_id'], ['options' => DB::table('tickets')->orderBy('id')->lists('id', 'id')]) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\TicketsPersonRequest') !!}
@endsection