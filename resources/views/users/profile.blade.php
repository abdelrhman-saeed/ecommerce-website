@extends('page-layout')
@section('content')
    
    @section('header')
        <link rel="stylesheet" href="{{asset('css/profile.css')}}">
        <title>{{$user->name}} - Profile</title>     
    @endsection
    <body>

        <div class="profile-container  col-xl-4 col-lg-10 col-md-10 col-sm-12 align-items-center">

                
                <div class="profile-form col-md-12 col-sm-12 text-left main-color">
                    <div class="profile-info-container">
                        <h3>You Can Edit Your Profile info</h3>
                        <form action="{{url('users')}}" method="POST"> @csrf
                            <div class="user-data">

                                <input type="text" name="username" id="" placeholder="Username"
                                    class="main-border-color  @error('username') error-border @enderror"
                                    value="{{$user->name}}">

                                @error('username')
                                    <p class="error-message">{{$message}}</p>
                                @enderror

                                <input type="text" name="email" id="" placeholder="Email"
                                    class="main-border-color @error('email') error-border @enderror"
                                    value="{{$user->email}}">

                                @error('email')
                                    <p class="error-message">{{$message}}</p>
                                @enderror

                                <input type="text" name="phone" id="" placeholder="Phone Number"
                                    class="main-border-color  @error('phone') error-border @enderror"
                                    value="{{$user->phone}}">

                                @error('phone')
                                    <p class="error-message">{{$message}}</p>
                                @enderror
                                        
                            </div>
                            <input type="submit" class="btn main-border-color" value="Save"/>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </body>
@endsection