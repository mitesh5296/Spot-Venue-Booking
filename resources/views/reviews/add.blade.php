
@extends('layouts.app')
@isset($id)
    @section('title', 'Edit Review')
@else
    @section('title', 'Add Review')
@endisset

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @isset($id)
                <h1>Edit Review</h1>
            @else
                <h1>Add Review</h1>
            @endisset
        
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0);">Reviews</a></li>
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
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        
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
                        <h3 class="card-title">Edit Review</h3>
                    @else
                        <h3 class="card-title">Add Review</h3>
                    @endisset
                        
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('reviews.save') }}" role="form" method="post" id="review_form" class="@isset($id) edit-review-form @endisset" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" name="review_id" value="@isset($id) {{$id}} @endisset">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="review_venue_type">Venues</label>                               
                                <select class="form-control select2 review_venue_type" name="review_venue_type" id="review_venue_type">
                                    <option value="">Select venue type</option>
                                    @foreach($venueList as $list)
                                        <option value="{{ $list->id }}" @isset($reviewList) @if(!empty($reviewList)) @if($reviewList->venus_id == $list->id) selected @endif @endif @endisset>{{ $list->title }}</option>
                                    @endforeach
                                </select>                                
                                <label id="review_venue_type_error"></label>
                            </div> 

                            <div class="form-group">
                                <label for="review_user_type">User</label>                               
                                <select class="form-control select2 review_user_type" name="review_user_type" id="review_user_type">
                                    <option value="">Select user type</option>
                                    @foreach($userList as $list)
                                        <option value="{{ $list->id }}" @isset($reviewList) @if(!empty($reviewList)) @if($reviewList->user_id == $list->id) selected @endif @endif @endisset>{{ $list->name }}</option>
                                    @endforeach
                                </select>                                
                                <label id="review_user_type_error"></label>
                            </div>  

                            <div class="form-group">
                                <label for="review">Review</label>
                                <textarea class="form-control" name="review" id="review" cols="30" rows="10" placeholder="Enter review">{{ isset($reviewList) ? $reviewList->review : '' }}</textarea>
                            </div>
                             

                            <div class="form-group">
                                <label for="review_rate">Review Rate</label>
                                <input type="text" class="form-control" id="review_rate" name="review_rate" placeholder="Enter review rate" @isset($reviewList) @if(!empty($reviewList)) value="{{ $reviewList->rate }}" @endif @endisset>                                
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