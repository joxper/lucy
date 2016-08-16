@extends('layouts.form')

@section('title', $title.' - HostsChecks')

@section('header')
    {!! Html::style('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
    {!! Html::style('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
    {!! Html::style('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
@endsection

@section('page-header', '<div class="page-title"><h1>'.trans('modules.HostsChecks').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\HostsCheckController@index') !!}">{{ trans('modules.HostsChecks') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'host_id', 'Host Id', $data['host_id'], ['options' => DB::table('hosts')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    {!! Form::group('text', 'type', 'Type', $data['type']) !!}
    {!! Form::group('text', 'port', 'Port', $data['port']) !!}
    {!! Form::checkRadio('checkbox', 'monitoring', 'Monitoring', true, ['class' => 'switch', 'checked' => $data['monitoring'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}
    {!! Form::checkRadio('checkbox', 'email', 'Email', true, ['class' => 'switch', 'checked' => $data['email'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}
    {!! Form::checkRadio('checkbox', 'sms', 'Sms', true, ['class' => 'switch', 'checked' => $data['sms'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}
    {!! Form::group('text', 'status', 'Status', $data['status']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\HostsCheckRequest') !!}
    {!! Html::script('bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') !!}
    {!! Html::script('bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') !!}
    {!! Html::script('bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') !!}

    <script>
        $(document).ready(function () {
            $('.switch').bootstrapSwitch({
                size: 'small'
            });

            $('.switch').bootstrapSwitch({
                size: 'small'
            });

            $('.switch').bootstrapSwitch({
                size: 'small'
            });
        });
    </script>
@endsection