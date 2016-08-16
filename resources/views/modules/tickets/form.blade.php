@extends('layouts.form')

@section('title', $title.' - Tickets')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Tickets').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\TicketController@index') !!}">{{ trans('modules.Tickets') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('number', 'ticket', 'Ticket', $data['ticket']) !!}
    {!! Form::group('select', 'client_id', 'Client Id', $data['client_id'], ['options' => DB::table('clients')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'user_id', 'User Id', $data['user_id'], ['options' => DB::table('users')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'admin_id', 'Admin Id', $data['admin_id'], ['options' => DB::table('users')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('select', 'asset_id', 'Asset Id', $data['asset_id'], ['options' => DB::table('assets')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('text', 'email', 'Email', $data['email']) !!}
    {!! Form::group('text', 'subject', 'Subject', $data['subject']) !!}
    {!! Form::group('text', 'status', 'Status', $data['status']) !!}
    {!! Form::group('text', 'priority', 'Priority', $data['priority']) !!}
    {!! Form::group('text', 'timestamp', 'Timestamp', $data['timestamp']) !!}
    {!! Form::group('textarea', 'notes', 'Notes', $data['notes']) !!}
    {!! Form::group('text', 'ccs', 'Ccs', $data['ccs']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\TicketRequest') !!}
@endsection