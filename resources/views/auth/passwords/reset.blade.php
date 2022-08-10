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
    <title>Product Detail | OrderPak</title>
  </head>
  <style>
  </style>
  <body>
<div class="container-fluid">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 pt-2">
          <div class="login-section">
            <div class="image text-center">
              <a href="/vendor/login"><img src="/frontend/assets/img/Logo.png" class="logo" alt=""></a>
            </div>
                    <form method="POST" action="{{ route('password.update') }}/" class="login-form">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <!--<div class="form-group row">-->
                        <!--    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>-->

                        <!--    <div class="col-md-6">-->
                        <!--        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>-->
                        <!--        <span class="input-group-append">-->
                        <!--          <div class="custom-icon eye-icon"><i class="fas fa-eye-slash" id="eye"></i></div>-->
                        <!--        </span>-->
                        <!--        @error('email')-->
                        <!--            <span class="invalid-feedback" role="alert">-->
                        <!--                <strong>{{ $message }}</strong>-->
                        <!--            </span>-->
                        <!--        @enderror-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="custom-icon"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" placeholder="E-Mail Address" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="custom-icon"><i class="fa fa-user"></i></span>
                            </div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Password">
                            <span class="input-group-append">
                              <div class="custom-icon eye-icon"><i class="fas fa-eye-slash" id="eye"></i></div>
                            </span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="custom-icon"><i class="fa fa-user"></i></span>
                            </div>
                            <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            <span class="input-group-append">
                              <div class="custom-icon eye-icon"><i class="fas fa-eye-slash" id="eye1"></i></div>
                            </span>
                          </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
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
    <script>


  $(function(){
    
    $('#eye').click(function(){
         
          if($(this).hasClass('fa-eye-slash')){
             
            $(this).removeClass('fa-eye-slash');
            
            $(this).addClass('fa-eye');
            
            $('#password').attr('type','text');
              
          }else{
           
            $(this).removeClass('fa-eye');
            
            $(this).addClass('fa-eye-slash');  
            
            $('#password').attr('type','password');
          }
      });
      $('#eye1').click(function(){
         
         if($(this).hasClass('fa-eye-slash')){
            
           $(this).removeClass('fa-eye-slash');
           
           $(this).addClass('fa-eye');
           
           $('#password-confirm').attr('type','text');
             
         }else{
          
           $(this).removeClass('fa-eye');
           
           $(this).addClass('fa-eye-slash');  
           
           $('#password-confirm').attr('type','password');
         }
     });
  });
</script>
  </body>
</html>