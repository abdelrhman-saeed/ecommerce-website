@extends('page-layout')
@section('content')
    
    @section('header')
        <link rel="stylesheet" href="{{asset('css/register.css')}}">
        <title>Sign in</title>     
    @endsection
    <body>
        <div class="authentication-container  col-xl-7 col-lg-10 col-md-10 col-sm-12 align-items-center">


            <div class="col-12 row align-items-center text-light">
                <div class="signing-in-side col-md-6 col-sm-12 text-center">
                    <div class="signing-in-side-container">
                        <h4>Already Registred?</h4>
                        <button class="btn sign-in-btn btn-outline-primary">Sign in</button>
                    </div>
                </div>
                

                <div class="register-form col-md-6 col-sm-12 text-left main-color">
                    <div class="registeration-container">
                        <h3>Join us</h3>
                        <form action="{{url('users')}}" method="POST"> @csrf
                            <div class="user-data">

                                <input type="text" name="name" id="" placeholder="Username"
                                    class="main-border-color  @error('username') error-border @enderror">

                                @error('username')
                                    <p class="error-message">{{$message}}</p>
                                @enderror

                                <input type="text" name="email" id="" placeholder="Email"
                                    class="main-border-color @error('email') error-border @enderror">

                                @error('email')
                                    <p class="error-message">{{$message}}</p>
                                @enderror


                                <input type="password" name="password" id="" placeholder="Password"
                                    class="main-border-color @error('password') error-border @enderror">

                                @error('password')
                                    <p class="error-message"> {{$message}}</p>
                                @enderror
                                    
                                <input type="password" name="password_confirmation" id="" placeholder="Confirm Password"
                                    class="main-border-color">

                                <input type="text" name="phone" id="" placeholder="Phone Number"
                                    class="main-border-color  @error('phone') error-border @enderror">

                                @error('phone')
                                    <p class="error-message">{{$message}}</p>
                                @enderror
                                        
                            </div>
                            <div>
                                <span><input type="checkbox" name="remember_me"></span>
                                <span>Remember me</span>
                            </div>
                            <input type="submit" class="btn main-border-color" value="Join"/>
                        </form>
                        <div class="forgot-password text-right">
                            <a href="/forgot-password">Forgot Password?</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
@endsection