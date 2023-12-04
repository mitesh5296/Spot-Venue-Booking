@extends('layouts.app')
@isset($id)
    @section('title', 'Edit Venue')
@else
    @section('title', 'Add Venue')
@endisset
@section('content')
<?php 
if(isset($venue)){
    if(!empty($venue)){
        $venue_overwrite_start_time = $venue_overwrite_end_time = $venue_overwrite_amount = '';
        if($venue->overwrite_default != ''){
            $overwriteDefault = explode('-',$venue->overwrite_default);
            if(!empty( $overwriteDefault)){
                $venue_overwrite_start_time = $overwriteDefault[0];
                $venue_overwrite_end_time = $overwriteDefault[1];
                $venue_overwrite_amount = $overwriteDefault[2];
            }
        }
        $categoriesSelected = $amenitiesSelected =[];
        if($venue->categories != ''){
            $categoriesSelected = explode(',',$venue->categories);
        }
        if($venue->amenities != ''){
            $amenitiesSelected = explode(',',$venue->amenities);
        }
    }
} 
?>
<link rel="stylesheet" href="{{ asset('assets/css/multidatepicker.css') }}">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @isset($id)
                <h1>Edit Venue</h1>
            @else
                <h1>Add Venue</h1>
            @endisset
        
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0);">Venues</a></li>
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
                        <h3 class="card-title">Edit Venue</h3>
                    @else
                        <h3 class="card-title">Add Venue</h3>
                    @endisset
                        
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('venues.save') }}" role="form" method="post" id="venue_form" class="@isset($id) edit-venue-form @endisset" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" name="venue_id" value="@isset($id) {{$id}} @endisset">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="venue_title">Title</label>
                                <input type="text" class="form-control" id="venue_title" name="venue_title" @isset($venue) @if(!empty($venue)) value="{{$venue->title}}" @endif @endisset placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label>Categories</label>
                                <select class="form-control select2_multiple venue_categories" name="venue_categories[]" id="venue_categories" multiple="multiple">
                                    @if($categories != '')
                                        @foreach($categories as $category)
                                            <option @if(!empty($categoriesSelected)) @if(in_array($category->id,$categoriesSelected)) selected @endif @endif value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label id="venue_categories_error"></label>
                            </div>
                            <div class="form-group">
                                <label>Aminities</label>
                                <select class="form-control select2_multiple venue_aminities" name="venue_aminities[]" id="venue_aminities" multiple="multiple">
                                    <option value="">Select Aminities</option>
                                    @if($aminities != '')
                                        @foreach($aminities as $aminity)
                                            <option @if(!empty($amenitiesSelected)) @if(in_array($aminity->id,$amenitiesSelected)) selected @endif @endif value="{{ $aminity->id }}">{{ $aminity->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label id="venue_aminities_error"></label>
                            </div>
                            <div class="form-group">
                                <label for="venue_images">Images</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="venue_images" name="venue_images[]" accept="image/png, image/gif, image/jpeg" multiple>
                                        <label class="custom-file-label" for="venue_images">Choose Images</label>
                                    </div>
                                </div>
                                @isset($venue) 
                                    @if(!empty($venue))
                                        @if(!empty($venusImages))
                                            @foreach($venusImages as $imageObj)
                                                <div class="attachment-block clearfix mt-2">
                                                    <img height="100" weight="100" src="{{ asset('assets/images/venues').'/'.$imageObj->image}}">
                                                    <input type="hidden" value="{{$imageObj->image}}" name="venue_image_value"> 
                                                    <strong>{{$imageObj->image}}</strong>

                                                    
                                                </div>
                                                <!-- <i class="nav-icon fas fa-location-arrow"></i> -->
                                                <!-- <div class="delete_image_icon">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </div> -->

                                            @endforeach
                                        @endif
                                    @endif
                                @endisset
                                <label id="venue_images_error"></label>
                            </div>
                            <div class="form-group">
                                <label for="venue_city">City</label>
                                <input type="text" class="form-control" id="venue_city" name="venue_city" @isset($venue) @if(!empty($venue)) value="{{$venue->city}}" @endif @endisset placeholder="Enter City">
                            </div>
                            <div class="form-group">
                                <label for="venue_state">State</label>
                                <input type="text" class="form-control" id="venue_state" name="venue_state" @isset($venue) @if(!empty($venue)) value="{{$venue->state}}" @endif @endisset placeholder="Enter State">
                            </div>
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label>Start Time:</label>
                                    <div class="input-group date timepicker venue_start_time" id="venue_start_time" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="venue_start_time" data-target="#venue_start_time" @isset($venue) @if(!empty($venue)) value="{{$venue->start_time}}" @endif @endisset   placeholder="12:00 AM"/>
                                        <div class="input-group-append" data-target="#venue_start_time" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                    <label id="venue_start_time_error"></label>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                            </div>
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label>End Time:</label>
                                    <div class="input-group date timepicker venue_end_time" id="venue_end_time"  data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="venue_end_time" data-target="#venue_end_time" @isset($venue) @if(!empty($venue)) value="{{$venue->end_time}}" @endif @endisset placeholder="12:00 PM"/>
                                        <div class="input-group-append" data-target="#venue_end_time" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                    <label id="venue_end_time_error"></label>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                            </div>
                            <div class="form-group">
                                <label for="venue_charge_per_slot">Charge Per Slot</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="venue_charge_per_slot" id="venue_charge_per_slot" placeholder="100000" @isset($venue) @if(!empty($venue)) value="{{$venue->charge_per_slot}}" @endif @endisset>
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                    
                                </div>
                                <label id="venue_charge_per_slot_error"></label>
                            </div>
                            <div class="form-group">
                                <label for="charge_per_slot">Available Days</label>
                                <input type="number" class="form-control" name="venue_available_days" id="venue_available_days" placeholder="Enter available days" @isset($venue) @if(!empty($venue)) value="{{$venue->available_days}}" @endif @endisset>
                            </div>
                            <div class="form-group">
                                <label for="charge_per_slot">Exclude Dates</label>
                                <div class="input-group ">
                                <input type="text" class="form-control venue_exclude_dates" name="venue_exclude_date" placeholder="Pick the multiple dates" @isset($venue) @if(!empty($venue)) value="{{$venue->exclude_dates}}" @endif @endisset>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="charge_per_slot">Overwrite Default</label>
                                <div class="input-group">
                                    <input type="time"  class="form-control venue_overwrite_start_time" id="venue_overwrite_start_time" name="venue_overwrite_start_time" @isset($venue) @if($venue_overwrite_start_time != '') value="{{$venue_overwrite_start_time}}" @endif @endisset>
                                    <input type="time"  class="form-control venue_overwrite_end_time" id="venue_overwrite_end_time" name="venue_overwrite_end_time" @isset($venue) @if($venue_overwrite_end_time != '')  value="{{$venue_overwrite_end_time}}" @endif @endisset>
                                    <input type="number" class="form-control venue_overwrite_amount" id="venue_overwrite_amount" name="venue_overwrite_amount" placeholder="100000" @isset($venue) @if($venue_overwrite_amount != '')  value="{{$venue_overwrite_amount}}" @endif @endisset>
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
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
