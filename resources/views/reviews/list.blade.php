
@extends('layouts.app')
@section('title', 'Reviews')
@section('content')
<div class="content-wrapper reviews_list">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Reviews</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active">Reviews</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <div class="js_success"></div>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-timeout alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-timeout alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <h3 class="card-title">Reviews</h3>
                    <div class="create-custom-btn">
                        <a href="{{ URL::current() }}/add"><button type="button" class="btn btn-block bg-gradient-secondary">Add</button></a>
                        
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="reviews" class="table table-bordered table-striped projects dataTableList" data-module='reviews'>
                    <thead>
                    <tr>
                        <th>Venues</th>
                        <th>User</th>
                        <th>Review</th>
                        <th>Rate</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="tbody_data">
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection 