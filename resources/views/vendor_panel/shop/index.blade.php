@extends('vendor_panel.layouts.master')
@section('title')
  Shop Info
@endsection
@section('mainContent')
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      
      @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Shop Info</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Shop Info</li>
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
          <div class="col-md-12">
            <!-- jquery validation -->
            @if(!$data)
              <a href="{{route('shop.create')}}" class="btn btn-default">Create Info</a>
            @endif
            <div class="card card-primary">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Shop Name</th>
                    <th>Shop Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if($data)
                  <tr>
                    <td>{{$data->id}}</td>
                    <td>{{Auth::guard('vendor')->user()->business_name}}</td>
                    <td><img src="/uploads/vendor/shop/{{$data->shop_img}}" width="100" alt=""></td>
                    <td><a href="/vendor/shop/{{$data->id}}/edit" class="btn btn-default">Edit</a></td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection