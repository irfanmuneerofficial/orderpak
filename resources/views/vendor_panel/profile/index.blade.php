@extends('vendor_panel.layouts.master')
@section('title')
Profile
@endsection
@section('mainContent')
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
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Vendor Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <h2 class="profile-username text-center">Shop Details</h2>
                <div class="text-center">
                    @if(!$data)
                        <img class="profile-user-img img-fluid img-circle" src="/admin/dist/img/noimage.png" alt="User profile picture">
                    @else
                        <img class="profile-user-img img-fluid img-circle" src="/uploads/vendor/shop/{{$data->shop_img}}" alt="User profile picture">
                    @endif
                </div>
                 {{-- @if(!$data == null) --}}
                    <h3 class="profile-username text-center">{{ Auth::guard('vendor')->user()->business_name }}</h3>
                {{-- @endif --}}

                {{--<ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">{{$follower}}</a>
                  </li>
                </ul>--}}
                @if(!$data)
                <a href="/vendor/shop/create" class="btn btn-primary btn-block"><b>Add Shop Details</b></a>
                @else
                <a href="/vendor/shop/{{$id}}/edit" class="btn btn-primary btn-block"><b>Edit Shop</b></a>
                @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Personal Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong>{{-- <i class="fas fa-map-marker-alt mr-1"></i> --}} Name</strong>
                <p class="text-muted">{{ Auth::guard('vendor')->user()->first_name }} {{ Auth::guard('vendor')->user()->last_name }}</p>
                
                <strong>{{-- <i class="fas fa-map-marker-alt mr-1"></i> --}} Business Email (Main)</strong>
                <p class="text-muted">{{ Auth::guard('vendor')->user()->business_email }}</p>
                
                {{-- <strong><i class="fas fa-map-marker-alt mr-1"></i> Personal Email</strong>
                <p class="text-muted">{{ Auth::guard('vendor')->user()->personal_email }}</p> --}}

                <strong>{{-- <i class="fas fa-map-marker-alt mr-1"></i> --}} CNIC</strong>
                <p class="text-muted">{{ Auth::guard('vendor')->user()->cnic }}</p>

                <strong>{{-- <i class="fas fa-map-marker-alt mr-1"></i> --}} Business Address</strong>
                <p class="text-muted">{{ Auth::guard('vendor')->user()->business_address }}</p>
                
                <a href="/vendor/profile/{{$id}}/edit" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  {{-- <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profile Info</a></li> --}}
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Change Password</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  
                  <!-- /.tab-pane -->
                  
                  <!-- /.tab-pane -->

                  <div class="active tab-pane" id="settings">
                    @if (session('invalid'))
                     <div class="alert alert-danger" role="alert">
                        {{ session('invalid') }}
                    </div>
                @endif
                    <form class="form-horizontal" action="{{ route('update.password') }}/" method="post">
                    @csrf
                    <div class="form-group">
                    <label for="old_password" class="col-sm-2 control-label">Old Password</label>
                    <div class="col-sm-10">
                      <input id="old_password" type="old_password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" value="{{ $old_password ?? old('old_password') }}" required autocomplete="old_password" autofocus>
                      @error('old_password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                    <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">New Password</label>
                    <div class="col-sm-10">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                  </div>
                  <div class="form-group">
                    <label for="confirm_password" class="col-sm-2 control-label"> Confirm Password</label>
                    <div class="col-sm-10">
                      <input id="confirm_password" type="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="new-password">
                      @error('confirm_password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                  </div>

                  <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection