<!DOCTYPE html>
<html lang="en">
<?php 
    use Symfony\Component\HttpFoundation\Session\Session;
    $session = new Session();
?>
<head>
    <meta charset="UTF-8">

    <meta property="fb:app_id" content="193101284756200" />
    <meta property="og:url" content="{{url()->current()}}/" />
    @yield('facebook_meta')
    @yield('twitter_card_meta')
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="WcRzU3khzxd07vdXinThAhBCPMd2U8cGDGeOk61-SJw" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="title" content="@yield('title')" />
    <meta name="Description" content="@yield('description')" />

    @if (config('app.env') == 'production' && !Request::is('checkout'))
        <meta name="robots" content="index, follow" />
    @else
        <meta name="robots" content="noindex, nofollow" />
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="WcRzU3khzxd07vdXinThAhBCPMd2U8cGDGeOk61-SJw" />
    <link rel="canonical" href="{{url()->current()}}/" />
    <link rel="alternate" hreflang="en-PK" href="{{url()->current()}}/"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery-ui.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/img/favicon.png') }}" />
    <title>@yield('page-title') | OrderPak</title>
    <!-- SEO script -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-186791268-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-186791268-2');
    </script>
    <!-- End-->

    <!-- *** Organization Schema -->
    <script type="application/ld+json">
         {
            "@context": "https://schema.org",
            "@type": "Organization",
            "url": "https://www.orderpak.com/",
            "logo": "{{ asset('frontend/assets/img/OrderPak.png') }}"
         }
    </script>
    <!-- *** SiteLink Search Schema -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "Orderpak",
            "url": "https://www.orderpak.com/",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "https://www.orderpak.com/search/?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>


    @yield('product-inside')
    @yield('parent-cat-inside')
    @yield('main-cat-inside')
    @yield('cat-cat-inside')
    @yield('child-cat-inside')
    @yield('about-us-inside')
    @yield('privacy-policy-inside')
    @yield('terms-condition-inside')
    @yield('shipping-policy-inside')
    @yield('order-returns-inside')
    @yield('help-inside')
    @yield('contact-us-inside')
    @yield('faqs-inside')
    @yield('user-reg-inside')
    @yield('dealer-reg-inside')
    @yield('shop-inside')
    
    <!-- Schema End -->

    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '430528521489298');
        fbq('track', 'PageView');
        fbq('track', 'Purchase', {
            value: 0.00,
            currency: 'PKR'
        });
    </script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=430528521489298&ev=PageView&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->

    @php

        $getScriptFromSettings = \DB::table('settings')->where('id','=','1')->get();

        if(count($getScriptFromSettings) > 0){
            echo $getScriptFromSettings[0]->script_text;
        }

    @endphp

    @yield('script_text')

</head>

<body>
    <!-- START HEADER MOBILE DESKTOP-->
    <header>
        <!-- START TOP BAR -->
        <div class="col-12 p-0">
            <?php
            $headlines = App\Models\Headline::class;
            $headline = $headlines::select('id','description','logo','bgcolor')->first();
            ?>
            @if($headline)
            <marquee class="tagline" style="background-color: {{$headline->bgcolor}}">@if($headline->logo)<img src="uploads/admin/headline/{{$headline->logo}}" width="100"> @endif {{$headline->description}}</marquee>
            @endif
        </div>
        <div class="top-bar">
            <div class="container max-con">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 top-left">
                        <ul>
                            <li><a href="mailto:info@orderpak.com"><i class="fa fa-envelope" aria-hidden="true"></i> <span>info@orderpak.com</span></a></li>
                            <li><a href="tel:+92 300 0370646"><i class="fa fa-mobile" aria-hidden="true"></i> <span>+92 300 0370646</span></a></li>
                        </ul>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 top-right">
                        <ul>
                            <!--<li><i class="fas fa-truck"></i> <span><a href="#">Track Your Order</a></span></li>-->
                            <li><i class="fas fa-shopping-bag"></i> <span><a href="/shop">Shop</a></span> | </li>
                            @if (Auth()->check())
                            <li><i class="fas fa-user"></i> <span><a href="/user/dashboard">{{ Auth::user()->fullname }}</a> | <a href="{{ route('user.logout') }}">Logout</a></span></li>
                            @elseif(Auth::guard('admin')->check())
                            <li><i class="fas fa-user"></i> <span><a href="/admin/dashboard">{{ Auth::guard('admin')->user()->fullname }}</a> | <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}/" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </span></li>
                            @elseif(Auth::guard('vendor')->check())
                            <li><i class="fas fa-user"></i> <span><a href="/vendor/dashboard">{{ Auth::guard('vendor')->user()->first_name }} {{ Auth::guard('vendor')->user()->last_name }}</a> | <a href="{{ route('vendor.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('vendor.logout') }}/" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </span></li>
                            @else
                            <li><i class="fas fa-user"></i> <span><a href="#" class="menu-item mega-menu" id="hover">Login</a> | <a class="menu-items mega-menus" id="hover" href="#">Register</a></span></li>
                            <div id="menu-dropdowns">
                                <ul>
                                    <li><a href="/user/register">Register Customer</a></li>
                                    <li><a href="/vendor/register">Register Dealer</a></li>
                                </ul>
                            </div>
                            <div id="menu-dropdown">
                                <ul>
                                    <li><a href="/login">Login Customer</a></li>
                                    <li><a href="/vendor/login">Login Dealer</a></li>
                                </ul>
                            </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END TOP BAR -->
        <!-- START NAVBAR BAR DESKTOP-->
        <div class="navbar home-fixed">
            <div class="container max-con">
                <div class="row" style="width: 100%;">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                        <!-- CLICK TO SIDE NAVBAR MOBILE START -->
                        <div class="block">
                            <div class="cta">
                                <div class="toggle-btn1 type1"></div>
                            </div>
                        </div>
                        <!-- <a class="open-text fas fa-bars" onclick="openNav()"></a> -->
                        <!-- CLICK TO SIDE NAVBAR MOBILE END -->
                        <!-- LOGO DESKTOP START -->
                        <a class="navbar-brand" href="/">
                            <img alt="OrderPak Online Shopping Pakistan" title="OrderPak Online Shopping Pakistan" description="OrderPak Best Online Shopping in Pakistan" src="{{ asset('frontend/assets/img/OrderPak.png') }}">
                        </a>
                        <!-- LOGO DESKTOP START -->
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                        <!-- SEARCH FORM CATEGORIES DESKTOP START-->
                        <form action="{{ url('search') }}/" method="GET" role="search">
                            {{ csrf_field() }}
                            <div class="input-group search-category">
                                <span class="input-group-btn group-btn-cate">
                                    <button class="btn btn-default btn-search-category" type="button"><i class="fas fa-search"></i></button>
                                </span>
                                <input type="text" class="form-control search-input" name="q" placeholder="Search for Products" required>
                                <div class="input-group-btn group-btn-cate">

                                    <span id="search_concept" class="btn btn-default filter-btn" style="cursor:auto;">All Categories</span>
                                </div>
                                <div class="filter-btn-search">
                                    <button type="submit" class="btn btn-info">Search</button>
                                </div>
                            </div>
                        </form>
                        <!-- SEARCH FORM CATEGORIES DESKTOP END-->
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                        <div class="icon-right-arrow">
                            <!--ICON WHISHLIST START -->
                            @if (Auth()->check())
                            <div class="wrapper list-wrapper">
                                <div class="icon-wishlist">&nbsp;</div>
                                <a href="/user/wishlist">
                                    <div class="yellow-circle">
                                        @if (Auth()->check())
                                        <?php
                                        $wishlist = new \App\Models\Wishlist;
                                        $wp = $wishlist::where('user_id', Auth::user()->id)->count();
                                        ?>
                                        @if($wp > 0 )
                                        {{$wp}}
                                        @else
                                        0
                                        @endif

                                        @endif
                                    </div>
                                </a>
                            </div>
                            @else
                            <a href="/login">
                                <div class="wrapper list-wrapper">
                                    <div class="icon-wishlist">&nbsp;</div>
                                    <div class="yellow-circle">0</div>
                                </div>
                            </a>
                            @endif
                            <!--ICON WHISHLIST START -->
                            <!--ORDER PLACEMENT START -->
                            <div class="user_order">
                                <a href="/login"><i class="far fa-user"></i></a>
                                <!--ORDER PLACEMENT END -->
                                <!--CART START -->
                                <div class="orderpak_bag">
                                    <a href="{{Auth::guard('vendor')->check() ? '/login' :  '/cart' }}"><i class="fas fa-shopping-cart"><span class="number-circle">
                                                
                                                <?php
                                                if(Auth::check()){
                                                    $userid = Auth::user()->id;
                                                }
                                                else if($session->get('guest_chk')){
                                                    $userid = $session->get('guest_chk');
                                                }
                                                else{
                                                    $userid = '';
                                                }
                                                if($userid){
                                                    $cart = new App\Models\AddCart;
                                                    $cc = $cart::where('user_id', $userid)->where('status', null)->count();
                                                    $carts = $cart::where('user_id', $userid)->get();

                                                    $product = new App\Models\Product;
                                                    $products = $product::select('id','title','vendor_id','product_sku','color_check','colors','condition','price','sale_status','sale_price','quantity','category_id','parent_id','child_id','size_qty','product.image_1','systematic_sku')->get();
                                                    // echo '<pre>';
                                                    // print_r($carts);die;
                                                    ?>
                                                    @if(!$carts->isEmpty())
                                                        @foreach($carts as $cartt)
                                                            @if($cartt->status == '')
                                                                @if($cc > 0 )
                                                                    {{$cc}}
                                                                @break
                                                                @endif
                                                            @break
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        0
                                                    @endif
                                                <?php } 
                                                    else{
                                                        echo '0';
                                                    }
                                                ?>
                                            </span></i></a>
                                    {{-- <span class="price_pkr">0.00 Pkr</span> --}}
                                    @if (Auth()->check())
                                    <div class="orderpak_content">
                                        <div class="arrow-up">
                                            <img src="assets/img/arrow-top.png">
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <?php
                                                $cart = new App\Models\AddCart;
                                                $cc = $cart::where('user_id', Auth::user()->id)->where('status', null)->count();
                                                $carts = $cart::where('user_id', Auth::user()->id)->get();

                                                $product = new App\Models\Product;
                                                $products = $product::select('id','title','vendor_id','product_sku','color_check','colors','condition','price','sale_status','sale_price','quantity','category_id','parent_id','child_id','size_qty','product.image_1','systematic_sku')->get();
                                                ?>
                                                @foreach($carts as $cartt)
                                                @if(empty($cartt->status))
                                                @if($cc > 0 )
                                                <h3 class="item-count">{{$cc}} item</h3>
                                                @break
                                                @endif
                                                @break
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="col-6">
                                                <a href="/cart">
                                                    <h3 class="view-cart">View Cart</h3>
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="home-scroll">
                                            @if (Auth()->check())
                                            <?php
                                            $cart = new App\Models\AddCart;
                                            $cc = $cart::where('user_id', Auth::user()->id)->count();
                                            $carts = $cart::where('user_id', Auth::user()->id)->get();

                                            $product = new App\Models\Product;
                                            $products = $product::select('id','title','vendor_id','product_sku','color_check','colors','condition','price','sale_status','sale_price','quantity','category_id','parent_id','child_id','size_qty','product.image_1','systematic_sku')->get();
                                            ?>

                                            @foreach($carts as $cart)
                                            @foreach($products as $product)
                                            @if($cart->product_id == $product->id)
                                            @if($cart->status == '')

                                            <div class="product-home">
                                                <div class="product-removal-home">
                                                    <span class="close" onClick="reply_click(this.id)" id="{{$cart->id}}">&times;</span>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="product-details">
                                                                <div class="product-title">
                                                                    <h1 class="cart_title">{{$product->title}}</h1>
                                                                    {{-- <h3 class="cart_category">By: Adidas</h3> --}}
                                                                </div>
                                                            </div>
                                                            @if($product->sale_price>0)
                                                            <div class="product-price">{{number_format($product->sale_price)}}</div>
                                                            @else
                                                            <div class="product-price">{{number_format($product->price)}}</div>
                                                            @endif

                                                            @if($product->sale_price>0)
                                                            <div class="product-line-price-home">{{number_format($product->price)}}</div>
                                                            @else
                                                            <div class="product-line-price-home">{{number_format($product->price)}}</div>
                                                            @endif
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="product-image">
                                                                <img class="cart_img" src="/uploads/product_images/{{$product->image_1}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                            @endif

                                        </div>
                                        <hr>
                                        <a href="/checkout"><button class="btn btn-info checkout-btn">Checkout</button></a>
                                    </div>
                                    @endif
                                </div>

                                <!--CART END -->
                                <!-- Search Form MOBILE START -->
                                <a href="javascript:void(0)" class="search-open" onclick="openSearch()"><i class="fa fa-search"></i></a>
                                <div id="myOverlay" class="overlay-login">
                                    <div class="overly-logo">
                                        <img src="{{ asset('frontend/assets/img/OrderPak.png') }}">
                                    </div>
                                    <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                                    <div class="overlay-content">
                                        <form action="{{ url('search') }}/" method="GET" role="search">
                                            <input class="overly-input" type="text" placeholder="Search.." name="q">
                                            <button class="overly-button" type="submit"><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Search Form MOBILE END -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END NAVBAR BAR -->
        <div class="container max-con">
            <!-- START MENU BAR MOBILE -->
            <div id="mySidenav" class="sidenav">
                <div class="page-wrapper chiller-theme toggled">
                    <nav id="sidebar" class="sidebar-wrapper">
                        <div class="sidebar-content">
                            <div class="sidebar-menu">
                                <ul>
                                    <?php
                                    $roww = new App\Models\Categories;
                                    $categoriess = $roww::select('id','title','slug','description','category_img','category_icon','parent_id','meta_title','meta_description','meta_keyword','showtext','script_text')->where('parent_id', 0)->get();
                                    ?>
                                    @foreach($categoriess as $category)
                                    <li class="sidebar-dropdown">
                                        <a href="/category/{{ $category->slug }}">
                                            <img src="/uploads/category/{{$category->category_icon}}">
                                            <span>{{$category->title}}</span>
                                        </a>
                                        <div class="sidebar-submenu">
                                            <ul>
                                                <?php
                                                // $proww = new App\Models\ParentCategory;
                                                // $ppcategories = $proww::where('main_id', $category->id)->get();
                                                ?>
                                                @if($category->childCategories->count() > 0)
                                                    
                                                        @include('partials.childCategoriesList', ['subcategories' => $category->childCategories])
                                                    
                                                @endif
                                            </ul>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- sidebar-menu  -->
                        </div>
                </div>
                <!-- END MENU BAR MOBILE -->
            </div>
        </div>
        <?php
        $current =  url('/');
        $path =  request()->fullUrl();
        ?>
        @if($current != $path)
        <!-- START MENU BAR -->
        <nav class="navbar navbar-light bg-light order-nav ">
            <div class="container max-con">
                <button class="navbar-toggler toggler-btn" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <span>Categories</span>
                <ul class="mr-auto">
                    <li><a href="/">Home</a></li>
                    <li><a href="/shop">Shop</a></li>
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/user/register">Join Orderpak</a></li>
                    <li><a href="/contact">Contact</a></li>
                    <li><a href="/faq">FAQ'S</a></li>
                </ul>
            </div>
        </nav>
        <div class="container max-con">
            <div class="pos-f-t">
                <div class="collapse collapse-order" id="navbarToggleExternalContent">
                    <div class="nav_cate">
                        <div class="main_nav_content">
                            <ul class="cat_info_menu">

                                @foreach($categoriess as $row)
                                <li class="hassubs">
                                    <a href="/category/{{ $row->slug }}"><img src="/uploads/category/{{ $row->category_icon }}">
                                        {{\Illuminate\Support\Str::limit( $row->title, 22, '...')}}
                                        <?php
                                        // $proww = new App\Models\ParentCategory;
                                        $ppcategories = $row->childCategories;
                                        ?>
                                        @foreach($ppcategories as $prow)
                                            <i class="fas fa-chevron-right"></i>
                                        @endforeach
                                    </a>
                                    <ul>
                                        @foreach($ppcategories as $prow)
                                        <li class="hassubs">
                                            <a href="/category/{{$row->slug}}/{{ $prow->slug }}">
                                                {{$prow->title}}
                                                <?php
                                                // $croww = new App\Models\ChildCategory;
                                                $cccategories = $prow->childCategories;
                                                ?>
                                                @foreach($cccategories as $crow)
                                                <i class="fas fa-chevron-right"></i>
                                                @endforeach
                                            </a>
                                            @foreach($cccategories as $crow)
                                            <ul>
                                                @foreach($cccategories as $crow)
                                                <li>
                                                    <a href="/category/{{$row->slug}}/{{$prow->slug}}/{{ $crow->slug }}"><i class="fas fa-chevron-right"></i>
                                                        {{$crow->title}}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endforeach
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MENU BAR -->
        @endif
    </header>
    <!-- END HEADER -->

    <!-- START MAIN CONTENT -->
    @yield('mainContent')
    <!-- END MAIN CONTENT -->

    <!-- START BACK TO TOP SECTION  -->
    <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i class="fa fa-chevron-up"></i></a>
    <!-- END BACK TO TOP SECTION  -->
    <!-- Footer Section Start -->
    <footer>
        <div class="container max-con">
            <div class="newsletter-main">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                    <img src="{{ asset('frontend/assets/img/Icon_material-email.png') }}">
                                </div>
                                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                                    <strong>SIGN UP FOR NEWSLETTER</strong>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                            <div class="row">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                                    <p>Subscribe to the weekly newsletter for all
                                        the latest updates
                                    </p>
                                </div>
                                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                                    <div class="newsletter-input">
                                        <form action="{{ url('subscribe') }}/" method="post">
                                            @csrf
                                            <input class="form-control" name="email" @if (Session('autofocus')) autofocus @endif id="email" placeholder="Your Email.." required="">
                                            <button type="submit" class="btn btn-light">Subscribe</button>
                                        </form>
                                    </div>
                                    @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container max-con">
            <div class="footer-section">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="fast-inner-section">
                            <strong class="footer-title">Categories</strong>
                            <ul class="list-unstyled">
                                <?php
                                $rowww = new App\Models\Categories;
                                $categoriiess = $rowww::select('id','title','slug')->where('parent_id', 0)->get();
                                ?>
                                @foreach($categoriiess as $category)
                                <li><a href="/category/{{$category->slug}}">{{ $category->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12">
                        <div class="info-inner-section">
                            <strong class="footer-title">Quick Links</strong>
                            <ul class="list-unstyled">
                                <li><a href="/about">About Us</a></li>
                                <li><a href="/contact">Contact Us</a></li>
                                <li><a href="/blog">Blog</a></li>
                                <li><a href="/shop">Shop</a></li>
                                <li><a href="/user/register">Join User</a></li>
                                <li><a href="/vendor/register">Join Vendor</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="merchant-inner-section">
                            <strong class="footer-title">Information</strong>
                            <ul class="list-unstyled">
                                <li><a href="/privacy_policy">Privacy policy</a></li>
                                <li><a href="/terms_and_conditions">Terms &amp; condition</a></li>
                                <li><a href="/shipping_policy">Shipping Policy</a></li>
                                <li><a href="/orders_and_returns">Order &amp; Returns</a></li>
                                <li><a href="/help">Help</a></li>
                                <li><a href="/faq">FAQ'S</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="footer-contact">
                            <strong class="footer-title">Contact Us</strong>
                            <p>If you have any question, please contact us at support@orderpak.com</p>
                            <div class="footer-info">
                                <i class="fas fa-map-marker"></i>
                                <span>Office # 105, 1st Floor Asia Pacific Trade Center, Block 19 Gulistan e Johar, Karachi.</span>
                            </div>
                            <div class="footer-info">
                                <div class="row">
                                    <div class="col-2 mt-xl-2">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <div class="col-10 footer-inner-info">
                                        <a href="tel:+92 300 0370646"> +92 300 0370646</a><br>
                                        <!--<a href="tel:+44 123 456 788"> +44 123 456 788</a><br>-->
                                        <!--<a href="tel:+92 123 456 789"> +92 123 456 789</a>-->
                                    </div>
                                </div>
                            </div>
                            <a href="#"><button type="button" class="btn btn-light">Click to Live Chat</button></a>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="footer-pages">
                        <ul class="list-unstyled">
                            <li><a href="/">Home</a></li>
                            <li><a href="/about">About Us</a></li>
                            <li><a href="/shop">Shop</a></li>
                            <li><a href="/blog">Blog</a></li>
                            <li><a href="/contact">Contact Us</a></li>
                            <li><a href="/help">Help</a></li>
                        </ul>
                        <p>OrderPak strives to provide convenience to both buyers and sellers. Customers and vendors can connect with each other without leaving the comfort of their homes.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyrights">
            <div class="container max-con">
                <div class="copyrights-main">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="copyrights">
                                <p>Copyright © {{date('Y')}} <strong>Orderpak.</strong> All Rights Reserved.</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 copyrights-img text-right">
                            &nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
    <script src="{{ asset('frontend/assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.zoom.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend/assets/js/slick.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
    <script>
        $('.ex1').zoom();

        $(document).ready(function() {
            $(".mega-menu").mouseenter(function() {
                $('#menu-dropdown').stop().show();
            });

            $(".mega-menu, #menu-dropdown").mouseleave(function() {
                if (!$('#menu-dropdown').is(':hover')) {
                    $('#menu-dropdown').hide();
                };
            });

            $(".mega-menus").mouseenter(function() {
                $('#menu-dropdowns').stop().show();
            });

            $(".mega-menus, #menu-dropdowns").mouseleave(function() {
                if (!$('#menu-dropdowns').is(':hover')) {
                    $('#menu-dropdowns').hide();
                };
            });
        });

        // CATEGORY SEARCH BAR MOBILE START
        function openSearch() {
            document.getElementById("myOverlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("myOverlay").style.display = "none";
        }
        // CATEGORY SEARCH BAR MOBILE END

        function deleteclick(clicked_id) {

            var id = clicked_id;

            $.get('/cart/' + clicked_id,
                function(data) {
                    $(".cart-remove0").slideUp(300, function() {
                        $(".cart-remove0").remove();
                        recalculateCart().fadeIn(fadeTime);
                    });

                }
            );
        }

        $(document).ready(function() {
            recalculateCart();

        });

        function select_city() {
            var x = document.getElementById("upsell-dropdown");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
        // var selectprice  =$( "#sel1 option:selected" ).val();
        // alert(selectprice);

        function choice1() {
            var selectprice = $("#sel1 option:selected").val();
            var totalp = $('#totalsubtotal').text();
            const sum = Number(selectprice) + Number(totalp);
            //alert(sum)
            // store input numbers

            //add two numbers
            $('#cart-shipping').text(selectprice);
            $('#totalprice').text(sum);
            // alert(select.options[select.selectedIndex].text);
        }
        /* Set rates + misc */
        var shippingRate = 0;
        var fadeTime = 300;


        /* Assign actions */
        // $('.product-quantity0 input').change( function() {
        //   updateQuantity0(this);
        // });

        $('.product-removal button').click(function() {
            removeItem(this);
        });


        /* Recalculate cart */
        function recalculateCart() {
            var subtotal = 0;
            var subtota = 0;
            var quantity = 0;
            /* Sum up row totals */
            $('.product').each(function() {
                subtotal = parseFloat($(this).children('.product-line-price').text());
                quantity = parseFloat($(this).children('.cartquantity').text());
                subtota += subtotal * quantity;
            });
            // alert(subtota);

            /* Calculate totals */
            var shipping = (subtota > 0 ? shippingRate : 0);
            var total = subtota + shipping;



            /* Update totals display */
            $('.totals-value').fadeOut(fadeTime, function() {
                $('#totalsubtotal').html(subtotal.toFixed());
                // $('#cart-tax').html(tax.toFixed(2));
                $('#totalshipping').html(shipping.toFixed());
                $('#totalprice').html(total.toFixed());
                if (total == 0) {
                    $('.checkout').fadeOut(fadeTime);
                } else {
                    $('.checkout').fadeIn(fadeTime);
                }
                $('.totals-value').fadeIn(fadeTime);
            });
        }


        /* Update quantity */
        function updateQuantity1(quantityInput) {
            //alert('quantityInput');
            /* Calculate line price */
            var productRow = $(quantityInput).parent();
            // alert(productRow);
            var price = parseFloat(productRow.children('.product-price').text());
            var quantity = $(quantityInput).val();
            var linePrice = price * quantity;

            /* Update line price display and recalc cart totals */
            productRow.children('.product-line-price').each(function() {
                $(this).fadeOut(fadeTime, function() {
                    $(this).text(linePrice.toFixed(2));
                    recalculateCart();
                    $(this).fadeIn(fadeTime);
                });
            });
        }


        /* Remove item from cart */
        function reply_click(clicked_id) {
            var id = clicked_id;

            $.get('/cart/' + clicked_id,
                function(data) {

                }
            );
            // alert(clicked_id);
        }

        function removeItem(removeButton) {
            var numItems = $('.remove-product').length - 1;
            $('#productcount').text(numItems);
            /* Remove row from DOM and recalc cart total */
            var productRow = $(removeButton).parent().parent();
            productRow.slideUp(fadeTime, function() {
                productRow.remove();
                recalculateCart();
            });
        }
    </script>

    {{-- Checkout --}}
    <script>
        /*** START Cart Button JS ****/
        $(document).ready(function() {
            var product_price = $('.product-line-price0').text();
            var product_price1 = $('.product-line-price1').text();
            var shippingprice = $('#shippingprice').text();
            var subtotalproduct = $('#subtotalproduct').text();
            var abcd = Number(product_price) + Number(product_price1);
            $('#subtotalproduct').text(Number(product_price) + Number(product_price1));
            $('#subtotalprice').text(Number(shippingprice) + Number(abcd));
            $('#producttp').val(Number(shippingprice) + Number(abcd));
            // alert(subtotal_price);

            $('#hideprice').hide();
            $('#hideprice1').hide();
            var taxRate = 0.05;
            var shippingRate = $('#shippingprice').text();
            var fadeTime = 300;

            $('.product-quantity0 input').change(function() {
                var id = $('#quantityp').val();
                // alert(id);
                updateQuantity0(id);
            });
            $('.product-quantity1 input').change(function() {
                updateQuantity1(this);
            });

            $('.product-removal button').click(function() {
                removeItem(this);
            });

            function updateQuantity0(quantity) {
                /* Calculate line price */
                // alert(quantityInput);
                var price = $('.product-price0').text();
                // var quantity = $('#quantityp').val();
                var linePrice = price * quantity;
                // var linePricee = price * quantity;
                /* Update line price display and recalc cart totals */
                $('.product-line-price0').each(function() {
                    $('.product-line-price0').fadeOut(300, function() {
                        $('.product-line-price0').text(linePrice.toFixed());
                        recalculateCart();
                        $('.product-line-price0').fadeIn(300);
                        // $('#hideprice').hide();
                    });
                });


                $('#subtotalproduct').each(function() {
                    $('#subtotalproduct').fadeOut(300, function() {
                        $('#subtotalproduct').text(linePrice.toFixed());
                        recalculateCart();
                        $('#subtotalproduct').fadeIn(300);
                        // $('#hideprice').hide();
                    });
                });

                var shipping = $('#shippingprice').text();
                var totalprice = linePricee += Number(shipping);
                // alert(totalprice);
                $('#subtotalprice').each(function() {
                    $('#subtotalprice').fadeOut(300, function() {
                        $('#subtotalprice').text(totalprice.toFixed());
                        recalculateCart();
                        $('#subtotalprice').fadeIn(300);
                        // $('#hideprice').hide();
                    });
                });
            }

            function updateQuantity(quantityInput) {
                /* Calculate line price */

                var price = $('.product-price1').text();
                // alert(price);
                var quantity = $('#quantityp1').val();
                var linePrice = price * quantity;
                var linePricee = price * quantity;
                /* Update line price display and recalc cart totals */
                $('.product-line-price1').each(function() {
                    $('.product-line-price1').fadeOut(300, function() {
                        $('.product-line-price1').text(linePrice.toFixed());
                        recalculateCart();
                        $('.product-line-price1').fadeIn(300);
                        // $('#hideprice').hide();
                    });
                });


                $('#subtotalproduct').each(function() {
                    $('#subtotalproduct').fadeOut(300, function() {
                        $('#subtotalproduct').text(linePrice.toFixed());
                        recalculateCart();
                        $('#subtotalproduct').fadeIn(300);
                        // $('#hideprice').hide();
                    });
                });

                var shipping = $('#shippingprice').text();
                var totalprice = linePricee += Number(shipping);
                // alert(totalprice);
                $('#subtotalprice').each(function() {
                    $('#subtotalprice').fadeOut(300, function() {
                        $('#subtotalprice').text(totalprice.toFixed());
                        recalculateCart();
                        $('#subtotalprice').fadeIn(300);
                        // $('#hideprice').hide();
                    });
                });
            }


            function recalculateCart() {
                // alert('sad');
                var subtotal = 0;

                var firstproduct = $('.product-line-price0').text();
                var secondproduct = $('.product-line-price1').text();
                var shippingprice = $('#shippingprice').text();
                var totaal = Number(firstproduct) + Number(secondproduct);
                var totaal1 = Number(firstproduct) + Number(secondproduct) + Number(shippingprice);

                $('#subtotalproduct').text(totaal);
                $('#subtotalprice').text(totaal1);

                /* Sum up row totals */
                $('.cart-summary-main').each(function() {
                    subtotal += $('.product-line-price').text();
                });
                // var shipping = (subtotal > 0 ? shippingRate : 0);
                // var total = subtotal + shippingRate;
                var total = Number(totaal) + Number(shippingRate);

                var shippingcustom = shippingRate;
                if (total == shippingcustom) {
                    // alert('total');
                    $('#shippingprice').text('0');
                    $('#subtotalprice').text('0');
                    // $('#hide-continue-btn').css();
                }
                /* Update totals display */
                $('.totals-value').fadeIn(fadeTime, function() {
                    $('#shippingprice').html(shipping.toFixed());
                    $('#totalsubtotal').html(subtotal.toFixed());
                    $('#cart-total').html(total.toFixed());
                    if (total == 0) {
                        $('.checkout').fadeOut(fadeTime);
                        // $('#shippingprice').text();
                        // alert('saad');
                    } else {
                        $('.checkout').fadeIn(fadeTime);
                    }
                    $('.totals-value').fadeIn(fadeTime);
                });
            }



            $(document).ready(function() {
                $(".delete1").click(function() {
                    $(".cart-remove1").slideUp(300, function() {
                        $(".cart-remove1").remove();
                        recalculateCart().fadeIn(fadeTime);
                    });
                });
            });

            $('.minus_1').click(function() {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $('.plus_1').click(function() {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
        });

        function getCodeBoxElement(index) {
            return document.getElementById('codeBox' + index);
        }

        function onKeyUpEvent(index, event) {
            const eventCode = event.which || event.keyCode;
            if (getCodeBoxElement(index).value.length === 1) {
                if (index !== 4) {
                    getCodeBoxElement(index + 1).focus();
                } else {
                    getCodeBoxElement(index).blur();
                    // Submit code
                    console.log('submit code ');
                }
            }
            if (eventCode === 8 && index !== 1) {
                getCodeBoxElement(index - 1).focus();
            }
        }

        function onFocusEvent(index) {
            for (item = 1; item < index; item++) {
                const currentElement = getCodeBoxElement(item);
                if (!currentElement.value) {
                    currentElement.focus();
                    break;
                }
            }
        }
        /*** END Cart Button JS ****/
        /*** Start Multi Step js ***/
        var currentTab = 0;
        showTab(currentTab);

        function showTab(n) {
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            if (n == 0) {
                var prevButton1 = document.getElementById("prevBtn1");
                prevButton1.style.display = "none";
            } else {
                document.getElementById("prevBtn1").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn1").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn1").innerHTML = "Next";
            }
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            if ($('#phone').val().length < '11') {
                $("#errorph").text('Phone Digit 11 Required');
                return false;
            }
            var x = document.getElementsByClassName("tab");
            if (n == 1 && !validateForm()) return false;

            x[currentTab].style.display = "none";
            currentTab = currentTab + n;
            var url = window.location.href;
			// alert(url);
            if (url == 'https://orderpak.com/checkout' || 'https://stage.orderpak.com/checkout') {
			// alert('[1]'+url);
                if (currentTab == 2) {
                    $('.user_order').load(location.href + " .user_order");
                    $.ajax({
                        type: "POST",
                        url: '/borderbook/',
                        data: $('#regForm1').serialize(),
                        success: function(msg) {
                            console.log("order-order-success");
                            // window.location.href='/thankyou';
                            // window.location.replace("/thankyou");
                        }
                    });
                }

            }

            if (url != 'https://orderpak.com/checkout' || 'https://stage.orderpak.com/checkout') {
			// alert('[2]'+url);
			
                //   $('.user_order').load(location.href + " .user_order");
                // document.getElementById("regForm1").submit();
                if (currentTab == 2) {
                    console.log("tab 2");// alert('asd');
                    $.ajax({
                        type: "POST",
                        url: '/guest_order_book/',
                        data: $('#regForm1').serialize(),
                        success: function(msg) {
                            console.log("guest-order-success");
                            // window.location.href='/thankyou';
                            // window.location.replace("/thankyou");
                        }
                    });
                }
                // window.location.replace("/thankyou");
                // e.preventDefault(); 


                // return false;
            }

            showTab(currentTab);
        }

        function validateForm() {
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByClassName("input");
            for (i = 0; i < y.length; i++) {
                if (y[i].value == "") {
                    y[i].className += " invalid";
                    valid = false;
                }
            }
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid;
        }

        function fixStepIndicator(n) {
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            x[n].className += " active";
        }
        /*** End Multi Step js ***/
    </script>

    <!--Menu work-->
    <script type="text/javascript">
        jQuery(function($) {

            $(".sidebar-dropdown > a").click(function() {
                $(".sidebar-submenu").slideUp(200);
                if (
                    $(this)
                    .parent()
                    .hasClass("active")
                ) {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                        .parent()
                        .removeClass("active");
                } else {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                        .next(".sidebar-submenu")
                        .slideDown(200);
                    $(this)
                        .parent()
                        .addClass("active");
                }
            });

            $("#close-sidebar").click(function() {
                $(".page-wrapper").removeClass("toggled");
            });
            $("#show-sidebar").click(function() {
                $(".page-wrapper").addClass("toggled");
            });

        });

        $(document).ready(function() {
            hidecontent();

        });

        function hidecontent() {
            var moreText = document.getElementById("moredata");
            var btnText = document.getElementById("myBtn");

            if (moreText.style.display === "none") {
                moreText.style.display = "inline";
                btnText.innerHTML = "Read less";
            } else {
                moreText.style.display = "none";
                btnText.innerHTML = "Read more";
            }
        }
    </script>
</body>

</html>