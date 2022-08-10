@extends('layouts.app')
@section('title')
Reset Password 
@endsection
@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div id="businesserror" class="alert-login" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}/">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="container-fluid">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 pt-2">
          <div class="login-section">
            <div class="image text-center">
              <a href="/"><img src="/frontend/assets/img/Logo.png" class="logo" alt=""></a>
                <div class="card-header">{{ __('Reset Password') }}</div>
            </div>
            <form method="POST" class="login-form" action="{{ route('password.email') }}/">
            @csrf
            @if (session('status'))
                <div id="businesserror" class="alert-login" role="alert">
                    {{ session('status') }}
                </div>
            @endif
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="custom-icon"><i class="fa fa-user"></i></span>
                </div>
                
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                
              </div>
              @error('email')
                    <span id="businesserror" class="alert-login" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="checkbox-main">
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="regiter-btn">
                      <a href="/user/register"><button type="button" class="btn btn-light">Register Now</button></a>
                    </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 text-right">
                        <div class="login-btn">
                          <button type="submit" class="btn btn-light">{{ __('Reset Link') }}</button>
                        </div>
                      </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 text-right p-0">
          <div id="carouselExampleFade" class="carousel slide carousel-fade carousel-login" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="" src="/frontend/assets/img/order-login.png" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="" src="/frontend/assets/img/order-login1.png" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="" src="/frontend/assets/img/order-login2.png" alt="Third slide">
              </div>
               <div class="carousel-item">
                <img class="" src="/frontend/assets/img/order-login3.png" alt="Third slide">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
