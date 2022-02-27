@extends('page-layout')
@section('content')
    
    @section('header')
        <title>Dashboard</title>
        <link rel="stylesheet" href="{{asset('css/dashboard-index.css')}}">
        <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
        <meta name="csrf-token" content="{{csrf_token()}}">
    @endsection

    <div class="h-100 container-fluid">

        <div class="dashboard position-relative row h-100">

            <div class="dashboard-list col-lg-2 col-8 row align-items-start align-content-start">

                
                <div class="lily">lily</div>
                <div class="list">
                    <ul>
                        <li>
                            <i class="fa-solid fa-book-open"></i>
                            <a href="{{url('dashboard/notebooks')}}">
                                <span>Notebooks</span>
                            </a>
                        </li>
                        <li>
                            <i class="fa-solid fa-list-check"></i>
                            <a href="{{url('dashboard/notebooks?type=todo')}}">
                                <span>TODO</span>
                            </a>
                        </li>
                        
                        <li>
                            <i class="fa-solid fa-calendar-days"></i>
                            <a href="{{url('dashboard/notebooks?type=planners')}}">
                                <span>Planners</span>
                            </a>
                        </li>

                        <li>
                            <i class="fa-solid fa-box-open"></i>
                            <a href="{{url('dashboard/notebooks?type=refills')}}">
                                <span>Refills</span>
                            </a>
                        </li>
                        <li>
                            <i class="fa fa-shopping-cart"></i>
                            <a href="{{url('dashboard/orders')}}">
                                <span>Orders</span>
                            </a>
                        </li>
                        <li>
                            <i class="fa-solid fa-truck"></i>
                            <a href="{{url('dashboard/shipping/info')}}">
                                <span>shipping</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dashboard-items col-lg-10">
                <div class="p-4 item-name item-type">Create Notebook</div>
                <div class="items row">
                    @yield('dashboard-content')
                </div>
            </div>

        </div>
    </div>

    <script src="{{asset('js/dashboard-index.js')}}"></script>
@endsection