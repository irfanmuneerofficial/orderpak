@extends('user_panel.layouts.master')
@section('title')
User Profile
@endsection
@section('mainContent')
{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<style type="text/css">
                            .switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
  float:right;
}


/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input.info:checked + .slider {
  background-color: #3de0f5;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
#btn-light:focus{
  background: transparent;
    color: #9c27b0;
    border: 1px solid #fc9208;
}
#btn-light{
  background: transparent;
    color: #9c27b0;
    border: 1px solid #fc9208;
}
</style>

<style type="text/css">
tr.detail {
  display: none;
  width: 100%;
}
tr.detail div {
  display: none;
}
.showmore:hover {
  cursor: pointer;
}
</style>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Edit Profile</h4>
            <p class="card-category">Change Your Phone No</p>
          </div>
          <div class="card-body">
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
            <form action="{{ url('user/change_phone') }}/" method="post">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Name</label>
                    <input type="text" class="form-control" name="fullname" value="{{ Auth::user()->fullname }}" required >
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Email</label>
                    <input type="email" readonly class="form-control"  name="email" value="{{ Auth::user()->email }}" required >
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Phone No</label>
                    <input type="number" class="form-control" name="phone" value="{{ Auth::user()->phone }}" required >
                  </div>
                </div>
              </div>
              
              <button type="submit" class="btn btn-primary pull-right">Update Phone</button>
              <div class="clearfix"></div>
            </form>
            
              <hr>
              {{-- <label for="">Adsress Book </label> --}}
              {{-- <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-plus"></i></a>
              </p> --}}
              <div class="row">
                <div class="col-md-12">
                  <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <div class="card card-body">
                      <form action="{{ url('user/addressbook') }}/" method="post">
                        @csrf
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="bmd-label-floating">Full Name:</label>
                              <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ $fullname ?? old('fullname') }}" required autocomplete="fullname" autofocus>
                              @error('fullname')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="bmd-label-floating">Phone No </label>
                              <input type="number" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror"  name="phone_no" required>
                              @error('phone_no')
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
                              <label class="bmd-label-floating">Area:</label>
                              <input type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ $area ?? old('area') }}" required autocomplete="area" autofocus>
                              @error('area')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>
                          
                          <div class="col-md-6">
                            <div class="form-group">
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                  <i class="fa fa-home"></i> Home
                                  <label class="switch">
                                    <input type="checkbox" name="home" id="home_check" class="info">
                                    <span class="slider"></span>
                                  </label>
                                </li>
                                <li class="list-group-item">
                                  {{-- <i class="fa fa-briefcas"></i>Home --}}
                                  <i class="fa fa-briefcase"></i> Office
                                  <label class="switch">
                                    <input type="checkbox" name="office" id="office_check" class="info">
                                    <span class="slider"></span>
                                  </label>
                                </li>
                              </ul>
                              @error('address')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label class="bmd-label-floating">Address </label>
                              <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"  name="address" required>
                              @error('address')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>
                        <button type="submit" class="btn btn-primary pull-right">Upadte</button>
                        <div class="clearfix"></div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection