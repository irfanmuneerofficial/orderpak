@extends('vendor_panel.layouts.master')
@section('title')
  Edit Personal Info
@endsection
@section('mainContent')
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
            <h1>Edit Personal Info</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Profile</li>
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
            <div class="card card-primary">
              <div class="card-header">
                {{-- <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3> --}}
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" method="post" action="/vendor/profile/{{$data->id}}/edit/" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="first_name">First Name</label>
                    <span id="error" class="alert-danger"></span>
                    <input type="text" name="first_name" class="form-control" id="first_name" required="" placeholder="Enter First Name" value="{{$data->first_name}}">
                  </div>
                  <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <span id="error" class="alert-danger"></span>
                    <input type="text" name="last_name" class="form-control" id="last_name" required="" placeholder="Enter Last Name" value="{{$data->last_name}}">
                  </div>
                  {{--<div class="form-group">
                    <label for="personal_email">Personal Email</label>
                    <span id="error" class="alert-danger"></span>
                    <input type="text" name="personal_email" class="form-control" id="personal_email" required="" placeholder="Enter personal email" value="{{$data->personal_email}}">
                  </div>--}}
                  <div class="form-group">
                    <label for="cnic">Cnic</label>
                    <span id="error" class="alert-danger"></span>
                    <input type="text" name="cnic" class="form-control" id="last_name" required="" placeholder="Enter Cnic" value="{{$data->cnic}}" >
                  </div>
                  <div class="form-group">
                    <label for="personal_email">Business Address</label>
                    <span id="error" class="alert-danger"></span>
                    <input type="text" name="business_address" class="form-control" id="business_address" required="" placeholder="Enter business address" value="{{$data->business_address}}">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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