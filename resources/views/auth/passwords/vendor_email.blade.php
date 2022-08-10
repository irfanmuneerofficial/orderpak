<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here"/>
    <link rel="stylesheet" href="/frontend/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/frontend/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"/>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css"> -->
    <link rel="stylesheet" href="/frontend/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <title>Reset Password | OrderPak</title>
  </head>
  <style>
  </style>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 pt-2">
          <div class="login-section">
            <div class="image text-center">
              <a href="/"><img src="/frontend/assets/img/Logo.png" class="logo" alt=""></a>
            </div>
                @if (session('message'))
                     <div id="businesserror" class="alert-login" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                 @if (session('status'))
                        <div id="businesserror" class="alert-login" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div id="businesserror" class="alert-login" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
            <form action="/vendor/forget-password/" method="post" class="login-form">
              @csrf
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="custom-icon"><i class="fa fa-user"></i></span>
                </div>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="checkbox-main">
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="checkbox">
                      {{-- <input type="checkbox" id="remember"> --}}
                      {{-- <p class="remember">Remember</p> --}}
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 text-right">
                    <div class="login-btn">
                      <button type="submit" class="btn btn-light">Reset Link</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="register-now">
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 p-0">
                    <div class="regiter-btn">
                      <a href="/vendor/register"><button type="button" class="btn btn-link">Register Now</button></a>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 text-right">
                    <div class="forgot-btn">
                      <a href="/vendor/login"><button type="button" class="btn btn-link">Login?</button></a>
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
    <script src="/frontend/assets/js/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="/frontend/assets/js/bootstrap.min.js"></script>
    <script src="/frontend/assets/js/script.js"></script>
    <script src="/frontend/assets/js/jquery.zoom.js"></script>
    <script src="/frontend/assets/js/zoom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/owl.carousel.min.js"></script>
    <script src="/frontend/assets/js/jquery-ui.min.js"></script>
    <script src="https://kenwheeler.github.io/slick/slick/slick.js"></script>
  </body>
</html>