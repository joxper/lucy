@extends('layouts.auth')

@section('title', trans('lucy.auth.log-in'))

@section('content')
    @include('flash::message')
    {!! Form::open($form) !!}
        <div class="form-group{{ Form::hasError('login') }} has-feedback">
            {!! Form::label('login', trans('lucy.form.email-or-username')) !!}
            {!! Form::text('login', null, ['class' => 'form-control']) !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            {!! Form::errorMsg('login') !!}
        </div>
        <div class="form-group{{ Form::hasError('password') }} has-feedback">
            {!! Form::label('password', trans('lucy.form.password')) !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            {!! Form::errorMsg('password') !!}
        </div>
        @if ((bool) lucy_config('AUTH_REMEMBER_ME'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="checkbox icheck">
                        <label>
                            {!! Form::checkbox('remember_me') !!} {{ trans('lucy.form.remember-me') }}
                        </label>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-xs-12">
                {!! Form::submit(trans('lucy.auth.log-in'), ['class' => 'btn btn-primary btn-block', trans('lucy.auth.log-in')]) !!}
            </div>
        </div>
    {!! Form::close() !!}

    <div class="divider-wrapper">
        <hr class="or-divider">
    </div>
    <div class="social-auth-links text-center">
        @if ((bool) lucy_config('SOCIALITE_FACEBOOK_ENABLE'))
            <a href="{!! action('Auth\AuthController@getSocialiteRedirect', 'facebook') !!}" class="btn btn-block btn-social btn-facebook">
                <i class="fa fa-facebook"></i> {{ trans('lucy.auth.log-in-with', ['provider' => 'Facebook']) }}
            </a>
        @endif
        @if ((bool) lucy_config('SOCIALITE_GOOGLE_ENABLE'))
            <a href="{!! action('Auth\AuthController@getSocialiteRedirect', 'google') !!}" class="btn btn-block btn-social btn-google">
                <i class="fa fa-google-plus"></i> {{ trans('lucy.auth.log-in-with', ['provider' => 'Google+']) }}
            </a>
        @endif
        @if ((bool) lucy_config('SOCIALITE_TWITTER_ENABLE'))
            <a href="{!! action('Auth\AuthController@getSocialiteRedirect', 'twitter') !!}" class="btn btn-block btn-social btn-twitter">
                <i class="fa fa-twitter"></i> {{ trans('lucy.auth.log-in-with', ['provider' => 'Twitter']) }}
            </a>
        @endif
    </div>

    @if ((bool) lucy_config('REG_ENABLE'))
        <a href="{!! action('Auth\AuthController@getRegister') !!}">{{ trans('lucy.auth.dont-have-account') }}</a>
    @endif
    @if ((bool) lucy_config('AUTH_FORGOT_PASSWORD'))
        <a href="{!! action('Auth\AuthController@getForgotPassword') !!}" class="pull-right">{{ trans('lucy.auth.i-forgot-password') }}</a>
    @endif
    <br><a href="{!! action('DocsController@show') !!}">{{ trans('lucy.app.docs') }}</a>
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Auth\AuthRequest') !!}
@endsection