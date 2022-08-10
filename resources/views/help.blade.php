@extends('layouts.master')

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Online Shopping in Pakistan with Free Home Delivery" />
    <meta property="og:description"        content="OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!" />
    <meta property="og:image"              content="{{ asset('frontend/assets/img/logo_res.png') }}" />
@endsection

@section('twitter_card_meta')
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Help">
	<meta name="twitter:description" content="Help">
	<meta name="twitter:image" content="">
	<meta name="twitter:url" content="{{url()->current()}}" />
@endsection

@section('page-title')
Help
@endsection

@section('help-inside')

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList",
  "name" : "Help",
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
      "name": "Help"
    }
  }]
}
</script>
@endsection

@section('mainContent')
<section>
    <div class="container">
        <div class="faq-heading">
            <h1>Help</h1>
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
                    <span itemprop="name">Help</span>
                    <meta itemprop="position" content="2" />
                </li>
            </ol>
        </nav>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="faq-menu">
                    <ul>
                        <li><a href="#first" class="faq-template-link">01.&nbsp;GENERAL QUESTIONS</a></li>
                        <hr>
                        <li><a href="#second" class="faq-template-link">02.&nbsp;PAYMENT</a></li>
                        <hr>
                        <li><a href="#third" class="faq-template-link">03.&nbsp;SHIPPING</a></li>
                        <hr>
                        <li><a href="#forth" class="faq-template-link">04.&nbsp;RETURNS</a></li>
                        <hr>
                        <li><a href="#fifth" class="faq-template-link">05.&nbsp;OTHER QUESTIONS</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div id="first" class="faq-info">
                    <h2>1. General questions</h2>
                    <hr>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>What is the status of my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>Can I change my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>Where do you ship?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>How long does it take to ship my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="second" class="faq-info">
                    <h2>2. Payment</h2>
                    <hr>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>What is the status of my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>Can I change my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>Where do you ship?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>How long does it take to ship my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="third" class="faq-info">
                    <h2>3. Shipping</h2>
                    <hr>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>What is the status of my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>Can I change my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>Where do you ship?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>How long does it take to ship my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="forth" class="faq-info">
                    <h2>4. Returns</h2>
                    <hr>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>What is the status of my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>Can I change my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>Where do you ship?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>How long does it take to ship my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="fifth" class="faq-info">
                    <h2>5. Outher Questions</h2>
                    <hr>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>What is the status of my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>Can I change my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>Where do you ship?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="faq-content">
                        <ul id="accordion">
                            <li>
                                <h4>How long does it take to ship my order?<span class="plusminus">+</span></h4>
                                <ul>
                                    <li>
                                        <p>Once you have placed your order, we will send you a confirmation email to
                                            track the
                                            status of your order.
                                        <p> Once your order is shipped we will send you another email to confirm you
                                            the
                                            expected delivery date as well as the link to track your order (when the
                                            delivery
                                            method allows it).</p>
                                        <p> Additionally, you can track the status of your order from your "order
                                            history"
                                            section on your account page on the website.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection