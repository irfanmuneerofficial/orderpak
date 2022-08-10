@extends('layouts.master')
@section('page-title')
Product Inside
@endsection
@section('mainContent')
<!-- END HEADER -->
<section class="mt-5">
  <div class="container">
    <!--<div class="order-pagination">-->
    <!--  <ul>-->
    <!--      <li><a href="/">Home ></a></li>-->
    <!--      <li><a href="/shopdetail.html">shop</a></li>-->
    <!--  </ul>-->
    <!--  </div>-->
      <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12">
          <div  class="upsell-box">
            <h3>SHopping CART</h3>
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
                  <img src="/uploads/product_images/{{$product->image_1}}">
                </div>
                </div>
                <div  class="col-lg-8 col-md-8 col-sm-12 pl-0">
                  <div class="upsell-cart-info">
                    <h5>{{\Illuminate\Support\Str::limit(  $product->title, 32, '...')}}</h5>
                  <div class="product">
                    @if($product->sale_price > 0)
                      PKR:<div class="product-line-price">{{$product->sale_price}}</div>
                    <div class="product-price">{{$product->sale_price}}</div>
                    @else
                      PKR:<div class="product-line-price">{{$product->price}}</div>
                    <div class="product-price">{{$product->price}}</div>
                    @endif
                    @if($row->size != 'undefined')
                      Size: <b>{{$row->size}}</b>
                    @endif

                    @if($row->color != 'undefined')
                      Color: <b>{{$row->color}}</b>
                    @endif

                    @if($row->quantity)
                      Quantity: <b class="cartquantity">{{$row->quantity}}</b>
                    @endif

                    {{-- <div class="product-quantity">
                      <span class="minus">-</span>
                         <input class="number" type="number" value="1" min="1">
                        <span class="plus">+</span>
                      </div> --}}
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
        <div class="col-lg-4 col-md-12 col-sm-12">
         <div class="cart-total-box">
           <h4>Cart Total</h4>
           <!--<hr>-->
           <div class="totals">
          <hr>
          <div class="totals-item totals-item-total">
            <div class="row">
              <div class="col-8">
            <h5>Total:</h5>
              </div>
              <div class="col-4">
            <div class="totals-value" id="cart-total">PKR: <span id="totalprice"><?php echo '200'+ $price ?></span></div>
              </div>
            </div>
          </div>
          <hr>
        </div>
          <a href="/checkout"><button type="button" class="btn btn-light total-btn">Continue</button></a>
         </div>
        </div>
      </div>
  </div>
</section>
@endsection