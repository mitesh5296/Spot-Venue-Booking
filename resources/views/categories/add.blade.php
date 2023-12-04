@extends('layouts.app')
@isset($id)
    @section('title', 'Edit Category')
@else
    @section('title', 'Add Category')
@endisset

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @isset($id)
                <h1>Edit Category</h1>
            @else
                <h1>Add Category</h1>
            @endisset
        
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0);">Categories</a></li>
              @isset($id)
                <li class="breadcrumb-item active">Edit</li>
              @else
                <li class="breadcrumb-item active">Add</li>
              @endisset
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card card-primary">
                    <div class="card-header">
                    @isset($id)
                        <h3 class="card-title">Edit Category</h3>
                    @else
                        <h3 class="card-title">Add Category</h3>
                    @endisset
                        
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('categories.save') }}" role="form" method="post" id="category_form" class="@isset($id) edit-category-form @endisset" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" name="category_id" value="@isset($id) {{$id}} @endisset">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category_title">Title</label>
                                <input type="text" class="form-control" id="category_title" name="category_title" @isset($category) @if(!empty($category)) value="{{$category->title}}" @endif @endisset placeholder="Enter title">
                            </div>
                            
                            <div class="form-group">
                                <label for="category_image">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="category_image" name="category_image" accept="image/png, image/gif, image/jpeg" >
                                        <label class="custom-file-label" for="category_image">Choose Image</label>
                                    </div>

                                </div>
                                @isset($category) 
                                    @if(!empty($category))
                                    <div class="attachment-block clearfix mt-2">
                                        <img height="100" weight="100" src="{{ asset('assets/images/categories').'/'.$category->image}}">
                                        <input type="hidden" value="{{$category->image}}" name="category_image_value"> 
                                        <strong>{{$category->image}}</strong>
                                    </div>
                                    @endif
                                @endisset
                                <label id="category_image_error"></label>
                            </div>
                            <div class="form-group">
                                <label>Time Range</label>
                                <select class="form-control select2 category_time_range" name="category_time_range" id="category_time_range">
                                    <option value="">Select time range</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '00:30') selected  @endif @endif @endisset value="00:30">00:30</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '01:00') selected  @endif @endif @endisset value="01:00">01:00</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '01:30') selected  @endif @endif @endisset value="01:30">01:30</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '02:00') selected  @endif @endif @endisset value="02:00">02:00</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '02:30') selected  @endif @endif @endisset value="02:30">02:30</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '03:00') selected  @endif @endif @endisset value="03:00">03:00</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '03:30') selected  @endif @endif @endisset value="03:30">03:30</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '04:00') selected  @endif @endif @endisset value="04:00">04:00</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '04:30') selected  @endif @endif @endisset value="04:30">04:30</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '05:00') selected  @endif @endif @endisset value="05:00">05:00</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '05:30') selected  @endif @endif @endisset value="05:30">05:30</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '06:00') selected  @endif @endif @endisset value="06:00">06:00</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '06:30') selected  @endif @endif @endisset value="06:30">06:30</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '07:00') selected  @endif @endif @endisset value="07:00">07:00</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '07:30') selected  @endif @endif @endisset value="07:30">07:30</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '08:00') selected  @endif @endif @endisset value="08:00">08:00</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '08:30') selected  @endif @endif @endisset value="08:30">08:30</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '09:00') selected  @endif @endif @endisset value="09:00">09:00</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '09:30') selected  @endif @endif @endisset value="09:30">09:30</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '10:00') selected  @endif @endif @endisset value="10:00">10:00</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '10:30') selected  @endif @endif @endisset value="10:30">10:30</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '11:00') selected  @endif @endif @endisset value="11:00">11:00</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '11:30') selected  @endif @endif @endisset value="11:30">11:30</option>
                                    <option @isset($category) @if(!empty($category)) @if($category->time_range == '12:00') selected  @endif @endif @endisset value="12:00">12:00</option>
                                </select>
                                <label id="category_time_range_error"></label>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ redirect()->back()->getTargetUrl() }}"><button type="button" class="btn btn-secondary">Cancel</button></a>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.card -->
            </div>
            <!-- /.row -->
        </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection