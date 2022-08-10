@extends('layouts.master')
@section('page-title')
Checkout
@endsection
@section('mainContent')
<style>
    .product{
      margin-bottom: 30px;
    }
    .full-price{
      color: #000;
      font-size: 16px;
      font-weight: 500;
      }
    .product.removed {
    margin-left: 980px !important;
    opacity: 0;
    }
    .remove {
    cursor: pointer;
    position: absolute;
    z-index: 1040;
    left: 390px;
    }
    .qt{
    color: #2c5779;
    font-size: 16px;
    font-weight: 600;
      
    }
    .qt-plus, .qt-minus {
    color: #2c5779;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    }
    .cart__image{
    text-align: center;
    }
    .cart___removal{
    width: 70px;
    }
    .content{
    text-align: center;
    }
  </style>
    <!-- MultiStep Form -->
    <div class="content-bg">
      <div class="container max-con">
        <form id="regForm1" method="post" action="">
          @csrf
          <div class="tab">
            <h3 class="bill-title mb-3">Billing Address</h3>
            <div class="billing-section">
              <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                  <div class="billing-form">
                      <div class="form-group">
                        <p>Name</p>
                        <input type="text" name="name" class="form-control input" placeholder="Enter Name" required>
                      </div>
                      <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                            <p>Email address</p>
                            <input type="email" name="email" class="form-control input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                            <p>Your Phone</p>
                            <input class="form-control input" id="phone" name="phone" type="number" autocomplete="off" required="" placeholder="034567890" pattern="/^-?\d+\.?\d*$/" onkeypress="if(this.value.length==11) return false;">
                          </div>
                          <span id="errorph" class="alert-danger"></span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                            <p>Zip Code</p>
                            <input type="tel" name="zipcode" class="form-control input" placeholder="Your Code" required>
                          </div>
                        </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                            <p>City</p>
                            <input type="text" name="city" class="form-control input" placeholder="Your City" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                            <p>Address</p>
                            <input type="text" name="address" class="form-control input" placeholder="Enter Your Address" required>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                            <p>State</p>
                            <select class="form-control" name="state">
                              <option value="sindh">Sindh</option>
                              <option value="punjab">Punjab</option>
                              <option value="balochistan">Balochistan</option>
                              <option value="khyber pakhtunkhwa">Khyber Pakhtunkhwa</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <p>Drop us a message</p>
                        <textarea class="form-control" name="message" rows="3"></textarea>
                      </div>
                  </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                  <div class="cart-summary-main" id="cart">
                    <div class="cart-main">
                      <div class="row mb-4">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                          <h5>Cart Summary</h5>
                        </div>
                      </div>
                    </div>
                    <?php $sum_tot_Price = 0 ?>
                    <?php $sum_tot_Price1 = 0 ?>
                    <?php 
                    // dd($attribute['color']);
                        if(sizeof($product->productAttribute)!=0)
                        {
                          // dump('Attribute im in guest checkout');
                          $product_price =$product->productAttribute[0]->price;
                          $systematic_sku = $product->productAttribute[0]->attr_systematic_sku;
                          // $product_sale_price = $product->productAttribute[0]->attr_sale_price;
                          if($product->productAttribute[0]->attr_sale_start !='' && $product->productAttribute[0]->attr_sale_end !='')
                          {
                              $date1 = \Carbon\Carbon::now();
                              $startDate = \Carbon\Carbon::parse($product->productAttribute[0]->attr_sale_start.' 00:00:01');
                              $sdate = $date1->gte($startDate);
                      
                              $date2 = \Carbon\Carbon::now();
                              $endDate = \Carbon\Carbon::parse($product->productAttribute[0]->attr_sale_end.' 23:59:58');
                              $edate = $date2->lte($endDate);
                              if(($sdate == true)&&($edate == true))
                              {
                                 $sale ='true';
                                 $product_sale_price =$product->productAttribute[0]->attr_sale_price;
                                //  $product_price =$product->productAttribute[0]->attr_sale_price;
                              }
                              else{
                                  $sale ='false';
                                  $product_sale_price =0;
        
                              }
                            }else{
                              $sale ='false';
                              $product_sale_price =0;
                          }
    
                          $product_image = $product->productAttribute[0]->attr_image;
                          $product_product_sku = $product->productAttribute[0]->product_sku;
                          if($sale == 'false')
                          {
                            $product_price =$product->productAttribute[0]->price;
                            // dump('Product Price: '.$product_price);
                          }

                        }
                        else{
                          // dump('im in guest checkout');
                          $product_price =$product->price;
                          $systematic_sku = $product->systematic_sku;
                          //checking product sale price for simple product
                          if($product->sale_status ==1)
                          {
                            $simple_sale_date = explode(" ",$product->sale_details);
                            $data['start_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $simple_sale_date[0])->format('Y-m-d');
                            $data['end_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $simple_sale_date[2])->format('Y-m-d');
                            $date11 = \Carbon\Carbon::now();
                            $startDate11 = \Carbon\Carbon::parse($data['start_date'].' 00:00:01');
                            $sdate11 = $date11->gte($startDate11);
                            $date22 = \Carbon\Carbon::now();
                            $endDate22 = \Carbon\Carbon::parse($data['end_date'].' 23:59:58');
                            $edate22 = $date22->lte($endDate22);
                            if(($sdate11 == true)&&($edate22 == true))
                            {
                              $sale22 ='true';
                              $product_sale_price = $product->sale_price;
                            }
                            else{
                                $sale22 ='false';
                                $product_sale_price = 0;
                            }
                          }                          
                          //checking product sale price for simple product

                          $product_image = $product->image_1;
                          $product_product_sku = $product->product_sku;

                        }
                    ?>                     
                    <article class="product">
                      <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 text-center">
                          <!-- <img src="/uploads/product_images/{{$product->image_1}}" class="cart___removal" alt=""> -->
                          <img src="/uploads/product_images/{{$product_image}}" class="cart___removal" alt="">
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                          <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 cart-info">
                              <a href="#">
                                <h6>{{$product->title}}</h6>
                                <p style="text-transform: uppercase;">
                                @if ($attribute['size']!='' && $attribute['size']!='undefined') 
                                [ <b>{{$attribute['size']}}</b> ]
                                @endif
                                @if($attribute['color']!='' && $attribute['color']!='undefined')
                                [ <b>{{$attribute['color']}}</b> ]
                                @endif
                                </p>                                
                                <input hidden="" name="product_id" value="{{$product->id}}">
                                <input hidden="" name="size" value="{{$_GET['size']}}">
                                <input hidden="" name="color" value="{{$_GET['color']}}">
                                <input hidden="" name="quantity" value="{{$_GET['quantity']}}">
                                @if(isset($_GET['aid']))
                                <input hidden="" name="aid" value="{{$_GET['aid']}}">
                                @endif
                                <input hidden="" name="cart_id[]" value="guest">
                                @if($product->slug)
                                <input hidden="" name="vendor_id" value="{{$product->vendor_id}}">
                                @else
                                <input hidden="" name="vendor_id" value="{{$_GET['vendor_id']}}">
                                @endif
                                <input hidden="" name="user_id" value="guest">
                                <input hidden="" name="status" value="Pending">
                              </a>
                              @if($systematic_sku)
                                <p style="text-transform: uppercase;">SKU : {{ $systematic_sku}}</p>
                              @else
                                <p style="text-transform: uppercase;">SKU : {{$product->vendor_id}}-{{$product->category_id}}-{{$product_product_sku}}</p>
                              @endif
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="content">
                                @if($product_sale_price > 0)
                                <p class="full-price">PKR: {{number_format($product_sale_price)}}</p>
                                <p class="price" style="display: none;">PKR: {{number_format($product_sale_price)}}</p> 
                                  <span >QTY</span>
                                  <span>{{$_GET['quantity']}}</span>
                                @else
                                <p class="full-price">PKR: {{number_format($product_price)}}</p>
                                <p class="price" style="display: none;">PKR: {{number_format($product_price)}}</p> 
                                  <span >QTY</span>
                                  <span>{{$_GET['quantity']}}</span>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </article>
                    <div class="cart-bottom">
                      <hr>
                      <div class="row mt-4">
                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                          <div class="cart-subtotal">
                            <h6>Subtotal</h6>
                          </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 text-lg-right">
                        <div class="cart-subtotal">
                            @if($product_sale_price > 0)
                            <p class="subtotal">PKR :  <span>
                            {{number_format($product_sale_price * $_GET['quantity'])}}
                            {{-- {{ $sum_tot_Price}} --}}
                            </span></p>
                            @else
                            <p class="subtotal">PKR :  <span>
                            {{number_format($product_price * $_GET['quantity'])}}
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                          <div class="cart-subtotal">
                            <h6>Shipping</h6>
                          </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 text-lg-right">
                          <div class="cart-subtotal">
                            <p class="shipping">PKR :
                              @if(empty($cshipping))
                                <span><?php $sum_tot_Price1 += $sum_tot_Price + $pshipping ?>{{$pshipping}}</span>
                              @else
                                <span><?php $sum_tot_Price1 += $sum_tot_Price + $cshipping ?>{{$cshipping}}</span>
                              @endif
                            </p>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                          <div class="cart-total">
                            <h6>Total :</h6>
                          </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 text-lg-right">
                          <div class="cart-total">
                            @if(empty($cshipping))
                              <input class="shipping" hidden="" name="shipping" value="{{$pshipping}}">
                            @else
                              <input class="shipping" hidden="" name="shipping" value="{{$cshipping}}">
                            @endif
                              </span>
                            @if(empty($cshipping))
                                @if($product_sale_price > 0)
                                <p class="total">PKR : <span>{{number_format($product_sale_price * $_GET['quantity'] + $pshipping )}}</span></p>
                                <input class="amount" hidden="" name="amount" value="{{$product_sale_price * $_GET['quantity'] + $pshipping}}">
                                @else
                                <p class="total">PKR : <span>{{number_format($product_price * $_GET['quantity'] + $pshipping )}}</span></p>
                                <input class="amount" hidden="" name="amount" value="{{$product_price * $_GET['quantity'] + $pshipping}}">
                                @endif
                            @else
                                @if($product_sale_price > 0)
                                <p class="total">PKR : <span>{{number_format($product_sale_price * $_GET['quantity'] + $cshipping )}}</span></p>
                                <input class="amount" hidden="" name="amount" value="{{$product_sale_price * $_GET['quantity'] + $cshipping}}">
                                @else
                                <p class="total">PKR : <span>{{number_format($product_price * $_GET['quantity'] + $cshipping )}}</span></p>
                                <input class="amount" hidden="" name="amount" value="{{$product_price * $_GET['quantity'] + $cshipping}}">
                                @endif
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="order-help">
                    <div class="order">
                      <p>Need Help with your order?</p>
                      <p><strong>Hotline : </strong><a href="tel: 021 372 900 73"> 021 372 900 73 </a></p>
                    </div>
                    <div class="continue-button">
                      <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6">
                          <a href="/shop">
                            <button type="button" id="" class="btn btn-light">Continue Shopping</button>
                          </a>
                          </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6"> 
                          <button type="button" class="btn btn-light" id="nextBtn1" onclick="nextPrev(1)">Next</button>
                        </div>
                      </div>
                      <div class="text-center">
                        <div id="popup_box">
                         <input type="button" id="cancel_button" value="X">
                         <p id="info_text">Dear User, If you want to do more shopping than register as a user, and enjoy!
                         </p>
                         <a type="button" class="btn btn-light" id="buynow_link" value="">Ok</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab">
            <div class="payment-method-section">
              <h3 class="bill-title">Select Payment Method</h3>
              <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                  <div class="payment-method">
                    <nav class="payment-method-navs">
                      <div class="nav nav-tabs custom-nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link custom-nav-link active" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><img src="/frontend/assets/img/cash.png" alt=""></a>
                      </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="custom-tab-content3">
                          <h3>Cash on Delivery</h3>
                          <p>You can pay in cash to our courier when you receive the goods at your doorstep.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                <div class="verified-section">
                  <div class="verified-info">
                    <p><img src="/frontend/assets/img/verified.png" width="23" height="23"> Total amount of your shopping</p>
                  </div>
                  <hr>
                  <div class="row mt-4">
                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                      <div class="cart-total">
                        <h6>Total :</h6>
                      </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 text-right">
                      <div class="cart-total">
                      @if(empty($cshipping))
                          @if($product->sale_price > 0)
                          <p class="sum-price">PKR : <span>{{number_format($product->sale_price * $_GET['quantity'] + $pshipping )}}</span></p>
                          @else
                          <p class="sum-price">PKR : <span>{{number_format($product_price * $_GET['quantity'] + $pshipping )}}</span></p>
                          @endif
                        @else
                          @if($product->sale_price > 0)
                          <p class="sum-price">PKR : <span>{{number_format($product->sale_price * $_GET['quantity'] + $cshipping )}}</span></p>
                          @else
                          <p class="sum-price">PKR : <span>{{number_format($product_price * $_GET['quantity'] + $cshipping )}}</span></p>
                          @endif
                        @endif
                      </div>
                    </div>
                    <div class="confirm-button">
                      <button type="button" class="btn btn-light" id="nextBtn1" onclick="nextPrev(1)">Confirm Order</button>
                    </div>
                  </div>
                </div>
                <div class="order-help1">
                  <div class="order">
                    <p>Need Help with your order?</p>
                    <p><strong>Hotline : </strong><a href="tel: 021 372 900 73"> 021 372 900 73 </a></p>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
          <div class="tab">
              <div class="container">
                <div class="row">
                  <div class="col-12">
                    <img class="done-img" src="/frontend/assets/img/thankyou.jpg">
                    <!--<h1 class="done-h1">Your order has been done!</h1>-->
                    <!--<p class="done-p">Dear Customer,-->
                    <!--  We have received your order and will get started on it right away. You will expect to receive a shipping confirmation email soon. Thank you for shopping from <a href="orderpak.com" style="color:#274E72;">Orderpak.com</a></p>-->
                  </div>
                </div>
              </div>
          </div>
          <div style="overflow:auto;">
            <div style="float:right;">
            </div>
          </div>
          <div style="text-align:center;margin-top:40px; display: none;">
            <span class="step"></span>
            <span class="step"></span>
          </div>
        </form>
      </div>
    </div>
    <!-- START BACK TO TOP SECTION  -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>

// POPUP START
$(document).ready(function(){
 $("#display_popup").click(function(){
  // showpopup();
 });
 $("#cancel_button").click(function(){
  hidepopup();
 });
 $("#close_button").click(function(){
  hidepopup();
 });
 $("#buynow_link").click(function(){
  hidepopup();
 });
});


function showpopup()
{
 $("#popup_box").fadeToggle();
 $("#popup_box").css({"visibility":"visible","display":"block"});
}

function hidepopup()
{
 $("#popup_box").fadeToggle();
 $("#popup_box").css({"visibility":"hidden","display":"none"});
}

// POPUP END



  var check = false;
  
  function changeVal(el) {
  var qt = parseFloat(el.parent().children(".qt").html());
  var price = parseFloat(el.parent().children(".price").html());
  var eq = Math.round(price * qt * 100) / 100;
  
  el.parent().children(".full-price").html( eq + "PKR" );
  
  changeTotal();      
  }
  
  function changeTotal() {
  
  var price = 0;
  
  $(".full-price").each(function(index){
  price += parseFloat($(".full-price").eq(index).html());
  });
  
  price = Math.round(price * 100) / 100;
  // var tax = Math.round(price * 0.05 * 100) / 100
  var shipping = parseFloat($(".shipping span").html());
  var fullPrice = Math.round((price + shipping) *100) / 100;
  
  if(price == 0) {
  fullPrice = 0;
  }
  
  $(".subtotal span").html(price);
  // $(".tax span").html(tax);
  $(".total span").html(fullPrice);
  $(".amount").val(fullPrice);
  $(".sum-price span").html(fullPrice);
  }
  
  $(document).ready(function(){
  
  $(".remove").click(function(){
  var el = $(this);
  el.parent().parent().addClass("removed");
  window.setTimeout(
   function(){
     el.parent().parent().slideUp('fast', function() { 
       el.parent().parent().remove(); 
       if($(".product").length == 0) {
         if(check) {
           $("#cart").html("<h1>The shop does not function, yet!</h1><p>If you liked my shopping cart, please take a second and heart this Pen on <a href='https://codepen.io/ziga-miklic/pen/xhpob'>CodePen</a>. Thank you!</p>");
         } else {
           $("#cart").html("<h1>No products!</h1>");
         }
       }
       changeTotal(); 
     });
   }, 200);
  });
  
 $(".qt-plus").click(function(){
      var abcd = $(this).attr('name') - 1;
    if ($(this).prev().val() < abcd) {
      $(this).prev().val(+$(this).prev().val() + 1);
  $(this).parent().children(".qt").html(parseInt($(this).parent().children(".qt").html()) + 1);
  
  $(this).parent().children(".full-price").addClass("added");
  
  var el = $(this);
  window.setTimeout(function(){el.parent().children(".full-price").removeClass("added"); changeVal(el);}, 150);
    }
  });
  
  $(".qt-minus").click(function(){
  
  child = $(this).parent().children(".qt");
  
  if(parseInt(child.html()) > 1) {
   child.html(parseInt(child.html()) - 1);
  }
  
  $(this).parent().children(".full-price").addClass("minused");
  
  var el = $(this);
  window.setTimeout(function(){el.parent().children(".full-price").removeClass("minused"); changeVal(el);}, 150);
  });
  
  window.setTimeout(function(){$(".is-open").removeClass("is-open")}, 1200);
  
  $(".remove").click(function(){
  check = true;
  // $(".remove").click();
  });
  });
  
  var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").style.display = "none";
    document.getElementById("heading").style.display = "none";
  } else {
    document.getElementById("nextBtn").innerHTML = "Continue";
  }
}

function nextPrev(n) {
 
  var x = document.getElementsByClassName("tab ");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByClassName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

function setCaretPosition(elem, caretPos) {
    if(elem != null) {
        if(elem.createTextRange) {
            var range = elem.createTextRange();
            range.move('character', caretPos);
            range.select();
        }
        else {
            if(elem.selectionStart) {
                elem.focus();
                elem.setSelectionRange(caretPos, caretPos);
            }
            else
                elem.focus();
        }
    }
}

</script>
@endsection