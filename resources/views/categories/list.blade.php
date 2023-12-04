@extends('layouts.app')
@section('title', 'Categories')
@section('content')
<div class="content-wrapper categories_list">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Categories</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active">Categories</li>
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
                    <h3 class="card-title">Categories</h3>
                    <div class="create-custom-btn">
                        <a href="{{ URL::current() }}/add"><button type="button" class="btn btn-block bg-gradient-secondary">Add</button></a>
                        
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="categories" class="table table-bordered table-striped projects dataTableList" data-module='categories'>
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Time Range</th>
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