<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    
    <meta property="fb:app_id" content="193101284756200" />
    <meta property="og:url" content="{{url()->current()}}" />

    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Online Shopping in Pakistan with Free Home Delivery" />
    <meta property="og:description"        content="OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!" />
    <meta property="og:image"              content="{{ asset('frontend/assets/img/logo_res.png') }}" />

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Login a Customer Account">
    <meta name="twitter:description" content="Login a Customer Account">
    <meta name="twitter:image" content="">
    <meta name="twitter:url" content="{{url()->current()}}" />
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here"/>
    <link rel="stylesheet" href="/frontend/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/frontend/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3//frontend/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3//frontend/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"/>
    <link rel="stylesheet" href="/frontend/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <title>Login User | OrderPak</title>
  </head>
  <style>
  </style>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 pt-2">
          <div class="login-section">
            <div class="image text-center">
              <a href="/"><img src="/frontend/assets/img/Logo.png" class="logo" alt="Online Shopping in Pakistan with Free Home Delivery"></a>
            </div>
            
            <div class="loginlink">
                <h3>Login a Customer Account</h3>
                <!--<h4>or</h4>
              <a href="/vendor/login">Login as Dealer</a>-->
            </div>
            @foreach ($errors->all() as $error)
                    <div class="alert alert-success" role="alert">
                    {{ $error }}
                </div>
                @endforeach
            <form action="{{ route('login') }}/" method="post" class="login-form">
              @csrf
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="custom-icon"><i class="fa fa-envelope-square"></i></span>
                </div>
                <input type="email" name="email" required="" class="form-control" placeholder="Email">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="custom-icon"><i class="fa fa-lock"></i></span>
                </div>
                <input class="form-control py-2 border" required="" type="password" name="password" id="password" placeholder="Password">
                
              </div>
              <div class="checkbox-main">
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <!--<div class="checkbox">-->
                    <!--  <input type="checkbox" id="remember">-->
                    <!--  <p class="remember">Remember</p>-->
                    <!--</div>-->
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 text-right">
                    <div class="login-btn">
                      <button class="btn btn-light">Login</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="register-now">
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                    <div class="regiter-btn">
                      <a href="/user/register">Register Now</a>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 text-lg-right">
                    <div class="forgot-btn">
                      <a href="{{ url('/user/forgot') }}" class="btn btn-link">Forgot Password?</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="justify-info">-->
              <!--  <div class="left-line">&nbsp;</div>-->
              <!--  <div class="center-text">or</div>-->
              <!--  <div class="right-line">&nbsp;</div>-->
              <!--</div>-->
              <!-- <div class="login-icons">
                <a href="#" class="btn btn-block btn-social btn-facebook">
                  <i class="fab fa-facebook-square"></i>
                  Login with Facebook
                </a>
                <a href="#" class="btn btn-block btn-social1 btn-twitter">
                  <i class="fab fa-twitter"></i>
                  Login with Twitter
                </a>
                <a href="#" class="btn btn-block btn-social2 btn-google">
                  <i class="fab fa-google"></i>
                  Login with Google
                </a>
              </div> -->
            </form>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 text-right p-0">
          <div id="carouselExampleFade" class="carousel slide carousel-fade carousel-login" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="" src="/frontend/assets/img/order-login01.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="" src="/frontend/assets/img/order-login02.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="" src="/frontend/assets/img/order-login03.jpg" alt="Third slide">
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
  });
</script>