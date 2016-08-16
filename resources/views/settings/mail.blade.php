@extends('layouts.app')

@section('title', trans('lucy.app.mail').' - '.trans('lucy.app.settings'))

@section('header')
    {!! Html::style('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
@endsection

@section('page-header', trans('lucy.app.mail').' <small>'.trans('lucy.app.settings').'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-envelope"></i> {{ trans('lucy.app.home') }}</a></li>
        <li><a href="#">{{ trans('lucy.app.settings') }}</a></li>
        <li class="active">{{ trans('lucy.app.mail') }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('lucy.app.mail') }}</h3>
                </div>
                {!! Form::horizontal($form) !!}
                    <div class="box-body">
                        @include('flash::message')
                        {!! Form::checkRadio('checkbox', 'mail_enable', trans('lucy.form.mail-enable'), true, ['class' => 'switch', 'checked' => $data['mail_enable'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}
                        {!! Form::checkRadio('checkbox', 'mail_queue', trans('lucy.form.use-queue'), true, ['class' => 'switch', 'checked' => $data['mail_queue'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no'), 'help_block' => trans('lucy.app.use-queue')]) !!}
                        {!! Form::group('select', 'mail_driver', trans('lucy.form.mail-driver'), $data['mail_driver'], ['options' => $data['dropdown']]) !!}
                        <div id="mail-smtp-driver">
                            {!! Form::group('text', 'mail_host', trans('lucy.form.mail-host'), $data['mail_host']) !!}
                            {!! Form::group('text', 'mail_port', trans('lucy.form.mail-port'), $data['mail_port']) !!}
                            {!! Form::group('text', 'mail_username', trans('lucy.form.mail-username'), $data['mail_username']) !!}
                            {!! Form::group('password', 'mail_password', trans('lucy.form.mail-password'), null) !!}
                        </div>
                        <div id="mail-sendmail-driver">
                            {!! Form::group('text', 'mail_sendmail_path', trans('lucy.form.mail-sendmail-path'), $data['mail_sendmail_path']) !!}
                        </div>
                        {!! Form::group('select', 'mail_encryption', trans('lucy.form.mail-encryption'), $data['mail_encryption'], ['options' => ['tls' => 'TLS'], 'placeholder' => trans('lucy.word.none')]) !!}
                        {!! Form::group('text', 'mail_from_address', trans('lucy.form.mail-from-addr'), $data['mail_from_address']) !!}
                        {!! Form::group('text', 'mail_from_name', trans('lucy.form.mail-from-name'), $data['mail_from_name']) !!}
                    </div>
                    <div class="box-footer">
                        {!! Form::submit(trans('lucy.word.save'), ['class' => 'btn btn-primary pull-right', 'title' => trans('lucy.word.save'), 'id' => 'mail_submit']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') !!}

    <script>
        $(document).ready(function () {
            $('.switch').bootstrapSwitch({
                size: 'small'
            });

            var mail_driver_form = ['sendmail', 'smtp'];

            function show_hide_mail_form() {
                var mail_driver = $('#mail_driver').val();

                $.each(mail_driver_form, function (i, value) {
                    $('#mail-'+value+'-driver').hide();
                });

                if (-1 !== $.inArray(mail_driver, mail_driver_form)) {
                    $('#mail-'+mail_driver+'-driver').show();
                }
            }

            function enable_disable_mail_form() {
                if ($('#mail_enable').is(':checked')) {
                    $('#form-mail :input:not(#mail_enable, #mail_submit, input[name="_token"], input[name="_method"])').removeAttr('disabled');
                } else {
                    $('#form-mail :input:not(#mail_enable, #mail_submit, input[name="_token"], input[name="_method"])').attr('disabled', true);
                }
            }

            show_hide_mail_form();
            enable_disable_mail_form();

            $('#mail_driver').change(function () {
                show_hide_mail_form();
            });

            $('#mail_enable').on('switchChange.bootstrapSwitch', function () {
                enable_disable_mail_form();
            });
        });
    </script>
@endsection