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
	<meta name="twitter:description" content="Create a Dealer Account">
	<meta name="twitter:image" content="">
	<meta name="twitter:url" content="{{url()->current()}}" />
@endsection
    
@section('page-title')
Dealer Register
@endsection

@section('dealer-reg-inside')

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
<form id="regForm" method="post" class="form-back" action="/register_vendor/">
    @csrf
<a href="https://orderpak.com/"><img class="join-logo" src="/frontend/assets/img/Logo.png" alt="Online Shopping in Pakistan with Free Home Delivery"></a>
<div id="heading" class="order-heading">
  <h1>Create a Dealer Account</h1>
</div>
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
<div class="join-bullets ">
<span class="step"></span>
<span class="step"></span>
</div>

{{-- <div class="tab join-input">
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="form-group">
      <i class="fas fa-briefcase"></i>
      <input class="form-control" placeholder="First name..." name="first_name">
    </div>
    <span id="businesserror" class="alert-login"></span>
    <div class="form-group">
      <i class="fas fa-envelope"></i>
      <input class="form-control " placeholder="Business E-mail" id="business_email" onchange="checkemail(this.value)" name="business_email" autocomplete="false">
    </div>

    <div class="form-group">
  		<i class="fas fa-envelope"></i>
  		<!--<input class="form-control" placeholder="CNIC" name="cnic" required="">-->
  		
	</div>
// 	<script>
//     $("#cmic").inputmask();

//   </script>
    <div class="form-group">
      <i class="fas fa-lock"></i>
      <i class="far fa-eye-slash icon" onclick="myFunction()"></i>
      <input class="form-control"type="password" id="myInput" placeholder="****" name="password">
    </div>
    <div class="form-group mb-0">
        <i class="fas fa-map-marker-alt"></i>
        <input class="form-control" placeholder="Business Address" name="business_address" required="">
      </div>
    <div class="form-group mb-0">
      <i class="fas fa-map-marker-alt"></i>
      <input class="form-control" placeholder="Personal Address" name="personal_address" required="">
    </div>
    <div class="form-group mb-0">
      <i class="fas fa-building"></i>
      <input class="form-control" readonly="" value="Karachi" placeholder="City" name="city">
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="form-group">
    <i class="fas fa-user"></i>
    <input class="form-control" placeholder="Last name..." name="last_name">
  </div>

    <div class="form-group">
    <i class="fas fa-envelope"></i>
    <input class="form-control" placeholder="Personal E-mail" name="personal_email">
  </div>s
  <span id="phoneerror" class="alert-login"></span>
  <div class="form-group">
  <div class="input-group-prepend">
    <i class="fas fa-phone-alt"></i> 
    <div class="input-group-text prepend-input">+92</div>
  </div>
  <input class="form-control input-phone" id="phone_no" name="phone_no" type="number" onchange="checkPhone(this.value)" placeholder="34567890" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" />
</div>

   <div class="form-group">
    <i class="fas fa-file-archive" aria-hidden="true"></i>
    <input class="form-control" placeholder="zip code" name="zipcode">
  </div>
  </div>
</div>
<div class="custom-control custom-checkbox join-us-checkbox">
    <label for="defaultCheck">
      <input type="checkbox" required="" id="defaultCheck" name="example2"> I have read and accepted the <a href="#" data-toggle="modal" data-target="#exampleModalLong"> Terms & Conditions</a></label>
  </div>           
</div> --}}
{{-- <div class="tab join-input-3">
<div class="form-group verify-input">
  <p id="verify_nom"></p>
  </div>
<h2>enter orderpak verification code</h2>
  <p>We just sent a verification code. Enter it below to confirm your account.</p>

    <div class="otp" id="">
        <input class="form-control abc" type="number" type="text" name="verification_code[]" onInput="edValueKeyPress()" id="first" maxlength="1" />
        <input class="form-control abc" type="number" type="text" name="verification_code[]" onInput="edValueKeyPress()" id="second" maxlength="1" />
        <input class="form-control abc" type="number" type="text" name="verification_code[]" onInput="edValueKeyPress()" id="third" maxlength="1" />
        <span>-</span>
        <input class="form-control abc" type="number" type="text" name="verification_code[]" onInput="edValueKeyPress()" id="fourth" maxlength="1" />
        <input class="form-control abc" type="number" type="text" name="verification_code[]" onInput="edValueKeyPress()" id="fifth" maxlength="1" />
        <input class="form-control abc" type="number" type="text" name="verification_code[]" onInput="edValueKeyPress()" id="sixth" maxlength="1" />
      </div>
</div> --}}
{{-- <div class="tab join-input-4">
<h2>welcome to your next level business journey</h2>
<img class="animate_animated animate_fadeIn" src="/frontend/assets/img/vender.png">
<div class="order-buttons">
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="vender-btn">
      <button type="button" class="btn btn-light">Back to Home</button>
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="vender-btn-2">
     <button type="button" class="btn btn-light">Go to your dashboard</button>
    </div>
  </div>
</div>
</div>
</div> --}}
{{-- <div style="overflow:auto;">
<div style="text-align: center;">
  <button type="button" id="prevBtn" class="test" onclick="nextPrev(-1)">Previous</button>
  <button  type="button" id="nextBtn" onclick="nextPrev(1)">Submit</button>
</div>
</div> --}}

<div class="tab join-input">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
          <i class="fas fa-user"></i>
          <input class="form-control" placeholder="First name..." name="first_name" required="">
        </div>
        <div class="form-group">
        <i class="fas fa-user"></i>
        <input class="form-control" placeholder="Last name..." name="last_name" required="">
      </div>
      <span id="cmicerror" class="alert-login"></span>
      <div class="form-group">
          <i class="fa fa-id-card"></i>
            <!--<input class="form-control"  type="number" max="15" name="cnic" placeholder="CNIC" required="">-->
            <input type="text" class="form-control"  data-inputmask="'mask': '99999-9999999-9'" id="cmic"  placeholder="XXXXX-XXXXXXX-X"  name="cnic" required="" >
    	</div>
    	<span id="phoneerror" class="alert-login"></span>
      <div class="form-group">
          <div class="input-group-prepend">
            <i class="fas fa-phone-alt"></i> 
            <div class="input-group-text prepend-input">+92</div>
          </div>
          <input maxlength="10" value="" class="form-control input-phone" id="phone_no" name="phone_no" type="text" autocomplete="off" required="" placeholder="3456789096">
      </div>
      <div class="form-group">
          <i class="fas fa-lock"></i>
          <i class="fas fa-eye-slash my-eye3" id="eye"></i>
          <input class="form-control password" type="password" id="password" name="password" placeholder="Password">
        </div>
      <div class="form-group">
          <i class="fas fa-lock"></i>
          <i class="fas fa-eye-slash my-eye4" id="eye1"></i>
          <input class="form-control confirm_password" type="password" id="password1" name="confirm_password" placeholder="Confirm Password">
        </div>
      <div class="form-group">
          <span id='message'></span>
      </div>
      
           
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
          <span id="business_name_error" class="alert-login"></span>
      <div class="form-group">
        <i class="fas fa-briefcase"></i>
        <input class="form-control" placeholder="Business Name" name="business_name" id="business_name" required="">
        <!--<input class="form-control" placeholder="Business Name" name="business_name" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" required="">-->
      </div>
      <span id="businesserror" class="alert-login"></span>
      <div class="form-group">
        <i class="fas fa-envelope"></i>
        <input class="form-control" placeholder="Buisness E-mail" id="buissnes" name="business_email" required="">
      </div>
      <div class="form-group">
          <i class="fa fa-map-marker"></i>
          <input class="form-control" placeholder="Business Address" name="business_address" required="">
      </div>
      <div class="form-group">
                    <div class="input-group-prepend">
            <i class="fas fa-phone-alt"></i> 
            <div class="input-group-text prepend-input">+92</div>
          </div>
          <input maxlength="10" value="" class="form-control input-phone" id="alternate_phone_no" name="alternate_phone_no" type="text" autocomplete="off" required="" placeholder="3456789096">
      </div>
      <div class="form-group">
      <select class="form-select form-select-lg mb-3" name="state" id="province" required></select>
      </div>
      <div class="form-group mb-3">
            <select class="form-select form-select-lg mb-3" name="city" id="city" required></select>
     </div>
      <!-- <select name="state">
          <option value="sindh">Sindh</option>
          <option value="punjab">Punjab</option>
          <option value="balochistan">Balochistan</option>
          <option value="khyber pakhtunkhwa">Khyber Pakhtunkhwa</option>
        </select>
      <select name="city">
          <option value="karachi">Karachi</option>
        </select>
      </div> -->
      <div class="form-group">
          <span id='message'></span>
      </div>
  </div>
    <div class="custom-control custom-checkbox join-us-checkbox">
        <label for="defaultCheck">
          <input type="checkbox" required="" id="defaultCheck" name="example2"> I have read and accepted the <a href="#" data-toggle="modal" data-target="#exampleModalLong"> Terms & Conditions</a></label>
      </div>   
      <div class="join-op-btn">
      <button type="submit" disabled id="submituser" class="btn btn-light">Register</button>        
      </div>
</div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script type="text/javascript">
$("#cmic").inputmask();
  $('.password, .confirm_password').on('keyup', function () {
  if ($('#password').val() == $('.confirm_password').val() && $('#password').val() != '' ) {
    var textLength = $('#password').val().length;
    if(textLength < 6)
    {
      $('#message').html('Password Must be 6 Character Long').css('color', 'red');
    }
    else{
    $('#message').html('Password Matching').css('color', 'green');
    $('#submituser').removeAttr("disabled");
    }
  } else {
      if($('.confirm_password').val() != ''){
    $('#message').html('Password Not Matching').css('color', 'red');
      }
    $("#submituser").prop('disabled', true);
    
  }
});
</script>
<!-- Button trigger modal -->

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
$(document).ready(function() {
    
    // $('#business_name').bind('input', function() {
    //   var c = this.selectionStart,
    //       r = /[^a-z0-9 .]/gi,
    //       v = $(this).val();
    //   if(r.test(v)) {
    //     $(this).val(v.replace(r, ''));
    //     c--;
    //   }
    //   this.setSelectionRange(c, c);
    // });
    $("#cmic").on('input', function () {
    var cmic = $(this).val();
    alert(cmic);
    if($(this).val().length = 15){
        $.get('{{ url('/register/check/business_cnic') }}', 
          { 'cnic': cmic }, 
          function( data ) 
          {
            
            if(data.error)
            {
                //   alert('data.error');
              $('#cmicerror').text(data.error);
              $('#cmic').val(null);
            }
            else{
                //   alert('data.success');
                 $('#cmicerror').empty();
            //   $('#cmic').val(data.success);
            }
          }
        );
    }
    });

    $("#phone_no").on('input', function () {
    var phone_no = $(this).val();
    if($(this).val().length = 10){
        $.get('{{ url('/register/check/phone') }}', 
          { 'phone': phone_no }, 
          function( data ) 
          {
            
            if(data.error)
            {
                //   alert('data.error');
              $('#phoneerror').text(data.error);
              $('#phone_no').val(null);
            }
            else{
                //   alert('data.success');
                 $('#phoneerror').empty();
            //   $('#phone_no').val(data.success);
            }
          }
        );
    }
    });
    
    $("#buissnes").on('input', function () {
        var email = $(this).val();
        // alert(email);
        $.get('{{ url('/register/check/business_email') }}', 
          { 'business_email': email }, 
          function( data ) 
          {
            if(data.error)
            {
              $('#businesserror').text(data.error);
              $('#buissnes').val(null);
            }
            else{
                // alert("error");
                $('#businesserror').empty();
            //   $('#buissnes').val(data.business_mail);
            }
          }
        );
    });
    
    $("#business_name").on('input', function () {
        var name = $(this).val();
        // alert(email);
        $.get('{{ url('/register/check/business_name') }}', 
          { 'business_name': name }, 
          function( data ) 
          {
            if(data.error)
            {
              $('#business_name_error').text(data.error);
              $('#business_name').val(null);
            }
            else{
                // alert("error");
                $('#business_name_error').empty();
            //   $('#buissnes').val(data.business_mail);
            }
          }
        );
    });

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


    function checkPhone(val) {
    $.get('{{ url('/register/check/phone') }}', 
      { 'phone': val }, 
      function( data ) 
      {
        if(data.error)
        {
          $('#phoneerror').text(data.error);
          $('#phone_no').val(null);
        }
        else{
             $('#phoneerror').empty();
          $('#phone_no').val(data.success);
        }
      }
    );
    }
});    
    // function edValueKeyPress() 
    // {
    //     $.ajaxSetup({
    //         headers: {
    //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     var edValue1 = document.getElementById("first");
    //     var phone = document.getElementById("phone_no");
    //     // if(edValue1.value != null){
    //     //alert('phone.value');   
    //     // }
    //     var edValue2 = document.getElementById("second");
    //     var edValue3 = document.getElementById("third");
    //     var edValue4 = document.getElementById("fourth");
    //     var edValue5 = document.getElementById("fifth");
    //     var edValue6 = document.getElementById("sixth");
        
    //     if(!edValue1.value == '' ){
    //         if(!edValue2.value == '' ){
    //             if(!edValue3.value == '' ){
    //                 if(!edValue4.value == '' ){
    //                     if(!edValue5.value == '' ){
    //                         if(!edValue6.value == '' ){
    //                           var dataa = edValue1.value + edValue2.value + edValue3.value + edValue4.value + edValue5.value + edValue6.value;
    //                           //alert(dataa);
    //                             var url ='/register/phone?phone=+92'+phone.value+'&verify='+dataa; 
    //                               $.ajax({
    //                                 url: url,
    //                                 type: 'get',
    //                                 dataType: 'json',
    //                                 success: function (response) {
    //                                     //alert(response.data);
    //                                     if(response.data == 'valid'){
    //                                         $("#nextBtn").show();
    //                                     }
    //                                     if(response.data == 'non-valid'){
    //                                         alert(response.data);
    //                                         edValue1.value('');
    //                                         edValue2.value('');
    //                                         edValue3.value('');
    //                                         edValue4.value('');
    //                                         edValue5.value('');
    //                                         edValue6.value('');
    //                                     }
    //                                 }
    //                             });
    //                         }
    //                     }
    //                 }
    //             }
    //         }
            
    //     }
    
    // }

    $('.input-phone').on('keyup', function(e){
        if (/\D/g.test(this.value)){
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });
</script>
<script type="text/javascript">
        $(document).ready(function () {
                $.ajax({
                    url: '{{ route('getProvinces') }}',
                    type: 'get',
                    success: function (res) {
                      // alert(res);
                        $('#province').html('<option value="">Select Province</option>');
                        $.each(res, function (key, value) {
                            $('#province').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city').html('<option value="">Select City</option>');
                    }
                });

            $('#province').on('change', function () {
                var stateId = this.value;
                $('#city').html('');
                $.ajax({
                    url: '{{ route('getCities') }}?province_id='+stateId,
                    type: 'get',
                    success: function (res) {
                        $('#city').html('<option value="">Select City</option>');
                        $.each(res, function (key, value) {
                            $('#city').append('<option value="' + value
                                .city_slug + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection