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
            <p class="card-category">Complete your Password</p>
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
            <form action="{{ url('user/change_password') }}/" method="post">
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
                        <button type="submit" class="btn btn-primary pull-right">Save Address</button>
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
      {{-- <div class="col-md-4">
        <div class="card card-profile">
          <div class="card-avatar">
            <a href="javascript:;">
              <img class="img" src="/user_panel/assets/img/faces/marc.jpg" />
            </a>
          </div>
          <div class="card-body">            <h4 class="card-title">
              <span class="p1">{{ Auth::user()->fullname }}</span> <i class="fa fa-edit addName1b"></i> <i class="fa fa-check updateName1b"></i></h4>
    <input type="text" class="addName1" value="Player 1"></input>
          </div>
        </div>
      </div> --}}
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$(function() {
  $('.showmore').click(function(e) {
    e.preventDefault();
    var targetrow = $(this).closest('tr').next('.detail');
    targetrow.show();
  });

  $('.close').click(function(e) {
    $('.detail').hide();
  });

});
</script>
<script>
    $(document).ready(function(){
        $('#home_check').click(function(){
            if($(this).prop("checked") == true){
                $("#office_check").prop("checked", false);
            }
        });

        $('#office_check').click(function(){
            if($(this).prop("checked") == true){
                $("#home_check").prop("checked", false);
            }
        });
        $('.home_check').click(function(){
            if($(this).prop("checked") == true){
                $(".office_check").prop("checked", false);
            }
        });

        $('.office_check').click(function(){
            if($(this).prop("checked") == true){
                $(".home_check").prop("checked", false);
            }
        });

      $('.addName1').hide();
      $('.updateName1b').hide();
    });

    $('.addName1b').click(function() {
        var name = $('.p1').text();
        $('.addName1').val(name);

        $('.addName1').show();
        $('.addName1b').hide();
        $('.updateName1b').show();
    });

    $('.updateName1b').click(function() {
        $('.p1').text($('.addName1').val());
        $('.addName1').hide();
        $('.addName1b').show();
        $('.updateName1b').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var fullname = $('.addName1').val();
        // alert(name);
        var url = '/user/editname?fullname='+fullname;
        $.ajax({
           url:url,
           method:'get',
           success:function(response){
              console.log('ad');
            }
        });

    });

</script>
@endsection