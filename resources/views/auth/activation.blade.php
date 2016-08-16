@extends('layouts.email')

@section('title', 'Activate your account!')

@section('content')
    <p>Hi {{ $user->full_name }},</p>
    <p>Your account has been registered but need to activate.</p>
    <p><a href="{!! action('Auth\AuthController@activate', ['login' => $user->email, 'code' => $code]) !!}">Click here</a> to activate your account.</p>
@endsection