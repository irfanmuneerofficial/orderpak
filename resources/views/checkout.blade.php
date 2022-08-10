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
      <div class="container ">
        <form id="regForm1" method="post" action="">
          @csrf
          <div class="tab">
            <h3 class="bill-title mb-3">Billing Address</h3>
            <div class="billing-section">
              <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                  <div class="billing-form">
                      <div class="form-group">
                        <p>Name</p>
                        <input type="text" name="name" class="form-control input" placeholder="Enter Name" required>
                      </div>
                      <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                            <p>Email address</p>
                            <input type="email" name="email" class="form-control input" id="exampleInputEmail1" aria-describedby="emailHelp" @if(Auth()->check()) readonly @endif value="@if (Auth()->check()) {{Auth::user()->email}} @endif" placeholder="Enter email" required>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                            <p>Your Phone</p>
                            <input class="form-control input" type="number" id="phone" name="phone" autocomplete="off" placeholder="Your Phone" pattern="/^-?\d+\.?\d*$/" onkeypress="if(this.value.length==11) return false;" required>
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
                    <?php $sum_tot_Price2 = 0 ?>
                    <?php $t = 0 ?>
                    @foreach($data as $key => $row)
                    @foreach($products as $product)
                    @if($product->id == $row->product_id)
                    @if($row->status=='')
                    <?php $t = 1 ?>
                    <?php 
                    $is_attr='false';
                    if(sizeof($product->productAttribute)!=0)
                    {
                      $is_attr ='true';
                      // dump('im in product attribute');
                      $attr_product_image = $product->productAttribute->where('id',$row->product_attr_id)->first();
                      $product_image = $attr_product_image->attr_image;
                      $systematic_sku = $attr_product_image->attr_systematic_sku;
                      if($attr_product_image->attr_sale_start !='' && $attr_product_image->attr_sale_end !='')
                      {
                          $date1 = \Carbon\Carbon::now();
                          $startDate = \Carbon\Carbon::parse($attr_product_image->attr_sale_start.' 00:00:01');
                          $sdate = $date1->gte($startDate);
                  
                          $date2 = \Carbon\Carbon::now();
                          $endDate = \Carbon\Carbon::parse($attr_product_image->attr_sale_end.' 23:59:58');
                          $edate = $date2->lte($endDate);
                          if(($sdate == true)&&($edate == true))
                          {
                             $sale ='true';
                             $sale_price =$attr_product_image->attr_sale_price;
                             $product_price =$attr_product_image->attr_sale_price;
                          }
                          else{
                              $sale ='false';
                              $sale_price =0;
    
                          }
                        }else{
                          $sale ='false';
                          $sale_price =0;
                      }
    
                      if($sale == 'false')
                      {
                        $product_price =$attr_product_image->price;
                        // dump('Product Price: '.$product_price);
                      }
                      // dump('Im in the attribute');

                    }
                    else{
                      // dump('its simple product');
                        $product_price =$product->price;
                        $product_image =$product->image_1;
                        $systematic_sku = $product->systematic_sku;
                        $sale_price =$product->sale_price;
                    }
                    ?>                    
                    @if($product->sale_price > 0 )
                    <?php $sum_tot_Price += $sale_price * $row->quantity; ?>
                    @else
                      <?php 
                          if (($row->size=='undefined')|| ($row->size== null))
                          {
                            // var_dump('PP1 '.$product_price);
                            $sum_tot_Price += $product_price * $row->quantity; 
                          }
                          else{
                            // var_dump('PP2 '.$row->product_price);
                            if($row->product_sale_price!=0 && $sale =='true')
                            {
                                $sum_tot_Price += $row->product_sale_price * $row->quantity; 
                            }
                            else{
                              $sum_tot_Price += $row->product_price * $row->quantity; 
                            }
                            
                          }
                          
                      ?>
                    @endif
                    <article class="product">
                      <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 text-center">
                          <a href="/remove/{{$row->id}}"><span class="remove" ><i class="fa fa-times"></i></span></a>
                          <img src="/uploads/product_images/{{$product_image}}" class="cart___removal" alt="">
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                          <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 cart-info">
                              <a href="#">
                                <h6>{{\Illuminate\Support\Str::limit($product->title, 15, '...')}}</h6>
                                @if ($row->size!='' && $row->size!='undefined') 
                                [ <b>{{$row->size}}</b> ]
                                @endif
                                @if($row->color!='' && $row->color!='undefined')
                                [ <b> {{$row->color}} </b> ]
                                <!-- <a href="javascript:void(0)" id="selectcolor" class="aa-color-{{$row->color}} product_color"></a>                       -->
                                @endif
                                </p>
                                <input hidden="" name="size" value="{{$row->size}}">
                                <input hidden="" name="color" value="{{$row->color}}">
                                <input hidden="" name="cart_id[]" value="{{$row->id}}">
                                <input hidden="" name="user_id" value="{{$row->user_id}}">
                                <input hidden="" name="product_id" value="{{$row->product_id}}">
                                <input hidden="" name="vendor_id[]" value="{{$row->vendor_id}}">
                                <input hidden="" name="status" value="Pending">
                                <input name="shipping" hidden value="{{$ship_price}}" >

                              </a>
                              @if($systematic_sku)
                                <p style="text-transform: uppercase;">SKU : {{$systematic_sku}}</p>
                              @else
                                <p style="text-transform: uppercase;">SKU : {{$product->vendor_id}}-{{$product->category_id}}-{{$product->product_sku}}</p>
                              @endif
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                              <div class="content">
                                @if($sale_price > 0)
                                <p>PKR: <span class="full-price">{{number_format($sale_price)}}</span></p>
                                <p style="display: none;">PKR: <span class="price">{{number_format($sale_price)}}</span></p> 
                                  <span >QTY</span>
                                  <span>{{$row->quantity}}</span>
                                @else
                                <p>PKR: <span class="full-price">
                                  @if(($row->color =='undefined') && ($row->size =='undefined'))
                                  {{$product->price}}
                                  @else
                                  {{$row->product_price}}
                                  @endif
                                  </span></p>
                                <p style="display: none;">PKR:<span class="price">{{number_format($sale_price)}}</span></p> 
                                  <span >QTY</span>
                                  <span>{{$row->quantity}}</span>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </article>
                    @endif
                    @endif
                      @endforeach
                      @endforeach

                    <div class="cart-bottom">
                      <!--<div class="cart-input">-->
                      <!--  <input type="text" class="form-control" placeholder="Enter Gift Card or promo code">-->
                      <!--</div>-->
                      <hr>
                      <div class="row mt-4">
                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7">
                          <div class="cart-subtotal">
                            <h6>Subtotal</h6>
                          </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 text-lg-right">
                          <div class="cart-subtotal">
                            <p class="subtotal">PKR :  <span>
                                {{ number_format($sum_tot_Price)}}
                                </span></p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7">
                          <div class="cart-subtotal">
                            <h6>Shipping</h6>
                          </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 text-lg-right">
                          <div class="cart-subtotal">
                            <p class="shipping">PKR :  <span>{{($sum_tot_Price == '0') ? '0' : number_format($ship_price)}}</span>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7">
                          <div class="cart-total">
                            <h6>Total :</h6>
                          </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 text-lg-right">
                          <div class="cart-total">
                            <input class="amount" hidden="" name="amount" value="{{$sum_tot_Price+$ship_price}}">
                              </span>

                            <p class="total">PKR : <span>
                              {{($sum_tot_Price == '0') ? '0' : number_format($sum_tot_Price+$ship_price)}}

                          </span></p>
                        
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="order-help">
                    <div class="order">
                      <p>Need Help with your order?</p>
                      <p><strong>Hotline : </strong><a href="tel:  021 372 900 73">  021 372 900 73 </a></p>
                    </div>
                    <div class="continue-button">
                      <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6">
                         <a href="/shop"> <button type="button" class="btn btn-light">Continue Shopping</button></a>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6"> 
                        @if($t =='1')
                          <button type="button" class="btn btn-light" id="nextBtn1" onclick="nextPrev(1)">Next</button>
                        @else
                         <div class="alert alert-danger">
                           Cart Is empty
                         </div>
                         @endif
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
                          {{-- <h4>Enter Your Phone Number</h4>
                          <div class="form-group">
                            <input class="form-control input" id="cash_delivery_no" name="cash_delivery_no" type="number" autocomplete="off" required="" onchange="checkPhone(this.value)" placeholder="034567890" pattern="/^-?\d+\.?\d*$/" onkeypress="if(this.value.length==11) return false;">
                          </div> --}}
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
                  {{-- <div class="select-product">
                    <p>Order Summary</p>
                  </div> --}}
                  <hr>
                  <div class="row mt-4">
                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                      <div class="cart-total">
                        <h6>Total :</h6>
                      </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 text-right">
                      <div class="cart-total">
                        <p class="sum-price">PKR : <span>{{($sum_tot_Price == '0') ? '0' : number_format($sum_tot_Price+$ship_price)}}</span></p>
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
            {{-- <span class="step"></span> --}}
          </div>
        </form>
      </div>
    </div>
    <!-- START BACK TO TOP SECTION  -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
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
//   alert(price);
  // var tax = Math.round(price * 0.05 * 100) / 100
  var shipping = parseFloat($(".shipping span").html());
  
  
  var fullPrice = Math.round((price + shipping) *100) / 100;
//   alert(fullPrice);
  if(price == 0) {
  fullPrice = 0;
  }
  
//   alert(fullprice);
  $(".subtotal span").html(price);
  // $(".tax span").html(tax);
  $(".total span").html(fullPrice);
  $(".amount").val(fullPrice);
  $(".sum-price span").html(fullPrice);
  }
  
  $(document).ready(function(){
  
  $(".remove").click(function(){
      location.reload();
    //   alert('ads');
//   var el = $(this);
//   el.parent().parent().addClass("removed");
//   window.setTimeout(
//   function(){
//      el.parent().parent().slideUp('fast', function() { 
//       el.parent().parent().remove(); 
//       if($(".product").length == 0) {
//          if(check) {
//           $("#cart").html("<h1>The shop does not function, yet!</h1><p>If you liked my shopping cart, please take a second and heart this Pen on <a href='https://codepen.io/ziga-miklic/pen/xhpob'>CodePen</a>. Thank you!</p>");
//          } else {
//           $("#cart").html("<h1>No products!</h1>");
//          }
//       }
//       changeTotal(); 
//      });
//   }, 200);
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
<style>
  .aa-color-tag {
  display: block;
  width: 100%;
  margin-top: 10px;
}
.aa-color-tag a {
  display: inline-block;
  height: 15px;
  width: 20px;
}
.aa-color-red {
  background-color: #FF0000;
  }

  .aa-color-blue{
  background-color: #0000FF;
  } 

  .aa-color-green{
  background-color: #008000;
  } 

  .aa-color-pink{
  background-color: #ffc0cb;
  } 

  .aa-color-purple{
  background-color: #800080;
  } 

  .aa-color-yellow{
  background-color: #ffff00;
  } 

  .aa-color-black{
  background-color: #000000;
  } 

  .aa-color-grey{
  background-color: #808080;
  } 

  .aa-color-orange{
  background-color: #ffa500;
  } 

  .aa-color-brown{
  background-color: #a52a2a;
  } 

  .aa-color-gold{
  background-color: #ffd700;
  } 

  .aa-color-peach{
  background-color: #FFE5B4;
  } 

  .aa-color-silver{
  background-color: #C0C0C0;
  } 
  .aa-color-darkblue{
  background-color: #00008b;
  } 

  .aa-color-lightblue{
  background-color: #add8e6;
  } 

  .aa-color-darkgreen{
  background-color: #006400;
  } 

  .aa-color-lightgreen{
  background-color: #90ee90;
  } 

  .aa-color-goldblack{
  background-color: #333300;
  } 

  .aa-color-blackwhite{
  background-color: #E7E6DD;
  } 

  .aa-color-charcoal{
  background-color: #36454F;
  } 

  .aa-color-whitegold{
  background-color: #bba58e;
  } 

  .aa-color-rosegold{
  background-color: #b76e79;
  } 

  .aa-color-whiterosegold{
  background-color: #B76E79;
  } 

  .aa-color-magenta{
  background-color: #FF00FF;
  } 

  .aa-color-maroon{
  background-color: #800000;
  } 

  .aa-color-titaniumgrey{
  background-color: #565f6b;
  } 

  .aa-color-skin{
  background-color: #E8BEAC;
  } 

  .aa-color-mattbrown{
  background-color: #964b00;
  } 

  .aa-color-seagreen{
  background-color: #2E8B57;
  } 

  .aa-color-multi{
  background-color: #233067;
  } 

  .aa-color-darkgrey{
  background-color: #A9A9A9;
  } 

  .aa-color-lightbrown{
  background-color: #C4A484;
  } 

  .aa-color-goldsilver{
  background-color: #d0c792;
  } 

  .aa-color-blacksilver{
  background-color: #71706E;
  } 

  .aa-color-sterlinggrey{
  background-color: #b5b5ab;
  } 

  .aa-color-skygray{
  background-color: #a5b7bd;
  } 

  .aa-color-copper{
  background-color: #B87333;
  } 

  .aa-color-blackcopper{
  background-color: #5d2d24;
  } 

  .aa-color-offwhite{
  background-color: #FAF9F6;
  } 

  .aa-color-cream{
  background-color: #FFFDD0;
  } 

  .aa-color-darkbrown{
  background-color: #654321;
  } 

  .aa-color-lightgrey{
  background-color: #D3D3D3;
  } 

  .aa-color-coral{
  background-color: #FF7F50;
  } 

  .aa-color-marginda{
  background-color: #A7366A;
  }

  .aa-color-white {
  background-color: #FFF;
  border: 1px solid #ccc;
  }
 
  .aa-color-cyan {
  background-color: #00ffff;
  }

  .aa-color-olive {
  background-color: #00ffff;
  }

  .aa-color-orchid {
  background-color: #da70d6;
  }
</style>

@endsection