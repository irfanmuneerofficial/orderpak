@extends('layouts.master')
@section('page-title')
Search
@endsection
@section('mainContent')
<section>
</section>
&nbsp;
<section class="product-info-sec">
  <div class="container max-con">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb custom-breadcrumb justify-content-center">
        <li class="breadcrumb-item breadcrumb-item1">
          <a href="{{ url('/') }}">Home</a>
        </li>
        <li class="breadcrumb-item breadcrumb-item1 active" aria-current="page">
          Search
        </li>
      </ol>
    </nav>
    <div class="row">
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
        <div class="shopdetail-sidenav">
          <div class="filter-color">
            <h4>Categories</h4>
            <hr class="green-border">
            <hr class="blue-border">
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
      <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
        &nbsp;
        <div class="order-border">
          <div class="pull-right">
            <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="btn-group pull-grid">
                  <button class="btn btn-info list-group-two grid-display" id="grid">
                    <i class="fas fa-border-all"></i>
                  </button>
                  <button class="btn btn-danger list-group-one grid-display" id="list">
                    <i class="fas fa-stream"></i>
                  </button>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

              </div>
            </div>
          </div>

          <div id="products" class="row view-group detail-tops">
            @if($products)
            <?php
            $vendor = new App\Models\Vendor;
            $vendors = $vendor::where('status', 'ACTIVE')->get();
            ?>
            @foreach($products as $product)
            @foreach($vendors as $vendor)
            @if($vendor->id == $product->vendor_id && $product->admin_status == 'APPROVED' && $product->vendor_status == 'ACTIVE')
            <a href="/product/{{$product->slug}}" style="text-decoration: none; color:#2C5779;">
              <div class="item col-xl-4 col-lg-4 col-md-4 col-sm-4 respon-card">
                <div class="thumbnail card product-grid7">
                  <div class="button-product">
                    <div class="img-event product-image7">
                      @if($product->image_1)
                      <img class="pic-1 group list-group-image img-fluid" src="https://orderpak.com/uploads/product_images/{{$product->image_1}}" alt="{{$product->title}}" />
                      @else
                      <img src="https://orderpak.com/uploads/no_image.png">
                      @endif
                    </div>
                    <div class="caption card-body body-card">
                      <p class="listed">listed by: {{\Illuminate\Support\Str::limit($vendor->business_name, 40, '...')}}</p>
                      <h5>({{$product->categoryname->title}})</h5>
                      <hr>
                      <h6>{{$product->parentcategory->title}}</h6>
                      <h4 class="group card-title inner list-group-item-heading">
                        {{\Illuminate\Support\Str::limit( $product->title, 16, '...')}}
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
                      <p class="HEADPHONES">{{\Illuminate\Support\Str::limit( $product->short_description, 130, '...')}}</p>
                    </div>
                    <div class="product-btn">
                      <a class="" href="/product/{{$product->slug}}"><button type="button" class="btn btn-info">View More</button></a>
                    </div>
                    <div class="listed-btn">
                      <a class="" href="/product/{{$product->slug}}"><button type="button" class="btn btn-info">View More</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            @endif
            @endforeach
            @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection