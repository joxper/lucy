@extends('layouts.form')

@section('title', $title.' - '.trans('lucy.app.users'))

@section('header')

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!! Html::style('bower_components/metronic/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
        <!-- END PAGE LEVEL PLUGINS -->

@endsection

@section('page-header', '<div class="page-title"><h1>' . trans('lucy.app.users') . '<small>' . $title . '</small></h1></div>')

@section('breadcrumb')
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{!! action('DashboardController@index') !!}">{{ trans('lucy.app.home') }}</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{!! action('Lucy\UserController@index') !!}">{{ trans('lucy.app.user-management') }}</a>
            <i class="fa fa-circle"></i>
        </li>        
        <li>
            <span class="active">{{ $title }}</span>
        </li>
    </ul>
@endsection

@section('form')
        <div class="row">
            <div class="col-md-9" align="center">
                    @if ($data['avatar'] && file_exists(avatar_path($data['avatar'])))
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">                    
                        <img src="{!! link_to_avatar($data['avatar']) !!}" alt="" lass="img-circle img-responsive"/> 
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                    @else
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                    @endif
                    <div>
                        <span class="btn default btn-file">
                            <span class="fileinput-new"> Select image </span>
                            <span class="fileinput-exists"> Change </span>
                            <input type="file" name="avatar" id="avatar"> </span>
                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                    </div>
                </div>
            </div>
        </div>

    {!! Form::group('text', 'email', trans('lucy.form.email'), $data['email'], $data['readonly']) !!}
    {!! Form::group('text', 'username', trans('lucy.form.username'), $data['username'], $data['readonly']) !!}
    @if (! isset($data['id']))
        {!! Form::group('password', 'password', trans('lucy.form.password')) !!}
    @endif
    <div class="row">
        <div class="col-md-4">
            {!! Form::group('text', 'first_name', trans('lucy.form.first_name'), $data['first_name']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::group('text', 'last_name', trans('lucy.form.last_name'), $data['last_name']) !!}   
        </div>
    </div>
            {!! Form::group('text', 'client_id', trans('lucy.form.user'), $data['client_id']) !!}

            {!! Form::group('select', 'role', trans('lucy.form.role'), $data['role'], ['options' => $data['dropdown']]) !!}
    {!! Form::checkRadio('checkbox', 'is_banned', trans('lucy.form.ban').'?', true, ['class' => 'switch', 'checked' => $data['is_banned'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Lucy\UserRequest') !!}

    {!! Html::script('bower_components/metronic/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}

    <script>
        $(document).ready(function () {
            $('.switch').bootstrapSwitch({
                size: 'small'
            });
        });
    </script>
@endsection