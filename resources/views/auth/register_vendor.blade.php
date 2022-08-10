<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>FormWizard_v10</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="/vendor_panel/register/fonts/material-design-iconic-font/css/material-design-iconic-font.css">

		<!-- DATE-PICKER -->
		<link rel="stylesheet" href="/vendor_panel/register/vendor/date-picker/css/datepicker.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="/vendor_panel/register/css/style.css">
	</head>
	<body>
		{{-- <div class="wrapper"> --}}
            {{-- <form action="" id="wizard">
        		<!-- SECTION 1 -->
                <h4></h4>
                <section>
                    <div class="inner">
                    	<a href="#" class="avartar">
                    		<img src="/vendor_panel/register/images/avartar.png" alt="">
                    	</a>
                    	<div class="form-row form-group">
                    		<div class="form-holder">
                    			<input type="text" class="form-control" required placeholder="Your Buissness Form">
                    		</div>
                    		<div class="form-holder">
                    			<input type="text" class="form-control" placeholder="Your Name">
                    		</div>
                    	</div>
                        <div class="form-row form-group">
                            <div class="form-holder">
                                <input type="email" class="form-control" placeholder="Your Buissness Email">
                            </div>
                            <div class="form-holder">
                                <input type="email" class="form-control" placeholder="Your Email">
                                <i class="zmdi zmdi-email small"></i>
                            </div>
                        </div>
                    	<div class="form-row">
                    		<div class="form-holder">
                    			<input type="password" class="form-control" placeholder="Password">
                    			<i class="zmdi zmdi-lock-open small"></i>
                    		</div>
                    	</div>
                    	<div class="form-row">
                    		<div class="form-holder">
                    			<input type="text" class="form-control" placeholder="Phone">
                    			<i class="zmdi zmdi-smartphone-android"></i>
                    		</div>
                    	</div>
                    </div>
                </section>
                
				<!-- SECTION 2 -->
                <h4></h4>
                <section>
                	<div class="inner">
                		<a href="#" class="avartar">
                    		<img src="/vendor_panel/register/images/avartar.png" alt="">
                    	</a>
                        <div class="form-row form-group">
                            <div class="form-holder">
                                <input id="searchTextField" class="form-control" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" />  
                            </div>
                            <div class="form-holder">
                                <input type="text" class="form-control" placeholder="Province">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="form-holder">
                                <input readonly="" id="city2" name="city2" class="form-control" placeholder="City">
                            </div>
                            <div class="form-holder">
                                <input type="number" id="zipcode" class="form-control" placeholder="Zip Code">
                                <i class="zmdi zmdi-email small"></i>
                            </div>
                        </div>
                	</div>
                </section>

                <!-- SECTION 3 -->
                <h4></h4>
                <section class="section-3">
                    <div class="inner">
                        <a href="#" class="avartar">
                            <img src="/vendor_panel/register/images/avartar.png" alt="">
                        </a>
                        <h6>Confirmation Method</h6>
                        <div class="form-holder">
                            <input type="number" class="form-control" placeholder="Confirmation Code">
                            <i class="zmdi zmdi-map small"></i>
                        </div>
                    </div>
                </section>
            </form> --}}
            <style>
fieldset
{
   display:none;
   width:320px;
   height: 235px;
   border-radius:5px;
   padding:5px;
   margin:10px;
   box-shadow:2px 2px 8px 5px grey;

}
#first{
    display:block;
    width:320px;
    height: 235px;
    border-radius:5px;
    padding:5px;
    margin:10px;
   box-shadow:2px 2px 8px 5px grey;
}

input[type="submit"] {
    width: 124px;
    float: right;
    padding: 9px;
    margin:10px 5px;
    background: #23c562;
    color: #fff;
    font-weight: 900;
    border: none;
}
input[type="button"] {
    width: 124px;
    float: right;
    padding: 9px;
    margin:10px 5px;
    background: #23c562;
    color: #fff;
    font-weight: 900;
    border: none;
}

</style>
            <form action="/vendor/register/" method="post">
                @csrf
                <fieldset id="first">
                    <div class="inner">
                        <a href="#" class="avartar">
                            <img src="/vendor_panel/register/images/avartar.png" alt="">
                        </a>
                        <div class="form-row form-group">
                            <div class="form-holder">
                                <input type="text" class="form-control" required placeholder="Your Buissness Form">
                            </div>
                            <div class="form-holder">
                                <input type="text" class="form-control" placeholder="Your Name">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="form-holder">
                                <input type="email" class="form-control" placeholder="Your Buissness Email">
                            </div>
                            <div class="form-holder">
                                <input type="email" class="form-control" placeholder="Your Email">
                                <i class="zmdi zmdi-email small"></i>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-holder">
                                <input type="password" class="form-control" placeholder="Password">
                                <i class="zmdi zmdi-lock-open small"></i>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-holder">
                                <input type="text" id="phone_number" class="form-control" placeholder="Phone">
                                <i class="zmdi zmdi-smartphone-android"></i>
                            </div>
                        </div>
                    </div>
                    <input type="button" name="name" onclick="next()" value="Next"><br>
                </fieldset>
                <fieldset id="second">
                    <h4>Second Step</h4>
                    <div class="inner">
                        <a href="#" class="avartar">
                            <img src="/vendor_panel/register/images/avartar.png" alt="">
                        </a>
                        <div class="form-row form-group">
                            <div class="form-holder">
                                <input id="searchTextField" class="form-control" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" />  
                            </div>
                            <div class="form-holder">
                                <input type="text" class="form-control" placeholder="Province">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="form-holder">
                                <input readonly="" id="city2" name="city2" class="form-control" placeholder="City">
                            </div>
                            <div class="form-holder">
                                <input type="number" id="zipcode" class="form-control" placeholder="Zip Code">
                                <i class="zmdi zmdi-email small"></i>
                            </div>
                        </div>
                    </div>
                    <input type="button" id="firstnext" value="Next">
                    <input type="button" name="previous" onclick="prev()" value="Prev">
                </fieldset>
                <fieldset id="third">
                    <h4>Third Step</h4>
                    <div class="inner">
                        <a href="#" class="avartar">
                            <img src="/vendor_panel/register/images/avartar.png" alt="">
                        </a>
                        <h6>Confirmation Method</h6>
                        <div class="form-holder">
                            <input type="number" id="confirmno"  class="form-control" placeholder="Confirmation Code">
                            <i class="zmdi zmdi-map small"></i>
                        </div>
                    </div>
                    <input type="button" id="verify" name="verify" onclick="verifyyy()"  value="Verify">
                    <input type="submit" id="register" name="register" value="Register">
                    <input type="button" name="firstprevious" onclick="fprev()" value="Prev">
                </fieldset>
            </form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
            document.getElementById('register').style.display = "none";
    $("#firstnext").click(function(){
  var phone_number = document.getElementById('phone_number').value;
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/vendor/register-phone-verify/",
            type: 'post',
            data:{phone_number:phone_number},
             success: function(result){
                document.getElementById('second').style.display = "none";
                document.getElementById('third').style.display = "block";
        }});
    });
});
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfNLqbUALiCx95Zk_8MNe26PBCnmY3uCs&libraries=places"></script>
    <script>
        function initialize() {
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);

function next(){
document.getElementById('first').style.display = "none";
document.getElementById('second').style.display = "block";
}
function prev(){
document.getElementById('second').style.display = "none";
document.getElementById('first').style.display = "block";
}
function last(){
document.getElementById('second').style.display = "none";
document.getElementById('second').style.display = "none";
document.getElementById('third').style.display = "block";
}
function fprev(){
document.getElementById('third').style.display = "none";
document.getElementById('second').style.display = "block";
}
function verifyyy(){
    var phone_number = document.getElementById('phone_number').value;
    var confirmno = document.getElementById('confirmno').value;
    alert(phone_number);
    alert(confirmno);
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/vendor/register-phone-confirm/",
        type: 'post',
        data:{
            phone_number:phone_number,
            confirmno:confirmno
        },
         success: function(result){
            document.getElementById('verify').style.display = "none";
            document.getElementById('register').style.display = "block";
    }});
}
</script>

		<script src="/vendor_panel/register/js/jquery-3.3.1.min.js"></script>
		
		<!-- JQUERY STEP -->
		<script src="/vendor_panel/register/js/jquery.steps.js"></script>

		<!-- DATE-PICKER -->
		<script src="/vendor_panel/register/vendor/date-picker/js/datepicker.js"></script>
		<script src="/vendor_panel/register/vendor/date-picker/js/datepicker.en.js"></script>

		<script src="/vendor_panel/register/js/main.js"></script>

<!-- Template created and distributed by Colorlib -->
</body>
</html>