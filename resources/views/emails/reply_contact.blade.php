@extends('beautymail::templates.sunny')

@section('content')
    <p align="center">
        <img src="{{url('assets/apps/img/logo.png')}}" width="50%">
    </p>
    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Replication!',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

    <h4 style="font-weight: bold">{{$contact['message']}}</h4>
    <p>replying:{{$contact['reply'] ?? 'No reply'}}</p>

    @include('beautymail::templates.sunny.contentEnd')

    {{--    @include('beautymail::templates.sunny.button', [--}}
    {{--        	'title' => 'Verify Email',--}}
    {{--        	'link' => url('user/verify', $user->verifyUser->token)--}}
    {{--    ])--}}

@stop