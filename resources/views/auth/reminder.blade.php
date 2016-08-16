@extends('layouts.email')

@section('title', 'Activate your account!')

@section('content')
    <p>Hi {{ $user->full_name }},</p>
    <p>We got request to reset your password.</p>
    <p><a href="{!! action('Auth\AuthController@getReset', ['login' => $user->email, 'code' => $code]) !!}">Click here</a> to reset your password.</p>
    <p>If you ignore this message, your password won't be changed.</p>
@endsection