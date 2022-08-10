<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here"/>
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/bootstra') }}p.min.css">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/') }}style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"/>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css"> -->
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/jque') }}ry-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <title>@yield('title') | OrderPak</title>
  </head>
  <style>
  </style>
  <body>
    @yield('content')
    <script src="{{ asset('/frontend/assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="{{ asset('/frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/script.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/jquery.zoom.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/zoom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/owl.carousel.min.js"></script>
    <script src="{{ asset('/frontend/assets/js/jquery-ui.min.js') }}"></script>
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