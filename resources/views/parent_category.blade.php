@extends('layouts.master')

@section('script_text')
<?php echo $pcategoriesid->script_text ?? '' ?>
@endsection

<?php
if($pcategoriesid->meta_title){
  $title = $pcategoriesid->meta_title;
}
else{
  $title = 'Online Shopping in Pakistan with Free Home Delivery';
}
if($pcategoriesid->meta_description){
  $desc = $pcategoriesid->meta_description;
}
else{
  $desc = 'OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!';
}

if($pcategoriesid->category_img){
  $img = asset('uploads/category/'. $pcategoriesid->category_img);
}
else{
  $img =  asset('frontend/assets/img/logo_res.png');
}

$img = asset('uploads/category/cat_ban.jpeg');

?>

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ $title }}" />
    <meta property="og:description"        content="{{ $desc }}" />
    <meta property="og:image"              content="{{ $img }}" />
@endsection

@section('twitter_card_meta')
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="{{ $title }}">
	<meta name="twitter:description" content="">
	<meta name="twitter:image" content="{{ asset('uploads/category/'. $img ) }}">
	<meta name="twitter:url" content="{{url()->current()}}" />
@endsection

@section('page-title')
{{ucwords(str_replace(array('-'),array(' '),Request::segment(3)))}}
@endsection
@section('title')
<?php echo $title ?>
@endsection
@section('description')
<?php echo $desc ?>
@endsection

@section('parent-cat-inside')

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "name" : "Category",
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
      "@id": "{{ url('category/') }}",
      "name": "Category"
    }
  },{
    "@type": "ListItem",
    "position": 3,
    "item": {
      "name": "{{ucwords(str_replace(array('-'), array(' '), Request::segment(3)))}}"
    }
  }]

}
</script>
@endsection

@section('mainContent')
<section>
  <div id="carouselExampleIndicators" class="carousel slide carousel-fade order-shop" data-ride="carousel">
    <ol class="carousel-indicators shop-bullets">
      @foreach($categorie_banner as $row => $value)
      <li data-target="#carouselExampleIndicators" data-slide-to="{{$row}}" class="@if($loop->first) active @endif"></li>
      @endforeach
    </ol>
    <div class="carousel-inner">
      @foreach($categorie_banner as $value =>  $row)
      <div class="carousel-item @if($loop->first) active @endif">
        <a href="{{$row->link}}"><img src="https://orderpak.com/uploads/category/{{$row->banner_img}}"></a>
      </div>
      @endforeach
    </div>
  </div>
</section>
<section class="product-info-sec">
  <div class="container max-con">
    <nav aria-label="breadcrumb">
      <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb custom-breadcrumb">
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1">
          <a itemprop="item" href="{{ url('/') }}">
            <span itemprop="name">Home</span>
          </a>
          <meta itemprop="position" content="1" />
        </li>
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1">
          <a itemprop="item" href="{{ url('category/') }}">
            <span itemprop="name">Categories</span>
          </a>
          <meta itemprop="position" content="2" />
        </li>
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1">
          <a itemprop="item" href="{{ url('category', str_replace(array('/'), array(' '), Request::segment(2))) }}">
            <span itemprop="name">{{ucwords(str_replace(array('-'), array(' '), Request::segment(2)))}}</span>
          </a>
          <meta itemprop="position" content="3" />
        </li>
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1 active" aria-current="page">
          <span itemprop="name"> {{ucwords(str_replace(array('-'), array(' '), Request::segment(3)))}}</span>
          <meta itemprop="position" content="4" />
        </li>
      </ol>
    </nav>
    <div class="row">
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
        <div class="shopdetail-sidenav">
        <div class="filter-color">
          <!-- <h4>Categories</h4> -->
          <p style="font-size: 20px;">Categories</p>
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
              <!-- <h4>{{$category->title}}
                @foreach($category->childCategories as $prow)
                  @if($prow->parent_id == $category->id)
                    <span class="plusminus">+</span>
                  @endif
                @endforeach
              </h4> -->
              <strong>{{$category->title}}
                @foreach($category->childCategories as $prow)
                  @if($prow->parent_id == $category->id)
                    <span class="plusminus">+</span>
                  @endif
                @endforeach
              </strong>
              <ul>
                @foreach($category->childCategories as $prow)
                  @if($prow->parent_id == $category->id)
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
                $vendors = $vendor::where('status','ACTIVE')->get();
            ?>
            @foreach($parent_categories as $product)
            @foreach($vendors as $vendor)
            @if($vendor->id == $product->vendor_id)
            <a href="/product/{{$product->slug}}" style="text-decoration: none; color:#2C5779;">
            <div class="item col-xl-4 col-lg-4 col-md-4 col-sm-4 respon-card">
              <div class="thumbnail card product-grid7">
                <div class="button-product">
                <div class="img-event product-image7">
                  <img class="pic-1 group list-group-image" src="{{ asset('uploads/product_images').'/'.$product->image_1 }}" alt="{{$product->title}}" />
                </div>
                <div class="caption card-body body-card">
                  <p class="listed">listed by:
                    {{-- {{$product->shop->shop_name}} --}}
                    {{\Illuminate\Support\Str::limit($vendor->business_name, 40, '...')}}
                  </p>
                  <!-- <h5>({{$product->categoryname->title}})</h5> -->
                  <p style="font-size: 12px;margin: auto;text-align: center;color: #2C5779;">({{$product->categoryname->title}})</p>
                  <hr>
                  <!-- <h6>{{$product->parentcategory->title}}</h6> -->
                  <p style="font-size: 12px;color: #000;text-align: center;margin-bottom: 3px;">{{$product->parentcategory->title}}</p>
                  <!-- <h4 class="group card-title inner list-group-item-heading">
                    {{\Illuminate\Support\Str::limit(  $product->title, 16, '...')}}
                  </h4> -->
                  <p style="text-align: center;font-size: 14px;color: #2C5779;margin-bottom: 3px;" class="group card-title inner list-group-item-heading">
                    {{\Illuminate\Support\Str::limit(  $product->title, 16, '...')}}
                  </p>
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
            @endif
            @endforeach
            @endforeach
          </div>
          {!! $parent_categories->links('pagination') !!}

             @if (!empty(trim(strip_tags($pcategoriesid->showtext))))
                   {!! $pcategoriesid->showtext !!}
                   <span id="moredata" >
                     {!! $pcategoriesid->hidtext !!}
                   </span>

                    @if (!empty(trim(strip_tags($pcategoriesid->hidtext))))
                        <div class="button-product">
                            <button onclick="hidecontent()" id="myBtn"  class="btn btn-info">Read More</button>
                        </div>
                    @endif
               @endif

        </div>
      </div>
    </div>
  </div>
</section>
@endsection
