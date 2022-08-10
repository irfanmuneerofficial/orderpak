@extends('layouts.master')

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Online Shopping in Pakistan with Free Home Delivery" />
    <meta property="og:description"        content="OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!" />
    <meta property="og:image"              content="{{ asset('frontend/assets/img/logo_res.png') }}" />
@endsection

@section('page-title')
Shop
@endsection

@section('shop-inside')
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
      "name": "Shop"
    }
  }]
}
</script>
@endsection

@section('mainContent')

<section>
  <div id="carouselExampleIndicators" class="carousel slide order-camera carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators camera-bullets">
      @foreach($banners as $row)
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="@if($loop->first) active @endif"></li>
      <!--<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>-->
      <!--<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>-->
      @endforeach
    </ol>
    <div class="carousel-inner">
      @foreach($banners as $row)
      <div class="carousel-item @if($loop->first) active @endif">
        <a href="{{$row->link}}"><img src="https://orderpak.com/uploads/shop/{{$row->banner_img}}"></a>
      </div>
      @endforeach
    </div>
  </div>
</section>

&nbsp;
<section class="shop-info-main">
  <div class="container max-con">
    <nav aria-label="breadcrumb">
      <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb custom-breadcrumb justify-content-center">
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1">
          <a itemprop="item" href="{{ url('/') }}">
            <span itemprop="name">Home</span>
          </a>
          <meta itemprop="position" content="1" />
        </li>
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1 active" aria-current="page">
          <span itemprop="name">Shop</span>
          <meta itemprop="position" content="2" />
        </li>
      </ol>
    </nav>
    <div class="row">
      <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
        <div class="order-pagination">
        </div>
        <div class="shopdetail-sidenav">
          <div class="filter-color">
            <h4>Categories</h4>
            <hr class="green-border">
            <hr class="blue-border">
          </div>
          <!--<div class="widget-title">-->
          <!--  <h4>Explore</h4>-->
          <!--</div>-->
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
      <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
        <!--<div class="row">-->
        <!--  <div class="col-12">-->
        <!--    <div class="form-search-top">-->
        <!--      <form>-->
        <!--        <div class="search-group">-->
        <!--          <div class="input-group input-append p-0">-->
        <!--            <input type="search" placeholder="Search Entire Store">-->
        <!--          </div>-->
        <!--          <div class="input-group-btn input-append-btn">-->
        <!--            <button type="button">-->
        <!--            <i class="fa fa-search"></i>-->
        <!--            </button>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </form>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
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
            <?php
            $vendor = new App\Models\Vendor;
            $vendors = $vendor::where('status', 'ACTIVE')->get();
            ?>
            @foreach($products as $product)
            @foreach($vendors as $vendor)
            @if($vendor->id == $product->vendor_id)
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
                      @foreach($shops as $shop)
                      @if($product->vendor_id == $shop->vendor_id)
                      <p class="listed">listed by: {{\Illuminate\Support\Str::limit($vendor->business_name, 40, '...')}}
                      </p>
                      @endif
                      @endforeach
                      @foreach($categories as $category)
                      @if($product->category_id == $category->id)
                      <h5>({{$category->title}})</h5>
                      @endif
                      @endforeach
                      <hr>
                      @foreach($pcategories as $pcategory)
                      @if($pcategory->id == $product->parent_id)
                      <h6>({{$pcategory->title}})</h6>
                      @endif
                      @endforeach
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

          </div>
          {!! $products->links('pagination') !!}
        </div>
      </div>
    </div>
  </div>
</section>
<style>
  .flex-1 {
    display: none;
  }

  .leading-5 {
    margin-top: 15px;
  }

  svg {
    width: 30px;
  }
</style>
@endsection