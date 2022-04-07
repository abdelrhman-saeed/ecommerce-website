@extends('page-layout')
@section('header')
    <title>verify your email</title>
    <link rel="stylesheet" href="{{asset('css/verification-notice.css')}}">
@endsection

@section('content')
    <body>
        <div class="notice-message-container col-12 text-center">
            <i class="fa-solid fa-envelope"></i>
            <h2>Confirm your email address</h2>
            <p>abdelrhmanSaeed001@gmail.com</p>
            <p class="click-verification-link">Click on the link on the email to activate your account</p>
            <p>
                <strong>Not receiving the email?</strong>
            </p>
            <form action="{{url('/email/verification/notification')}}" method="post"> @csrf
                <input class="reset-confirmation-email" type="submit" value="Resend Confirmation email">
            </form>

            @if (session()->has('emailResent'))
                <p>{{session()->get('emailResent')}}</p>
            @endif
        </div>
    </body>
@endsection