@extends('layouts.auth')

@section('title', ($socialite) ? trans('lucy.auth.one-more-step') : trans('lucy.auth.register'))

@section('content')
    @include('flash::message')
    {!! Form::model($user, $form) !!}        
        @if (isset($user['avatar']))
            <div class="form-group">
                <div class="col-sm-12" align="center">
                    <img src="{!! link_to_avatar($user['avatar']) !!}" width="120" class="img-circle img-responsive">
                </div>
            </div>
        @endif
        {!! Form::hidden('socialite', $socialite) !!}
        @if (! $socialite)
            <div class="form-group{{ Form::hasError('avatar') }}">
                {!! Form::label('avatar', trans('lucy.form.avatar')) !!}
                {!! Form::file('avatar') !!}
                {!! Form::errorMsg('avatar') !!}
            </div>
        @else
            {!! Form::hidden('avatar', $user['avatar']) !!}
        @endif
        <div class="form-group{{ Form::hasError('email') }}">
            {!! Form::label('email', trans('lucy.form.email')) !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
            {!! Form::errorMsg('email') !!}
        </div>
        <div class="form-group{{ Form::hasError('username') }}">
            {!! Form::label('username', trans('lucy.form.username')) !!}
            {!! Form::text('username', null, ['class' => 'form-control']) !!}
            {!! Form::errorMsg('username') !!}
        </div>
        <div class="form-group{{ Form::hasError('first_name') }}">
            {!! Form::label('first_name', trans('lucy.form.first_name')) !!}
            {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
            {!! Form::errorMsg('first_name') !!}
        </div>
        <div class="form-group{{ Form::hasError('last_name') }}">
            {!! Form::label('last_name', trans('lucy.form.last_name')) !!}
            {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
            {!! Form::errorMsg('last_name') !!}
        </div>
        <div class="form-group{{ Form::hasError('password') }}">
            {!! Form::label('password', trans('lucy.form.password')) !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
            {!! Form::errorMsg('password') !!}
        </div>
        <div class="form-group{{ Form::hasError('password_confirmation') }}">
            {!! Form::label('password_confirmation', trans('lucy.form.confirm-password')) !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            {!! Form::errorMsg('password_confirmation') !!}
        </div>
        <div class="row">
            <div class="col-xs-12">
                {!! Form::submit(trans('lucy.auth.register'), ['class' => 'btn btn-primary btn-block', trans('lucy.auth.register')]) !!}
            </div>
        </div>
    {!! Form::close() !!}

    <div class="divider-wrapper">
        <hr class="or-divider">
    </div>

    @if (! $socialite)
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
    @endif

    <a href="{!! action('Auth\AuthController@getLogin') !!}">{{ trans('lucy.auth.i-already-have-account') }}</a>
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Auth\RegisterRequest') !!}
@endsection