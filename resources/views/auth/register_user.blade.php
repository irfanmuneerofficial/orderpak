@extends('layouts.master')

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Online Shopping in Pakistan with Free Home Delivery" />
    <meta property="og:description"        content="OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!" />
    <meta property="og:image"              content="{{ asset('frontend/assets/img/logo_res.png') }}" />
@endsection

@section('twitter_card_meta')
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="join orderpak">
	<meta name="twitter:description" content="Create a Customer Account">
	<meta name="twitter:image" content="">
	<meta name="twitter:url" content="{{url()->current()}}" />
@endsection

@section('page-title')
User Register
@endsection

@section('user-reg-inside')

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "item": {
      "@id": "{{ url('/') }}",
      "name": "Home"
    }
  },{
    "@type": "ListItem",
    "position": 2,
    "item": {
      "name": "join orderpak"
    }
  }]
}
</script>
@endsection

@section('mainContent')
  
         <div class="join-pagination">
            <span><a href="/">Home</a> ></span>
            <span>join orderpak</span>
          </div>
  <form id="regForm" method="post" class="form-back" action="/user/register/" autocomplete="off">
    @csrf
    <a href="https://orderpak.com/"><img class="join-logo" src="/frontend/assets/img/Logo.png" alt="Online Shopping in Pakistan with Free Home Delivery"></a>
    <div id="heading" class="order-heading">
      <h1>Create a Customer Account</h1>
    </div>
  <div class="join-bullets ">
    <span class="step"></span>
    <span class="step"></span>
  </div>
<div class="teb join-input">
  <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
          <i class="fas fa-user"></i>
          <input class="form-control" placeholder="Your Name" name="fullname" required autocomplete="off">
        </div>
        <!--<div class="form-group">-->
        <!--  <i class="fas fa-lock"></i>-->
        <!--  <input class="form-control" type="password" id="password" placeholder="Password">-->
        <!--  <i class="fas fa-eye-slash my-eye" id="eye"></i>-->
        <!--</div>-->
        <!--<div class="form-group">-->
        <!--  <i class="fas fa-lock"></i>-->
        <!--  <input class="form-control" type="password" id="password" placeholder="Password">-->
        <!--  <i class="fas fa-eye-slash my-eye" id="eye"></i>-->
        <!--</div>-->
        <div class="form-group">
          <i class="fas fa-lock"></i>
          <input class="form-control password" type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>
          <i class="fas fa-eye-slash my-eye1" id="eye"></i>
        </div>
        <!--<div class="form-group">-->
        <!--  <i class="fas fa-lock"></i>-->
        <!--  <input class="form-control" type="password" id="password1" placeholder="Confirm Password">-->
        <!--  <i class="fas fa-eye-slash my-eye" id="eye1"></i>-->
        <!--</div>-->
         <div class="form-group">
          <i class="fas fa-lock"></i>
          <input class="form-control confirm_password" type="password" id="password1" autocomplete="off" placeholder="Confirm Password" required>
          <i class="fas fa-eye-slash my-eye2" id="eye1"></i>
        </div>
        <!--<div class="form-group mb-0">-->
        <!--  <i class="fas fa-lock"></i>-->
        <!--  <input class="form-control" id="confirmpassword" type="password" placeholder="Confirm Password" name="password">-->
        <!--</div>-->
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <span id="businesserror" class="alert-login"></span>
        <div class="form-group">
        <i class="fas fa-envelope"></i>
        <input class="form-control" type="email" placeholder="E-mail..." id="email"  autocomplete="off" name="email" required>
      </div>
      <span id="phoneerror" class="alert-login"></span>
      <div class="form-group">
          <div class="input-group-prepend">
            <i class="fas fa-phone-alt"></i> 
            <div class="input-group-text prepend-input">+92</div>
          </div>
          <input class="form-control input-phone" id="phone_no" name="phone_no" type="number" autocomplete="off" required onchange="checkPhone(this.value)" placeholder="34567890" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" />
      </div>
      <div class="form-group">
          <span id='message'></span>
      </div>
      </div>
  </div>
  <div class="custom-control custom-checkbox join-us-checkbox">
        <label for="defaultCheck">
          <input type="checkbox" required="" id="defaultCheck" name="example2"> I have read and accepted the <a href="#" data-toggle="modal" data-target="#exampleModalLong"> Terms & Conditions</a></label>
      </div>
      <div class="join-op-btn">
      <button type="submit" id="submituser" class="btn btn-light">Register</button>        
      </div>
</div>
  {{-- <div class="tab join-input">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
          <i class="fas fa-user"></i>
          <input class="form-control" placeholder="Your Name" name="fullname">
        </div>
        <div class="form-group">
          <i class="fas fa-lock"></i>
          <i class="far fa-eye-slash icon" onclick="myFunction()"></i>
          <input class="form-control" id="password" type="password" id="myInput" placeholder="********" name="password">
        </div>
        <div class="form-group mb-0">
          <i class="fas fa-lock"></i>
          <input class="form-control" id="confirmpassword" type="password" placeholder="confrim password" name="password">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <span id="businesserror" class="alert-danger"></span>
        <div class="form-group">
        <i class="fas fa-envelope"></i>
        <input class="form-control" placeholder="E-mail..." id="email" onchange="checkemail(this.value)" name="email">
      </div>
      <span id="phoneerror" class="alert-danger"></span>
      <div class="form-group">
          <div class="input-group-prepend">
            <i class="fas fa-phone-alt"></i> 
            <div class="input-group-text prepend-input">+92</div>
          </div>
          <input class="form-control input-phone" id="phone_no" name="phone_no" type="number" onchange="checkPhone(this.value)" placeholder="34567890" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" />
      </div>
      <div class="form-group">
          <span id='message'></span>
      </div>
      </div>
  </div>
    <div class="custom-control custom-checkbox join-us-checkbox">
        <label for="defaultCheck">
          <input type="checkbox" id="defaultCheck" name="example2"> I have read and accepted the <a href="#" data-toggle="modal" data-target="#exampleModalLong"> Terms & Conditions</a></label>
      </div>           
</div> --}}
  {{-- <div class="tab join-input-3">
    <div class="form-group verify-input">
        <p id="verify_nom"></p>
      </div>
    <h2>enter orderpak verification code</h2>
      <p>Lorem ipsum dolor sit amet, consetetur</p>
      <div class="otp" id="">
        <input class="form-control abc" type="text" name="verification_code[]" onInput="edValueKeyPress()" id="first" maxlength="1" />
        <input class="form-control abc" type="text" name="verification_code[]" onInput="edValueKeyPress()" id="second" maxlength="1" />
        <input class="form-control abc" type="text" name="verification_code[]" onInput="edValueKeyPress()" id="third" maxlength="1" />
        <span>-</span>
        <input class="form-control abc" type="text" name="verification_code[]" onInput="edValueKeyPress()" id="fourth" maxlength="1" />
        <input class="form-control abc" type="text" name="verification_code[]" onInput="edValueKeyPress()" id="fifth" maxlength="1" />
        <input class="form-control abc" type="text" name="verification_code[]" onInput="edValueKeyPress()" id="sixth" maxlength="1" />
      </div>
  </div> --}}
  {{-- <div class="tab join-input-4">
    <h2>Confirm Your Phone</h2>
    <img class="animate__animated animate__fadeIn" src="/frontend/assets/img/user.png">
    <h3>Welcome to <strong>ORDERPAK</strong></h3>
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna.</p>
    <div class="user-btn">
          <a href="shop.html"><button type="button" class="btn btn-light">Go To Shop</button></a>
        </div>
  </div> --}}
  {{-- <div style="overflow:auto;">
    <div style="text-align: center;">
      <button type="button" id="prevBtn" class="test" onclick="nextPrevv(-1)">Previous</button>
      <button  type="button" id="nextBtn" onclick="nextPrevv(1)">Continue</button>
    </div>
  </div> --}}
</form>
<!-- Button trigger modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
$("#regForm").submit(function(){
     if($(".password").val()!=$(".confirm_password").val())
     {
         alert("password Not Matching");
         return false;
     }
     
     
     if($("#phone_no").val().length < '10')
     {
         alert("Number 11 Digit Required");
         return false;
     }
 })
  $('.password, .confirm_password').on('keyup', function () {
  if ($('#password').val() == $('.confirm_password').val() && $('#password').val() != '' ) {
    $('#message').html('Password Matching').css('color', 'green');
    // $('#submituser').removeAttr("disabled");
  } else {
    if($('.confirm_password').val() != ''){
    $('#message').html('Password Not Matching').css('color', 'red');
      }
    // $("#submituser").prop('disabled', true);
  }
});
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Terms & Conditions</h5>
        <button type="button" class="close1" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Caption</h4>
        <p> Thank you for choosing briskpayment Point of Sale Software and Services. This Merchant User License together with the sales order form (as defined below) you enter into (the “Sales Order Form”) are referred to collectively as the “License” or the “Agreement”, and gives you certain non-exclusive rights and responsibilities depending on which version of the software and services package you purchase.</p>
        <br>
 <h4>Caption</h4>
<p>The term “Software” shall mean the point of sale software provided to you, the merchant (“you” or “Licensee”), by briskpayment Services LLC ( the “Company”, “we”, “us” or “our”) under this Agreement (or by any agreement You may have with a reseller or master licensee of the Company’s Software); the term “Software” shall include without limitation, any other programs, apps, tools, internet-based services, plug-ins, components and any “updates” made available to you (for example, Software maintenance, service information, help content, bug fixes, patches or maintenance releases etc.) or “upgrades” of the Software that the Company elects, in its sole discretion, to provide or make available to you after the date you obtained your initial copy of the Software.</p>
<br>  
<h4>Caption</h4>
<p>The term “Software” shall mean the point of sale software provided to you, the merchant (“you” or “Licensee”), by briskpayment Services LLC ( the “Company”, “we”, “us” or “our”) under this Agreement (or by any agreement You may have with a reseller or master licensee of the Company’s Software); the term “Software” shall include without limitation, any other programs, apps, tools, internet-based services, plug-ins, components and any “updates” made available to you (for example, Software maintenance, service information, help content, bug fixes, patches or maintenance releases etc.) or “upgrades” of the Software that the Company elects, in its sole discretion, to provide or make available to you after the date you obtained your initial copy of the Software.  
</p>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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
           
           $('#password1').attr('type','text');
             
         }else{
          
           $(this).removeClass('fa-eye');
           
           $(this).addClass('fa-eye-slash');  
           
           $('#password1').attr('type','password');
         }
     });
  });
$(".abc").keyup(function () {
    if (this.value.length == this.maxLength) {
      var $next = $(this).next('.abc');
      if ($next.length)
          $(this).next('.abc').focus();
      else
          $(this).blur();
    }
});



$('#email').on("input",function(){
    var val = $('#email').val();
    $.get('{{ url('/register_user/check/email') }}', 
      { 'email': val }, 
      function( data ) 
      {
        if(data.error)
        {
          $('#businesserror').text(data.error);
          $('#email').val(null);
        }
        else{
            // alert("error");
            $('#businesserror').empty();
        //   $('#email').val(data.email);
        }
      }
    );
    });

    function checkPhone(valu) {
        var val = '+92'+valu;
        //alert(val);
    $.get('{{ url('/register_user/check/phone') }}', 
      { 'phone': val }, 
      function( data ) 
      {
          //alert(data);
        if(data.error)
        {
          $('#phoneerror').text(data.error);
          $('#phone_no').val(null);
        }
        else{
             $('#phoneerror').empty();
        //   $('#phone_no').val(data.success);
        }
      }
    );
    }
    
    function edValueKeyPress() 
    {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var edValue1 = document.getElementById("first");
        var phone = document.getElementById("phone_no");
        // if(edValue1.value != null){
        //  alert(phone.value);   
        // }
        var edValue2 = document.getElementById("second");
        var edValue3 = document.getElementById("third");
        var edValue4 = document.getElementById("fourth");
        var edValue5 = document.getElementById("fifth");
        var edValue6 = document.getElementById("sixth");
        
        if(!edValue1.value == '' ){
            if(!edValue2.value == '' ){
                if(!edValue3.value == '' ){
                    if(!edValue4.value == '' ){
                        if(!edValue5.value == '' ){
                            if(!edValue6.value == '' ){
                              var dataa = edValue1.value + edValue2.value + edValue3.value + edValue4.value + edValue5.value + edValue6.value;
                               //alert(dataa);
                                var url ='/register_user/phone?phone=+92'+phone.value+'&verify='+dataa; 
                                  $.ajax({
                                    url: url,
                                    type: 'get',
                                    dataType: 'json',
                                    success: function (response) {
                                        
                                        if(response.data == 'valid'){
                                            $("#nextBtn").show();
                                        }
                                        
                                        if(response.data == 'non-valid'){
                                        alert(response.data);
                                            edValue1.value('');
                                            edValue2.value('');
                                            edValue3.value('');
                                            edValue4.value('');
                                            edValue5.value('');
                                            edValue6.value('');
                                            
                                        }
                                    }
                                });
                            }
                        }
                    }
                }
            }
            
        }
    
    }
</script>
@endsection