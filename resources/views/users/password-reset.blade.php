@extends('page-layout')
@section('content')
    @section('header')
        <title> Reset Your Password </title>
        <link rel="stylesheet" href="{{asset('css/password-reset.css')}}">
    @endsection


    <body>

        <div class="row col-lg-4 col-md-6 col-sm-6 col-8 align-content-center justify-items-center password-reset m-auto">

            <p class="darker-main-color">Write Your New Password</p>
            
            <form action="{{url('reset-password/'.$token)}}" method="post"> @csrf
                
                <input type="text" class="text" name="password" placeholder="Password">
                <input type="text" class="text" name="password_confirmation" placeholder="Password Confirmation">
                <input type="hidden" name="token" value="{{$token}}">
                <input type="hidden" name="email" value="{{request()->email}}">
                <input class="main-background-color text-white" type="submit" value="Change my password">
            </form>

            @error('email')
                <p> {{$message}} </p>
            @enderror


        </div>

    </body>

@endsection