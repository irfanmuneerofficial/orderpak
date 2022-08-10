@extends('layouts.master')

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Online Shopping in Pakistan with Free Home Delivery" />
    <meta property="og:description"        content="OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!" />
    <meta property="og:image"              content="{{ asset('frontend/assets/img/logo_res.png') }}" />
@endsection

@section('twitter_card_meta')
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Orders and Returns">
	<meta name="twitter:description" content="Orders and Returns">
	<meta name="twitter:image" content="">
	<meta name="twitter:url" content="{{url()->current()}}" />
@endsection

@section('page-title')
Orders & Returns
@endsection

@section('order-returns-inside')

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList",
  "name" : "Orders and Returns",
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
      "name": "Orders and Returns"
    }
  }]
}
</script>
@endsection

@section('mainContent')
<section>
     <div class="container">
          <div class="privacy-policy">
               <h1>Orders and Returns</h1>
          </div>
          <nav aria-label="breadcrumb">
               <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb custom-breadcrumb justify-content-center">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1">
                         <a itemprop="item" href="{{ url('/') }}">
                         <span itemprop="name">Home</span>
                         </a>
                         <meta itemprop="position" content="1" />
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1 active" aria-current="page">
                         <span itemprop="name">Orders and Returns</span>
                         <meta itemprop="position" content="2" />
                    </li>
               </ol>
          </nav>
          <div class="privacy-policy">
               <p>You would have 3 days after the product is delivered to you to inform us that you want to return it.
                    If your product meets the criteria mentioned below for return can be initiated by calling our
                    helpline at <b>021 37290073</b> or send us an email at <b>return@orderpak.com
                    </b></p><br>
               <p>Our Return Policy is very simple you just have to follow the procedures and send us an email at
                    <b>return@orderpak.com</b> to our Customer Services Department with the following detail
                    information.</p><br>
               <p>Order Number/Order ID<br>
                    Order confirmation date<br>
                    Name of the Customer<br>
                    Mode of Payment executed<br>
                    Your Contact Number<br>
               </p><br>
               <p>Please note the following items are restricted to return owing to certain business, health, or hygiene
                    reason.</p><br>
               <p>
                    Sunglasses<br>
                    Watches<br>
                    Cosmetics<br>
                    Vegetable & Fruits<br>
                    Skincare or hair-care products<br>
                    Innerwear or Swimwear<br>
                    Frozen Items<br>
                    Perfumes and Fragrances<br>
                    Custom or Made to Order products<br>
                    Imported on Order products<br>
                    Certain Sale products</p><br>
               <p><b>Returning an item is simple, just follow the steps mentioned below:</b></p>
               <p>
                    Check if your product meets all requirements<br>
                    Call the Orderpak helpline and request a return<br>
                    Send us an email<br>
                    Pack items and attach the invoice<br>
                    Arrange product pick up or drop off<br>
                    Your returned item will be Quality Checked<br>
               </p>
               <p>If validated and Quality Check passes, you will be refunded for the item.</p><br>
               <h3>
                    <center>Warranty Policy</center>
               </h3><br>
               <p>Please be informed that <b>Orderpak.com</b> is completely an E-commerce Online platform to facilitate
                    the buyer and seller therefore <b>Orderpak.com</b> does not offer any product warranties as these
                    are provided by the manufacturers or brands of products. However, our Customer Service Department
                    will assist you in any way possible to figure out how to claim your warranty from the company, or
                    warranty provider.</p><br>
               <p>Warranty claims are subject to the warranty coverage of the item you have purchased, if the product
                    has a warranty from the brand, a warranty card will be included in the packaging. Please follow the
                    following steps to initiate a warranty claim.</p><br>
               <p>
                    If your product is non-functional or broken on arrival, you can call the <b>Orderpak.com</b>
                    helpline at <b>(021) 37290073</b> within 1 day of delivery to initiate an exchange or return of the
                    product.<br>
                    If your product produces a fault post the initial 3 days of delivery but is within warranty
                    timeline, you can call our Customer Service Department and provide the following information from
                    your receipt and warranty card to initiate a warranty claim<br>
                    Order Number<br>
                    Order Date<br>
                    Item Details<br>
                    Warranty Period (on warranty card)<br>
                    Nature of fault<br>
                    To claim warranty directly from the brand, please contact the authorized service centre using the
                    details stated on the warranty card provided with the item.<br>
                    <p><b>Note: We urge you to save the invoice and warranty card together to ease warranty claim
                              process.</b></p>

               </p>
          </div>
     </div>
</section>
@endsection