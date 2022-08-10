@extends('layouts.master')
@section('page-title')
{{$vendor->business_name}}
@endsection
@section('description')
Shop online with ({{$vendor->business_name}}) now! Visit ({{$vendor->business_name}}) on Orderpak.
@endsection
@section('mainContent')
    <section>
      <div class="banner">
        <img src="/frontend/assets/img/banner-01.jpg">
      </div>
      <div class="container p-0">
        <div class="card-box">
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
              <div class="order-seller">
                <div class="seller-border">
                  @if($shop)
                    <img src="http://orderpak.com/uploads/vendor/shop/{{$shop->shop_img}}" alt="{{$shop->shop_name}}">
                  @else
                    <img src="http://orderpak.com/uploads/no_image.png">
                  @endif
                </div>
                <p>Feedback ratings</p>
                <div class="rating-seller">
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                  <span class="seller-reviews">(0)</span>
                </div>
              </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
              <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                  <div class="seller-info">
                    <h2>{{$vendor->business_name}}</h2>
                    <p>4750 Followers</p>
                    <h5>Seller Ratings</h5>
                    <hr>
                    <div class="row">
                      <div class="col-6">
                        <h6>Positive</h6>
                        <div class="positive-box">
                          <P>0%</P>
                        </div>
                      </div>
                      <div class="col-6">
                        <h6 class="negative">Negative</h6>
                        <div class="negative-box">
                          <P>0%</P>
                        </div>
                      </div>
                    </div>
                    <a href="#">Click to See All Feedback</a>
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="follow-order">
                          <span><img src="/frontend/assets/img/follow.png"><button id="follow-button">Follow +</button></span>
                          <span></span>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="btn-group report-seller">
                          <button class="btn btn-light btn-sm dropdown-toggle seller-btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Report seller?
                          </button>
                          <div class="dropdown-menu report-menu">
                            <form>
                              <div class="form-group">
                                <label for="exampleInputName">Your Name</label>
                                <input type="name" class="form-control" id="exampleInputName" aria-describedby="nameHelp" placeholder="Your Name">
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="exampleInputTel">Your Phone</label>
                                    <input type="phone" class="form-control" id="exampleInputTel" aria-describedby="phoneHelp" placeholder="03123456789">
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputId">Your Order #tracking ID</label>
                                <input type="Id" class="form-control" id="exampleInputId" aria-describedby="IdHelp" placeholder="1234567890">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Your Message</label>
                                <textarea id="w3review" name="w3review" rows="4" cols="50"></textarea>
                              </div>
                              <button type="submit" class="btn btn-primary seller-submit-btn">Submit</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-8 record-hide">
                  <div class="verifird-box">
                    <span class="verified"><i class="fas fa-check"></i>Verified seller</span>
                    @if($shop)
                      <p>Member Since <?php $newtime = strtotime($shop->created_at); ?>
                      {{date('Y M d', $newtime)}}</p>
                    @endif
                  </div>
                  <div class="order-box">
                    <div class="row">
                      <div class="col-lg-4 col-md-4 p-0">
                        <h6>Total Sales</h6>
                        <div class="positive-box1">
                          <p>
                          <?php $count = 0; ?> 
                          @if($booked)
                            @foreach($booked as $order)
                            @if($order->status == 'Complete')
                            <?php $count++; ?>
                            @endif
                            @endforeach
                          @endif
                          <?php echo $count++; ?>
                        </p>
                        </div>
                      </div>
                      <!--<div class="col-lg-3 col-md-3 pl-0 pr-0">-->
                      <!--  <h6 class="negative">Returns</h6>-->
                      <!--  <div class="negative-box2">-->
                      <!--    <p>-->
                      <!--    <?php $count = 0; ?> -->
                      <!--    @if($booked)-->
                      <!--      @foreach($booked as $order)-->
                      <!--      @if($order->status == 'Return')-->
                      <!--      <?php $count++; ?>-->
                      <!--    @endif-->
                      <!--    @endforeach-->
                      <!--    @endif-->
                      <!--    <?php echo $count++; ?>-->
                      <!--  </p>-->
                      <!--  </div>-->
                      <!--</div>-->
                      <div class="col-lg-4 col-md-4 p-0">
                        <h6 class="total">Total Products listed</h6>
                        <div class="total-box">
                          <p>{{$listedcount}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="live-chat">
                    <button type="button" class="btn btn-light">Get Live Chat Support</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    &nbsp;
    <section>
      <div class="container max-con">
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
        <div class="shopdetail-sidenav">
        <div class="filter-color">
          <h4>Categories</h4>
          <hr class="green-border">
          <hr class="blue-border">
        </div>
        <div class="widget-title">
          <h4>Explore</h4>
        </div>
        <div class="widget-content">
          <ul id="accordion">
            @foreach($categories as $category)
            <li>
              <h4>{{$category->title}} 
                @foreach($pcategories as $prow)
              @if($prow->main_id == $category->id)
                  <span class="plusminus">+</span>
                @endif
                @endforeach
              </h4>
              <ul>
                @foreach($pcategories as $prow)
              @if($prow->main_id == $category->id)
                  <li><a href="/category/{{$category->slug}}/{{ $prow->slug }}">{{ $prow->title }}</a></li>
                @endif
                @endforeach
              </ul>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
          <div class="col-lg-9 col-md-12 col-sm-12">
            <div class="order-border">
              <div class="pull-right">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="btn-group pull-grid">
                      <button class="btn btn-info list-group-two" id="grid">
                      <i class="fas fa-border-all"></i>
                      </button>
                      <button class="btn btn-danger list-group-one" id="list">
                      <i class="fas fa-stream"></i>
                      </button>
                      {{-- <span>Showing 1-9 of 18 results</span> --}}
                    </div>
                  </div>
                </div>
              </div>
              <div id="products" class="row view-group">
                @foreach($products as $product)
                <a href="/product/{{$product->slug}}" style="text-decoration: none; color:#2C5779;">
                <div class="item col-xl-4 col-lg-4 col-md-4 col-sm-4 respon-card">
                  <div class="thumbnail card product-grid7">
                    <div class="button-product">
                    <div class="img-event product-image7">
                      <img class="pic-1 group list-group-image img-fluid" src="http://orderpak.com/uploads/product_images/{{$product->image_1}}" alt="{{$product->title}}" />
                    </div>
                    <div class="caption card-body body-card">
                      <p class="listed">listed by: {{$vendor->business_name}}</p>
                      <h5>({{$product->categoryname->title}})</h5>
                      <hr>
                      <h6>{{$product->parentcategory->title}}</h6>
                      <h4 class="group card-title inner list-group-item-heading">
                        {{\Illuminate\Support\Str::limit(  $product->title, 16, '...')}}
                      </h4>
                      <p class="lead lead1">
                        @if($product->price)
                        @if($product->sale_price > 0)
                        PKR {{number_format($product->sale_price)}}
                        <span class="pkr-color">PKR</span> <del class="minus-price">{{number_format($product->price)}}</del> 
                        @else
                          PKR {{number_format($product->price)}}
                        @endif
                        @endif
                      </p>
                      <div class="lead lead2">
                        @if($product->price)
                        @if($product->sale_price > 0)  
                      <p class="mb-0">PKR {{number_format($product->sale_price)}}</p>
                      <p><span class="pkr-color">PKR</span> <del class="minus-price">{{number_format($product->price)}}</del> </p>
                      @else
                          PKR {{number_format($product->price)}}
                        @endif
                        @endif
                      </div>
                      <p class="HEADPHONES">{{\Illuminate\Support\Str::limit(  $product->short_description, 130, '...')}}</p>
                    </div>
                    <div class="product-btn">
                      <a class="" href="/product/{{$product->slug}}"><button type="button" class="btn btn-info">View More</button></a></div>
                      <div class="listed-btn">
                      <a class="" href="/product/{{$product->slug}}"><button type="button" class="btn btn-info">View More</button></a></div>
                    </div>
                  </div>
                </div>
                </a>
                @endforeach
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection