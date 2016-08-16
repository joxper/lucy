@extends('layouts.auth')

@section('title', trans('lucy.auth.forgot-password'))

@section('content')
    @include('flash::message')
    {!! Form::open($form) !!}
        <div class="form-group{{ Form::hasError('email') }}">
            {!! Form::label('email', trans('lucy.form.email')) !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
            {!! Form::errorMsg('email') !!}
        </div>
        <div class="row">
            <div class="col-xs-6">
                <a href="{!! action('Auth\AuthController@getLogin') !!}" class="btn btn-default btn-block">{{ trans('lucy.auth.back-to-login') }}</a>
            </div>
            <div class="col-xs-6 pull-right">
                {!! Form::submit(trans('lucy.word.send'), ['class' => 'btn btn-primary btn-block', trans('lucy.word.send')]) !!}
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Auth\ForgotPasswordRequest') !!}
@endsection