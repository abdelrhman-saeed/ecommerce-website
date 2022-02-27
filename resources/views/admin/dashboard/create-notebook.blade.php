@extends('admin.dashboard.page-layout')
@section('dashboard-content')

    <div class="item fillable-item-instance col-xl-7 col-lg-8 m-auto col-md-8 col-11  main-darker-background-color row align-items-start">

        <div class="item-info">
            <form action="{{url('dashboard/notebooks')}}" method="post" class="row" enctype="multipart/form-data"> @csrf

                <div class="multi-column row justify-content-between">

                    <div class="error-div">
                        @error('name')
                            <span class="error-message">
                                name is required
                            </span>
                        @enderror

                        @error('notebook_type')
                            <span class="error-message">
                                notebook type is required
                            </span>
                        @enderror
                    </div>

                    <input type="text" name="name" class="item-name col-7" id="" placeholder="item name">
                    <select name="notebook_type" class="notebook-type col-3" id="select-type">
                        <option value="notebook">Notebooks</option>
                        <option value="todo">TODO</option>
                        <option value="planner">Planners</option>
                    </select>
                </div>
                
                <div class="multi-column row justify-content-between m-0">
                    <div class="error-div">
                        @error('price')
                            <span class="error-message"> price is required things can't just be free ya lola </span>
                        @enderror

                        @error('discount')
                            <span class="error-message"> discount is invalid </span>
                        @enderror

                        @error('qunatity')
                            <span class="quantity">quantity is invalid</span>
                        @enderror
                    </div>
                    <input type="text" name="price" class="item-price col-3" id="" placeholder="price">
                    <input type="text" name="discount" class="discount col-3" id="" placeholder="discount %">
                    <input type="text" name="quantity" class="quantity col-3" id="" placeholder="quantity">
                </div>
                
                <div class="multi-column row justify-content-between m-0">
                    <div class="error-div">
                        
                        @error('page_count')
                            <span class="error-message"> page count is invalid </span>
                        @enderror

                        @error('page_weight')
                            <span class="quantity"> page weight is invalid </span>
                        @enderror
                    </div>
                    <input type="text" name="page_type" class="page-type col-3" id="" placeholder="page">
                    <input type="text" name="page_count" class="page-count col-3" id="" placeholder="page count">
                    <input type="text" name="page_weight" class="page-weight col-3" id="" placeholder="page weight">
                </div>

                <div class="multi-column row justify-content-between m-0">
                    <input type="text" name="manufacturing_type" class="manufacturing-type col-3" id="" placeholder="type">
                    <input type="text" name="cover_type" class="cover col-3" id="" placeholder="cover">
                    <input type="text" name="size" class="page-type col-3" id="" placeholder="size">
                </div>

                <div class="multi-column row justify-content-between m-0">
                    <div class="error-div">
                        @error('width')
                            <span class="error-message"> width is invalid </span>
                        @enderror

                        @error('height')
                            <span class="error-message"> height is invalid </span>
                        @enderror
                    </div>
                    <input type="text" name="width" class="notebook-width col-5" id="" placeholder="width">
                    <input type="text" name="height" class="notebook-height col-5" id="" placeholder="height">
                </div>

                <div class="pictures row justify-content-between p-0">
                    <div class="file-browser main-picture-browser col-4">
                        <div class="error-div">
                            @error('main_picture')
                                <span class="error-message"> main picture is requred </span>
                            @enderror
                        </div>
                        <label for="main_picture">picture</label>
                        <input type="file" name="main_picture" id="main_picture" placeholder="image">
                    </div>
                    
                    <div class="file-browser other-pictures-browser col-5">
                        <label for="other_pictures">Other</label>
                        <input type="file" name="other_pictures[]" id="other_pictures" multiple>
                    </div>
                </div>

                <textarea name="details" class="details" id="" cols="30" rows="1" placeholder="details"></textarea>
                <input type="submit" value="Save" class="save-item">
            </form>

        </div>

    </div>
@endsection