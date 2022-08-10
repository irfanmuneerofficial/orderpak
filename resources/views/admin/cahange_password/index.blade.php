@extends('admin.layouts.master')
@section('page-title')
Change Password
@endsection
@section('mainContent')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Change Password</h1>
          </div><!-- /.col -->
        </div>
      </div>
    </div>

<section class="content">
  @if (session('invalid'))
              <div class="alert alert-danger" role="alert">
                  {{ session('invalid') }}
              </div>
            @endif
            @if (session('success'))
              <div class="alert alert-success" role="alert">
                  {{ session('success') }}
              </div>
            @endif
            <form action="/admin/change_passowrd/" method="post">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Current Password</label>
                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" value="{{ $old_password ?? old('old_password') }}" required autocomplete="old_password">
                    @error('old_password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">New Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Confirm Password</label>
                    <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="new-password">
                    @error('confirm_password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                
              </div>
              
              <button type="submit" class="btn btn-primary pull-right">Update Password</button>
              <div class="clearfix"></div>
            </form>
</section>
</div>

@endsection