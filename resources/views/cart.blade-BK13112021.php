@extends('layouts.master')
@section('page-title')
Cart
@endsection
@section('mainContent')
<!-- END HEADER -->
<section id="CONTAINERIDHERE" class="mt-5">
  <div class="container">
      <div class="row">
          
        <div class="col-lg-8 col-md-8 col-sm-12">
          <div  class="upsell-box">
            <h3>Shopping Cart</h3>
            <div id="cover"></div>
  <style>
      #cover {
    background: url("/frontend/Spinner-1s-200px.gif") no-repeat scroll center center;
    position: absolute;
    height: 100%;
    width: 100%;
    z-index: 10;
}
  </style>
            @if(!empty(json_decode($data)))

            <?php $price=0 ?>
            @foreach($data as $row)
              <?php 
                $dataa = new App\Models\Product;
                $price = $dataa::where('id',$row->product_id)->sum('price');
              ?> 
              @foreach($products as $product)
              @if($product->id == $row->product_id)
              @if($row->status=='')
            <div class="upsell-cart">
              <div class="product-removal">
                <button type="button" onClick="reply_click(this.id)" id="{{$row->id}}" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="row"> 
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <div class="upsell-cart-image">
                  <img src="https://orderpak.com/uploads/product_images/{{$product->image_1}}">
                </div>
              <p style="display: none;" id="pquantity{{$row->id}}">{{$product->quantity}}</p>
                </div>
              


                <div  class="col-lg-8 col-md-8 col-sm-12 pl-0">
                  <div class="upsell-cart-info">
                    <h5>{{\Illuminate\Support\Str::limit(  $product->title, 32, '...')}}</h5>
                  <div class="product">
                    <span class="proprice_{{$row->id}}" id="@if($product->sale_price > 0){{ $product->sale_price}}@else {{$product->price}} @endif"></span>
                    @if($product->sale_price > 0)
                      <span>PKR:</span> <span id="sale_price_{{$row->id}}" class="product-line-price">{{$product->sale_price}}</span>
                    <div class="product-price">{{number_format($product->sale_price)}}</div>
                    @else
                      <span>PKR:</span> <span id="price_{{$row->id}}" class="product-line-price">{{$product->price}}</span>
                    <div class="product-price">{{number_format($product->price)}}</div>
                    @endif
                    @if($row->size != 'undefined')
                     | Size: <b>{{$row->size}}</b>
                    @endif

                    @if($row->color != 'undefined')
                     | Color: <b>{{$row->color}}</b>
                    @endif

                    @if($row->quantity)
                     <b class="cartquantity" id="quantity_{{$row->id}}" style="display:none"><?php echo $row->quantity ?></b>
                    @endif
                     | Total PKR: <b id="totalprice_{{$row->id}}">@if($product->sale_price > 0){{ number_format($product->sale_price * $row->quantity)}}@else {{number_format($product->price * $row->quantity) }} @endif</b>
                    <div class="product-quantity">
                      <span class="minus">-</span>
                         <input class="number" disabled id="{{$row->id}}" type="number" max="{{$product->quantity}}" value="{{$row->quantity}}" min="1">
                        <span class="plus">+</span>
                      <span class="alert-danger" id="message{{$row->id}}"></span>
                      </div>
                  </div>
                </div>
                </div>
              </div>
          </div>
          @endif
          @endif
          @endforeach
          @endforeach
          {{--<p class="upsell-pera">Total selected Product: <span id="productcount">{{count($data)}}</span></p>--}}
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
         <div class="cart-total-box">
           <h4>Cart Total</h4>
           <!--<hr>-->
           <div class="totals">
          <hr>
          <div class="totals-item totals-item-total">
            <div class="row">
              <div class="col-xl-8 col-lg-6 col-md-6 col-sm-8">
            <h5>Total:</h5>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6 col-sm-4">
            <div class="totals-value" id="cart-total">PKR: <span id="totalprice"><?php echo number_format($price) ?></span></div>
              </div>
            </div>
          </div>
          <hr>
        </div>
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 total-padding">
              <a href="/shop"><button type="button" class="btn btn-light total-btn">Continue Shopping</button></a>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 total-padding">
              <a href="/checkout"><button type="button" class="btn btn-light total-btn">Checkout</button></a>
            </div>
          </div>
         </div>
         @else
         <div class="alert alert-danger">
           Cart Is empty
         </div>
         @endif
        </div>
      </div>
  </div>
  
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
      $('#cover').hide();
// if(performance.navigation.type == 2){
//   location.reload(true);
// }
  $('.minus').click(function () {
      $('#cover').show();
    var $input = $(this).parent().find('input');
    var $inputid = $(this).parent().find('input').attr('id');
    var $pquantity = $('#pquantity'+$inputid).html();
    var $tp = $('.proprice_'+$inputid).attr('id');

    // alert($tp);
    // if($input.val() =='1' ){
    //   $(this).val("+").css('color','#aaa');
    //   $(this).val("+").css('cursor','not-allowed');
    //   $('#message'+$inputid).html('Stock Limit ' + $pquantity)
    // }
    // else
    // {
    var currentVal = $($input).val();
    // alert(currentVal);
    if (currentVal =='1' ) {
        $('#cover').hide();
        // Increment
        $(this).val("-").css('color','#aaa');
        $(this).val("-").css('cursor','not-allowed');
      $('#message'+$inputid).html('Stock Limit ' + $pquantity)

    } else {
      $('#message'+$inputid).html('');
        $.get('/mincart_quantity/'+$inputid, 
        function( data ) 
        {
          var sale_price = $('#sale_price_'+$inputid).html();
          var price = $('#price_'+$inputid).html();
          if(sale_price > 0 ){
            $('#totalprice').html(Number($('#totalprice').html()) - Number(sale_price));
          }
          else{
            $('#totalprice').html(Number($('#totalprice').html()) - Number(price));
          }
        //   $('#quantity_'+ $inputid).html(data.data);
        $("body").load('/cart' , function() {
    		// Animate loader off screen
    		$('#cover').fadeOut(100);
    	});
        // $($input).val(Number(currentVal) + Number(1));
          $input.change();
        return false;
        }
      );
          $input.val(parseInt($input.val()) - 1);
          var updatequantity = Number($input.val()) * $tp;
          $('#totalprice_'+$inputid).html(updatequantity);
    }
  });
  $('.plus').click(function () {
      $('#cover').show();
    var $input = $(this).parent().find('input');
    var $inputid = $(this).parent().find('input').attr('id');
    var $pquantity = $('#pquantity'+$inputid).html();
    var $tp = $('.proprice_'+$inputid).attr('id');


    var currentVal = $($input).val();
    if (!isNaN(currentVal) && $pquantity  == currentVal ) {
        $('#cover').hide();
        // Increment
        $(this).val("+").css('color','#aaa');
        $(this).val("+").css('cursor','not-allowed');
      $('#message'+$inputid).html('Stock Limit ' + $pquantity)

    } else {
      $('#message'+$inputid).html('');
        $.get('/addcart_quantity/'+$inputid, 
        function( data ) 
        {
          var sale_price = $('#sale_price_'+$inputid).html();
          var price = $('#price_'+$inputid).html();
          if(sale_price > 0 ){
            $('#totalprice').html(Number($('#totalprice').html()) + Number(sale_price));
          }
          else{
            $('#totalprice').html(Number($('#totalprice').html()) + Number(price));
          }
        //   $('#quantity_'+ $inputid).html(data.data);
        $("body").load('/cart' , function() {
    		// Animate loader off screen
    		$('#cover').fadeOut(100);
    	});
        // $($input).val(Number(currentVal) + Number(1));
          $input.change();
        return false;
        }
      );
          $input.val(parseInt($input.val()) + 1);
          var updatequantity = Number($input.val()) * $tp; 
          $('#totalprice_'+$inputid).html(updatequantity);
          // alert(updatequantity);
    }
  });
});
</script>
@endsection