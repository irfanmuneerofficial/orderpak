@extends('layouts.master')

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Online Shopping in Pakistan with Free Home Delivery" />
    <meta property="og:description"        content="OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!" />
    <meta property="og:image"              content="{{ asset('frontend/assets/img/logo_res.png') }}" />
@endsection

@section('twitter_card_meta')
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Contact Us">
	<meta name="twitter:description" content="Contact Us">
	<meta name="twitter:image" content="https://www.orderpak.com/uploads/home/banner/202101012424.jpg">
	<meta name="twitter:url" content="{{url()->current()}}/" />
@endsection

@section('page-title')
Contact Us
@endsection

@section('contact-us-inside')

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList",
  "name" : "Contact Us",
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
      "name": "Contact Us"
    }
  }]
}
</script>
@endsection

@section('mainContent')

         <section>
           <div class="container max-con">
             <div class="order-contact">
               <div class="row">
                <div class="col-12">
                  <h1>Contact Us</h1>
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
                    <span itemprop="name">Contact Us</span>
                    <meta itemprop="position" content="2" />
                  </li>
                </ol>
              </nav>
               <div class="row">
                 <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="contact-details">
                   <h3>Karachi</h3>
                   <ul>
                       <li><img src="/frontend/assets/img/home.png"> <span>Office # 105, 1st Floor Asia Pacific Trade Center, Block 19 Gulistan e Johar, Karachi.</span></li>
                       <li><img src="/frontend/assets/img/phone.png"> <span>+92 300 0370646</span></li>
                       <li><img src="/frontend/assets/img/secured_letter.png"> <span>info@orderpak.com</span></li>
                   </ul>
                  </div>
                 </div>
                 <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="contact-details">
                   <h3>Lahore</h3>
                   <ul>
                       <li><img src="assets/img/home.png"> <span>5078 Jensen, Port, wv 73504</span></li>
                       <li><img src="assets/img/phone.png"> <span>+92 333 229 1394</span></li>
                       <li><img src="assets/img/secured_letter.png"> <span>helpdeskkarachi@orderpak.com</span></li>
                   </ul>
                  </div>
                 </div> -->
                 <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="contact-details">
                   <h3>Islamabad</h3>
                   <ul>
                   <li><img src="assets/img/home.png"> <span>5078 Jensen, Port, wv 73504</span></li>
                   <li><img src="assets/img/phone.png"> <span>+92 333 229 1394</span></li>
                   <li><img src="assets/img/secured_letter.png"> <span>helpdeskkarachi@orderpak.com</span></li>
                   </ul>
                  </div>
                 </div>  -->
               </div>
             </div>
           </div>
         </section>
          &nbsp;
         <section>
           <div class="container-fluid">
            <div class="contact-order">
             <div class="row">
               <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="contact-map">
                 <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14474.102037061684!2d67.082216!3d24.91416165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1605510305694!5m2!1sen!2s" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-6">
                 <div class="contact-input">
                  <h2>Get in Touch</h2>
                  @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                        @endif
                  <form method="POST" action="{{ route('contact-form.store') }}/">
                    {{ csrf_field() }}
                      <div class="form-group">
                        <label for="formGroupExampleInput">Name *</label>
                        <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Full Name">
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Email Address *</label>
                        <input type="text" name="email" class="form-control" id="formGroupExampleInput2" placeholder="example@youremail.com">
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                     @endif
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Your Subject *</label>
                        <input type="text" name="subject" class="form-control" id="formGroupExampleInput2" placeholder="Your subject">
                        @if ($errors->has('subject'))
                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Your Message *</label>
                        <textarea type="text" name="message" class="form-control" id="formGroupExampleInput2" placeholder="Write Your Message"></textarea>
                        @if ($errors->has('message'))
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                        @endif
                      </div>
                      <button type="submit" class="btn btn-light">Send Message</button>
                  </form>
                 </div>
               </div>
             </div>
             </div>
           </div>
         </section>

@endsection