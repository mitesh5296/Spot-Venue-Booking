
@extends('layouts.app')
@isset($id)
    @section('title', 'Edit User')
@else
    @section('title', 'Add User')
@endisset

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @isset($id)
                <h1>Edit User</h1>
            @else
                <h1>Add User</h1>
            @endisset
        
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0);">Users</a></li>
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
                        <h3 class="card-title">Edit User</h3>
                    @else
                        <h3 class="card-title">Add User</h3>
                    @endisset
                        
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('users.save') }}" role="form" method="post" id="user_form" class="@isset($id) edit-user-form @endisset" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" name="user_id" value="@isset($id) {{$id}} @endisset">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user_email">Name</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" @isset($user) @if(!empty($user)) value="{{$user->name}}" @endif @endisset placeholder="Enter name">
                            </div>  

                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" class="form-control" id="user_email" name="user_email" @isset($user) @if(!empty($user)) value="{{$user->email}}" @endif @endisset placeholder="Enter email">
                            </div>   

                            <div class="form-group">
                                <label for="user_phone">Phone</label>
                                <input type="text" class="form-control" id="user_phone" name="user_phone" @isset($user) @if(!empty($user)) value="{{$user->phone}}" @endif @endisset placeholder="Enter phone">
                            </div>                            
                            
                            <div class="form-group">
                                <label>User Type</label>
                                <select class="form-control select2 user_type" name="user_type" id="user_type">
                                    <option value="">Select user type</option>
                                    <option @isset($user) @if(!empty($user)) @if($user->type == '0') selected  @endif @endif @endisset value="0">Admin</option>
                                    <option @isset($user) @if(!empty($user)) @if($user->type == '1') selected  @endif @endif @endisset value="1">Manager</option>
                                    <option @isset($user) @if(!empty($user)) @if($user->type == '2') selected  @endif @endif @endisset value="2">User</option>
                                </select>                                
                                <label id="user_type_error"></label>
                            </div>

                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="password" class="form-control" id="user_password" name="user_password" @isset($user) @if(!empty($user)) value="{{$user->email}}" @endif @endisset placeholder="Enter password">
                            </div>  
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" @isset($user) @if(!empty($user)) value="{{$user->email}}" @endif @endisset placeholder="Enter confirm password">
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