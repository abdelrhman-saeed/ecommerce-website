@extends('page-layout')
@section('content')

    @section('header')
        <title>password reset</title>
        <link rel="stylesheet" href="{{asset('css/forgot-password.css')}}">
    @endsection

    <body>
        
        <div class="row col-lg-4 col-md-6 col-sm-6 col-8 align-content-center justify-items-center password-email-reset m-auto">

            <p class="darker-main-color">You will recive an email to change your password</p>
            
            <form action="{{url('forgot-password')}}" method="post"> @csrf
                
                <input type="text" class="text" name="email" placeholder="Email">
                <input class="main-background-color text-white" type="submit" value="send reset password email">
            </form>

            <p>
                @if (session()->has('status'))
                    {{session()->get('status')}}
                @endif

                @error('email')
                    {{$message}}
                @enderror
            </p>


        </div>

    </body>

@endsection