@extends('beautymail::templates.sunny')

@section('content')
    <p align="center">
        <img
                src="{{url('assets/apps/img/logo.png')}}" width="50%">
    </p>
    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Hello!',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

    <p style="text-align: center">Welcome to the site {{$user['name']}}</p>
    <p style="text-align: center">Your registered email-id is {{$user['email']}} , Please click on the below link to
        verify your email account</p>

    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => 'Verify Email',
        	'link' => url('user/verify', $user->verifyUser->token)
    ])

@stop