@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
    @include('flash::message')
    {!! Form::open($form) !!}
        {!! Form::hidden('login', Request::get('login')) !!}
        {!! Form::hidden('code', Request::get('code')) !!}
        <div class="form-group{{ Form::hasError('password') }}">
            {!! Form::label('password', 'New Password') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
            {!! Form::errorMsg('password') !!}
        </div>
        <div class="form-group{{ Form::hasError('password_confirmation') }}">
            {!! Form::label('password_confirmation', 'Confirm Password') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            {!! Form::errorMsg('password_confirmation') !!}
        </div>
        <div class="row">
            <div class="col-xs-12">
                {!! Form::submit('Reset', ['class' => 'btn btn-primary btn-block', 'Register']) !!}
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Auth\ResetPasswordRequest') !!}
@endsection