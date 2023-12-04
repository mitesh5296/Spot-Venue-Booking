@extends('layouts.app')
@isset($id)
    @section('title', 'Edit Amenity')
@else
    @section('title', 'Add Amenity')
@endisset

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @isset($id)
                <h1>Edit Amenity</h1>
            @else
                <h1>Add Amenity</h1>
            @endisset
        
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0);">Amenities</a></li>
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
                        <h3 class="card-title">Edit Amenity</h3>
                    @else
                        <h3 class="card-title">Add Amenity</h3>
                    @endisset
                        
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('amenities.save') }}" role="form" method="post" id="amenity_form" class="@isset($id) edit-amenity-form @endisset" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" name="amenity_id" value="@isset($id) {{$id}} @endisset">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="amenity_title">Title</label>
                                <input type="text" class="form-control" id="amenity_title" name="amenity_title" @isset($amenity) @if(!empty($amenity)) value="{{$amenity->title}}" @endif @endisset placeholder="Enter title">
                            </div>
                            
                            <div class="form-group">
                                <label for="amenity_image">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="amenity_image" name="amenity_image" accept="image/png, image/gif, image/jpeg" >
                                        <label class="custom-file-label" for="amenity_image">Choose Image</label>
                                    </div>

                                </div>
                                @isset($amenity) 
                                    @if(!empty($amenity))
                                    <div class="attachment-block clearfix mt-2">
                                        <img height="100" weight="100" src="{{ asset('assets/images/amenities').'/'.$amenity->image}}">
                                        <input type="hidden" value="{{$amenity->image}}" name="amenity_image_value"> 
                                        <strong>{{$amenity->image}}</strong>
                                    </div>
                                    @endif
                                @endisset
                                <label id="amenity_image_error"></label>
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