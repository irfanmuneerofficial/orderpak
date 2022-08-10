@extends('layouts.master')

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Online Shopping in Pakistan with Free Home Delivery" />
    <meta property="og:description"        content="OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!" />
    <meta property="og:image"              content="{{ asset('frontend/assets/img/logo_res.png') }}" />
@endsection

@section('twitter_card_meta')
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="About Us">
	<meta name="twitter:description" content="ORDERPAK is built for retailers like you. With useful features, an intuitive interface">
	<meta name="twitter:image" content="">
	<meta name="twitter:url" content="{{url()->current()}}" />
@endsection

@section('page-title')
About Us
@endsection

@section('about-us-inside')

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList",
  "name" : "About Us",
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
      "name": "About Us"
    }
  }]
}
</script>
@endsection

@section('mainContent')
    <section>
      <div class="container">
        <div class="order-aboutus">
          <div class="col-12">
            <h1>About us</h1>
            <p><strong>ORDERPAK</strong> is built for retailers like you. <br>With useful features, an intuitive interface.</p>
          </div>
        </div>
        <nav aria-label="breadcrumb">
          <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb custom-breadcrumb justify-content-center">
            <li itemprop="itemListElement" itemscope
              itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1">
              <a itemprop="item" href="{{ url('/') }}">
                <span itemprop="name">Home</span>
              </a>
              <meta itemprop="position" content="1" />
            </li>
            <li itemprop="itemListElement" itemscope
              itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1 active" aria-current="page">
              <span itemprop="name">About Us</span>
              <meta itemprop="position" content="2" />
            </li>
          </ol>
        </nav>
      </div>
    </section>
    &nbsp;
    <section>
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
            <div class="about-info">
              <img src="/frontend/assets/img/ellipse.png">
              <h6>A business futureproof</h6>
              <p>Creating a business that anticipates future changes by building products and brands that never
become obsolete.</p>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
            <div class="about-info">
              <img src="/frontend/assets/img/ellipse.png">
              <h6>Most trustworthy platform</h6>
              <p>Building businesses are ready for anything with the flexibility, trust and confidence of the
customers.</p>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
            <div class="about-info">
              <img src="/frontend/assets/img/ellipse.png">
              <h6>One dominant platform</h6>
              <p>Have all the tools you need to manage your business, market your products and sell everywhere
in one place.</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
            <div class="about-info">
              <img src="/frontend/assets/img/ellipse.png">
              <h6>Advanced inventory features</h6>
              <p>Generate purchase orders and transfer stock based on inventory forecasts and performance.</p>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
            <div class="about-info">
              <img src="/frontend/assets/img/ellipse.png">
              <h6>Unified reporting</h6>
              <p>Adapt to growing trends in your business with unified analytics that blend in-store and online
sales.</p>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
            <div class="about-info">
              <img src="/frontend/assets/img/ellipse.png">
              <h6>Custom staff permissions</h6>
              <p>Delegate with peace of mind and motivate staff to grow with increased responsibilities.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    &nbsp;
    <section>
      <div class="our-services-back">
        <div class="container">
          <div class="services-info">
            <h1>Our Services</h1>
            <p>With ORDERPAK, you are served by a global ecosystem of retailers, partners, and customers, who will bring you every solution to your needs.</p></div>
            <div class="row">
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="services-card">
                  <h6>Sell —everywhere</h6><span><img src="/frontend/assets/img/ellipse.png"></span>
                  <p>One platform that lets you sell wherever your customers are—online, inperson, and everywhere
inbetween.</P>
                  <!--<button type="button" class="btn btn-light">View More</button>-->
                  <img class="in-img-about" src="/frontend/assets/img/undraw_mail_box_kd5i.png">
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="services-card">
                  <h6>Ecommerce anywhere</h6><span><img src="/frontend/assets/img/ellipse.png"></span>
                  <p>Transform anything Embedded products, Secure checkouts, Customized features and more!</P>
                  <!--<button type="button" class="btn btn-light">View More</button>-->
                  <img class="in-img-about" src="/frontend/assets/img/undraw_inbox_cleanup_w2ur.png">
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="services-card">
                  <h6>Point of sale</h6><span><img src="/frontend/assets/img/ellipse.png"></span>
                  <p>Standout retail experiences to elevate your inperson selling with better shopping experiences and
easy interfaces.</P>
                  <!--<button type="button" class="btn btn-light">View More</button>-->
                  <img class="in-img-about" src="/frontend/assets/img/undraw_file_searching_duff.png">
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="services-card">
                  <h6>Extending your reach</h6><span><img src="/frontend/assets/img/ellipse.png"></span>
                  <p>Get your products in front of more shoppers, social media, digitalization, and so on!</P>
                  <!--<button type="button" class="btn btn-light">View More</button>-->
                  <img class="in-img-about" src="/frontend/assets/img/undraw_file_searching_duff.png">
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="services-card">
                  <h6>Open platform</h6><span><img src="/frontend/assets/img/ellipse.png"></span>
                  <p>Products and services. Anything you want to sell, organize, collect, render and innovate with us.</P>
                  <!--<button type="button" class="btn btn-light">View More</button>-->
                  <img class="in-img-about" src="/frontend/assets/img/undraw_inbox_cleanup_w2ur.png">
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="services-card">
                  <h6>Unified back office</h6><span><img src="/frontend/assets/img/ellipse.png"></span>
                  <p>Use one tool to manage all your products, inventory and customers—no matter how many places
you sell from.</P>
                  <!--<button type="button" class="btn btn-light">View More</button>-->
                  <img class="in-img-about" src="/frontend/assets/img/undraw_mail_box_kd5i.png">
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    @endsection