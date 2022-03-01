@extends('admin.dashboard.page-layout')
@section('dashboard-content')
<div class="item add-item main-darker-background-color col-xl-3 col-lg-5 col-md-5 col-11 row align-items-center">
    <a href="notebooks/create?type={{request()->type}}" class="w-100 h-100 m-0 row align-items-center">
        <div class="text-center"> <i class="fa fa-plus"></i> </div>
    </a>
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
                        <form action="notebooks/{{$notebook->id}}" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="Delete">
                        </form>
                        <form action="notebooks/{{$notebook->id}}/edit" method="get">
                            <input type="submit" value="Edit">
                        </form>
                    </div>
                </div>
                <img class="item-image" src="{{asset('storage/'.$notebook->main_picture)}}">
            </div>
        </div>    
    @endforeach
@endsection
