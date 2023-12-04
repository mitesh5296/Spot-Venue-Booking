
@extends('layouts.app')
@isset($id)
    @section('title', 'Edit Booking')
@else
    @section('title', 'Add Booking')
@endisset

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @isset($id)
                <h1>Edit Booking</h1>
            @else
                <h1>Add Booking</h1>
            @endisset
        
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0);">Bookings</a></li>
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
                        <h3 class="card-title">Edit Booking</h3>
                    @else
                        <h3 class="card-title">Add Booking</h3>
                    @endisset
                        
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('bookings.save') }}" role="form" method="post" id="booking_form" class="@isset($id) edit-booking-form @endisset" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" name="booking_id" value="@isset($id) {{$id}} @endisset">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="booking_venue_type">Venues</label>                               
                                <select class="form-control select2 booking_venue_type" name="booking_venue_type" id="booking_venue_type">
                                    <option value="">Select venue type</option>
                                    @foreach($venueList as $venue)
                                        <option value="{{ $venue->id }}" @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->venus_id == $venue->id) selected @endif @endif @endisset>{{ $venue->title }}</option>
                                    @endforeach
                                </select>
                                
                                <label id="booking_venue_type_error"></label>
                            </div>  

                            <div class="form-group">
                                <label for="booking_date">Booking Date</label>
                                <input type="date" class="form-control" id="booking_date" name="booking_date" @isset($bookingList) @if(!empty($bookingList)) value="{{$bookingList->booking_date}}" @endif @endisset placeholder="Enter booking date">
                            </div>   
          
                            
                            <div class="form-group">
                                <label for="booking_slot">Slots</label>
                                <select class="form-control select2 booking_slot" name="booking_slot"  d="booking_slot">
                                    <option value="">Select booking slot</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '00:30') selected  @endif @endif @endisset value="00:30">00:30</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '01:00') selected  @endif @endif @endisset value="01:00">01:00</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '01:30') selected  @endif @endif @endisset value="01:30">01:30</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '02:00') selected  @endif @endif @endisset value="02:00">02:00</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '02:30') selected  @endif @endif @endisset value="02:30">02:30</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '03:00') selected  @endif @endif @endisset value="03:00">03:00</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '03:30') selected  @endif @endif @endisset value="03:30">03:30</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '04:00') selected  @endif @endif @endisset value="04:00">04:00</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '04:30') selected  @endif @endif @endisset value="04:30">04:30</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '05:00') selected  @endif @endif @endisset value="05:00">05:00</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '05:30') selected  @endif @endif @endisset value="05:30">05:30</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '06:00') selected  @endif @endif @endisset value="06:00">06:00</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '06:30') selected  @endif @endif @endisset value="06:30">06:30</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '07:00') selected  @endif @endif @endisset value="07:00">07:00</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '07:30') selected  @endif @endif @endisset value="07:30">07:30</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '08:00') selected  @endif @endif @endisset value="08:00">08:00</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '08:30') selected  @endif @endif @endisset value="08:30">08:30</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '09:00') selected  @endif @endif @endisset value="09:00">09:00</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '09:30') selected  @endif @endif @endisset value="09:30">09:30</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '10:00') selected  @endif @endif @endisset value="10:00">10:00</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '10:30') selected  @endif @endif @endisset value="10:30">10:30</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '11:00') selected  @endif @endif @endisset value="11:00">11:00</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '11:30') selected  @endif @endif @endisset value="11:30">11:30</option>
                                    <option @isset($bookingList) @if(!empty($bookingList)) @if($bookingList->slots == '12:00') selected  @endif @endif @endisset value="12:00">12:00</option>
                                </select>  
                                <label id="booking_slot_error"></label>
                            </div>     
                            
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="booking_amount" name="booking_amount" @isset($bookingList) @if(!empty($bookingList)) value="{{$bookingList->amount}}" @endif @endisset placeholder="Enter amount">
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