@extends('page-layout')
@section('content')
    
    @section('header')
        <link rel="stylesheet" href="{{asset('css/login.css')}}">
        <title>Sign in</title>     
    @endsection

    <body>
        <div class="authentication-container  col-xl-10 col-lg-10 col-md-10 col-sm-12 align-items-center">

            <div class="col-12 row align-items-center text-light">
                <div class="row align-content-center registeration-offer col-md-6 col-sm-12 text-center">
                    <div class="registeration-offer-container">
                        
                        <h4>New to our Shop?</h4>
                        <p>Your world is waiting for you <br> join us </p>

                        <a href="{{url('/users/create')}}">
                            <button class="btn join-us-btn btn-outline-primary">
                                Join us
                            </button>
                        </a>

                    </div>
                </div>
                
                <div class="login-form col-md-6 col-sm-12 text-left main-color">
                    <div class="siging-container">
                        <h3> Welcome back! <br> please sign in now </h3>
                        
                        @error('unauthenticated')
                            <p>{{$message}}</p>
                        @enderror

                        <form action="login" method="POST"> @csrf
                            <div class="user-data">
                                <input type="text" name="email" id="" placeholder="Email"
                                    class="main-border-color 
                                    @error('email') error-border @enderror">

                                @error('email') <p class="error-message">{{$message}}</p> @enderror


                                <input type="password" name="password" id="" placeholder="Password"
                                    class="main-border-color 
                                    @error('password') error-border @enderror"
                            </div>
                            @error('password')
                                <p class="error-message">{{$message}}</p>
                            @enderror
                            <div>
                                <span><input type="checkbox" name="remember_me"></span>
                                <span>Remember me</span>
                            </div>
                            <input type="submit" class="btn main-border-color" value="Sign in"/>
                        </form>
                        <div class="forgot-password text-right">
                            <a href="{{url('forgot-password')}}">Forgot Password?</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
@endsection