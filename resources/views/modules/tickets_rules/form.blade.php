@extends('layouts.form')

@section('title', $title.' - TicketsRules')

@section('header')
    {!! Html::style('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
    {!! Html::style('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
    {!! Html::style('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
@endsection

@section('page-header', '<div class="page-title"><h1>'.trans('modules.TicketsRules').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\TicketsRuleController@index') !!}">{{ trans('modules.TicketsRules') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('select', 'ticketid', 'Ticketid', $data['ticketid'], ['options' => DB::table('tickets')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::checkRadio('checkbox', 'executed', 'Executed', true, ['class' => 'switch', 'checked' => $data['executed'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    {!! Form::group('text', 'cond_status', 'Cond Status', $data['cond_status']) !!}
    {!! Form::group('text', 'cond_priority', 'Cond Priority', $data['cond_priority']) !!}
    {!! Form::group('text', 'cond_timeelapsed', 'Cond Timeelapsed', $data['cond_timeelapsed']) !!}
    {!! Form::group('text', 'cond_datetime', 'Cond Datetime', $data['cond_datetime']) !!}
    {!! Form::group('text', 'act_status', 'Act Status', $data['act_status']) !!}
    {!! Form::group('text', 'act_priority', 'Act Priority', $data['act_priority']) !!}
    {!! Form::group('select', 'act_assignto', 'Act Assignto', $data['act_assignto'], ['options' => DB::table('users')->orderBy('id')->lists('id', 'id')]) !!}
    {!! Form::checkRadio('checkbox', 'act_notifyadmins', 'Act Notifyadmins', true, ['class' => 'switch', 'checked' => $data['act_notifyadmins'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}
    {!! Form::checkRadio('checkbox', 'act_addreply', 'Act Addreply', true, ['class' => 'switch', 'checked' => $data['act_addreply'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}
    {!! Form::group('textarea', 'reply', 'Reply', $data['reply']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\TicketsRuleRequest') !!}
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