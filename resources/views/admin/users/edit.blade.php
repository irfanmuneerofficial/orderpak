@extends('admin.layouts.master')
@section('page-title')
Add Commission
@endsection
@section('mainContent')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit User</h1>
          </div><!-- /.col -->
        </div>
      </div>
    </div>

<section class="content">
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
  <div class="col d-flex justify-content-center">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">Edit Profile</h3>
                    </div>
                    
                    <div class="card-body">
                    <form name="form-example-1" id="form-example-1" action="/admin/users/update/{{ $user->id }}/" method="post">
                    @csrf
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" id="fullname" name="fullname" class="form-control" value="{{$user->fullname}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text prepend-input" id="">+92</span>
                                        </div>
                                        <input maxlength="10" value="{{$user->phone}}" class="form-control input-phone" id="phone" name="phone" type="text" autocomplete="off" required="" placeholder="3456789048">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                   <button type="submit" class="btn btn-primary" name="update_proifle">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-5">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">Change Password</h3>
                    </div>
                    
                    <div class="card-body">
                    <form name="form-example-1" id="form-example-1" action="/admin/users/changepassword/{{ $user->id }}/" method="post">
                    @csrf
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" id="password" name="password" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="confirmation_password">Confirm Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control confirm_password" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                   <button type="submit" class="btn btn-primary" name="change_password">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            
        </div>
    </div>
</section>
</div>

@endsection

@push('user-edit-admin-page')
<script>
$('#phone').on('keyup',  function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
</script>
@endpush
