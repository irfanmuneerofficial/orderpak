@extends('layouts.master')

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Online Shopping in Pakistan with Free Home Delivery" />
    <meta property="og:description"        content="OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!" />
    <meta property="og:image"              content="{{ asset('frontend/assets/img/logo_res.png') }}" />
@endsection

@section('twitter_card_meta')
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Categories">
	<meta name="twitter:description" content="Categories">
	<meta name="twitter:image" content="">
	<meta name="twitter:url" content="{{url()->current()}}" />
@endsection

@section('page-title')
Categories
@endsection
@section('mainContent')

@section('cat-cat-inside')

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
      "name": "Categories"
    }
  }]
}
</script>
@endsection
<!-- BannerSection -->
<section>
  <div id="carouselExampleIndicators" class="carousel slide carousel-fade order-shop" data-ride="carousel">
    <ol class="carousel-indicators shop-bullets">
      <?php $id = 0; ?>
      @foreach($categorie_banner as $row)
      <li data-target="#carouselExampleIndicators" data-slide-to="{{$id++}}" class="@if($loop->first) active @endif"></li>
      @endforeach
    </ol>
    <div class="carousel-inner">
      @foreach($categorie_banner as $row)
      <div class="carousel-item @if($loop->first) active @endif">
        <a href="{{$row->link}}"><img src="https://orderpak.com/uploads/category/{{$row->banner_img}}"></a>
      </div>
      @endforeach
    </div>
  </div>
</section>
<!-- CategoriesSection -->
<section class="categories-op">
  <!-- PageBreadcrumb -->
  <div class="container-fluid max-con">
    <nav aria-label="breadcrumb">
      <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb custom-breadcrumb justify-content-center">
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1">
          <a itemprop="item" href="{{ url('/') }}">
            <span itemprop="name">Home</span>
          </a>
          <meta itemprop="position" content="1" />
        </li>
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1 active" aria-current="page">
          <span itemprop="name">Categories</span>
          <meta itemprop="position" content="2" />
        </li>
      </ol>
    </nav>
  </div>
  <div class="container max-con">
    <div class="row">
      <div class="col-3 sidebar">
        <div class="sticky-top">
          <div class="widget-title">
            <h4>Categories</h4>
            <hr class="green-border">
            <hr class="blue-border">
          </div>
          <div class="widget-content">
            <ul id="accordion">
              @foreach($categories as $category)
              <li>
                <h4>{{$category->title}}
                  @foreach($category->childCategories as $prow)
                  @if($prow->parent_id == $category->id)
                  <span class="plusminus">+</span>
                  @endif
                  @endforeach
                </h4>
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
      <div class="col-lg-9 col-md-12 col-sm-12">
        <div class="order-border">
          @foreach($categories as $category)
          <div class="electronic">
            <h2>{{$category->title}}</h2>
            <div class="Container">
              <div class="SlickCarousel">
                @foreach($category->childCategories as $prow)
                @if($prow->parent_id == $category->id)
                <div class="ProductBlock">
                  <div class="Content">
                    <div class="img-fill hovereffect">
                      <img src="https://orderpak.com/uploads/category/{{ $prow->category_img }}">
                      <div class="overlay">
                        <h2>{{ $prow->title }}</h2>
                        <a href="/category/{{$category->slug}}/{{ $prow->slug }}" class="info">shop now</a>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endsection