@extends('admin.dashboard.page-layout')
@section('dashboard-content')
    <div class="item add-item main-darker-background-color col-xl-3 col-lg-5 col-md-5 col-11 row align-items-center">
        <div class="text-center">
            <a href="notebooks/create?type={{request()->type}}">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>

    @foreach ($notebooks as $notebook)
        <div class="item item-instance main-darker-background-color col-xl-3 col-lg-5 col-md-5 col-11">
            
            <div class="item-info row h-100">
                <div class="item-header position-relative">
                    <h6 class="item-name row justify-content-between text-right">
                        <span class="col-10">{{$notebook->name}}</span>
                        <i class="text-right fa-solid fa-ellipsis-vertical col-1"></i>
                    </h6>
                    <div class="item-options d-none position-absolute">
                        <p>Delete</p>
                        <p>Edit</p>
                    </div>
                </div>
                <img class="item-image" src="{{asset($notebook->main_picture)}}">
            </div>
        </div>    
    @endforeach
@endsection
