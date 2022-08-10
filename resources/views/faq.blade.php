@extends('layouts.master')

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Online Shopping in Pakistan with Free Home Delivery" />
    <meta property="og:description"        content="OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!" />
    <meta property="og:image"              content="{{ asset('frontend/assets/img/logo_res.png') }}" />
@endsection

@section('twitter_card_meta')
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="FAQ'S">
	<meta name="twitter:description" content="FAQ'S">
	<meta name="twitter:url" content="{{url()->current()}}" />
@endsection

@section('page-title')
FAQ's
@endsection

@section('faqs-inside')

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList",
  "name" : "FAQ'S",
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
      "name": "FAQ'S"
    }
  }]
}
</script>
@endsection

@section('mainContent')
<section>
      <div class="container">
        <div class="faq-heading">
          <div class="row">
            <div class="col-12">
              <h1>FAQ'S</h1>
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
                  <span itemprop="name">FAQ'S</span>
                  <meta itemprop="position" content="2" />
               </li>
            </ol>
         </nav>
        </div>
      </div>
    </section>

   <section>
     <div class="container">
       <div class="row">
         <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
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
               <!-- <li><a href="#fifth" class="faq-template-link">05.&nbsp;OTHER QUESTIONS</a></li> -->
            </ul>
          </div>
         </div>
         <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
           <div id="first" class="faq-info">
            <h2>1. General questions</h2>
            <hr>
             <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>What is the status of my order?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>When you have placed your order, we will send you an acknowledgement email that we have received your order and it is under process.</p>
                       <p>Once the order is ready you will receive a call from our customer service department to confirm the delivery date and time.</p></li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>Can I change my order?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>You can call us to cancel your order provided that the order in not dispatched or you want to change it then you need to call the Customer Services Department of Orderpak for the new order.</p></li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                   <li>
                     <h4>How long does it take to ship my order?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>In normal cases, it takes 3-5 business days but sometimes it may take more than it.</p></li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                   <li>
                     <h4>What are the areas where products are delivered by Orderpak?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Orderpak delivers products all over Karachi.</p></li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                   <li>
                     <h4>Do I need an account to shop with Orderpak?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>It is not necessary to have an account to shop with Orderpak, yet as you shop with Orderpak having a registered account, it will give you a faster, safer and convenient shopping experience.</p>
                        	<p>But you can shop as a guest on Orderpak Website.</p>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                   <li>
                     <h4>How will I know if an item in my order is unavailable?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>In case a product is unavailable after the order is placed, you will be informed via call and afterwards, you may order an alternative product or may cancel the order (if any refund will be applicable, it will also be initiated within 24 hours).</p>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                   <li>
                     <h4>Why am I having trouble placing products in the cart?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>If you are having trouble placing products in your cart, please make sure that you have made all relevant selections. If you still have problems, this may also mean that the item you are trying to buy is sold out. Please get in touch with our Customer Support Team for further help in this regard.</p>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                   <li>
                     <h4>My payment was processed successfully but I didn't get any order confirmation. What should I do?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>You can contact us through call or having a chat with our online customer support representatives.</p>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                   <li>
                     <h4>How can I trust that the groceries that will be delivered are quality checked and fresh?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>The groceries delivered are taken from the top brands having a signature of providing quality products and we at Orderpak also ensures the quality and packaging of products before delivering it so that you can get the best produced and finely packaged groceries.</p>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                   <li>
                     <h4>What are the delivery charges?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Delivery charges apply as per the product ordered, its specification, weight, size and dimension.</p>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                   <li>
                     <h4>What about other hidden costs (sales taxes etc)?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>There are no hidden costs in the prices charged.</p>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                   <li>
                     <h4>Can I sign up for Orderpak account?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Yes, you surely can sign up for Orderpak account.</p>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                   <li>
                     <h4>My data will be saved by Orderpak?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Yes, your data will be saved by Orderpak with utmost confidentiality to improve the shopping experience and for repeat order.</p>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                   <li>
                     <h4>Why should I signup on Orderpak?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>By signing up on Orderpak, you can track record of all the orders you place as well as saving yourself to provide personal information repeatedly thus giving a faster and safer experience to shop with Orderpak.</p>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                   <li>
                     <h4>Once signed up, how should I login?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>You should log in through “LOGIN” tab on the top right corner of the website.</p>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <!--<li>
                     <h4>How long does it take to ship my order?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Once you have placed your order, we will send you a confirmation email to track the status of your order.
                       <p> Once your order is shipped we will send you another email to confirm you the expected delivery date as well as the link to track your order (when the delivery method allows it).</p>
                       <p> Additionally, you can track the status of your order from your "order history" section on your account page on the website.</p></li>
                     </ul>
                  </li>-->
               </ul>
            </div>
           </div>
           <div id="second" class="faq-info">
            <h2>2. Payment</h2>
            <hr>
             <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>Are the prices on Orderpak negotiable?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>The prices charged for the product are set to give the best value to you, so negotiation is price deems to be unnecessary.</p>
                       </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>How to pay Orderpak?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>To pay Orderpak, you can avail the following modes of payment:</p>
                       <p>1) Cash on Delivery</p>
                       <p>2) Easy Paisa</p>
                       <p>3) Jazz Cash</p>
                   </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>Do I need to pre-pay for my product when the order is placed?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Pre-payment for order placement is 100% safe and easy. However, Orderpak also offers you the possibility to pay through Cash on Delivery (CoD). With CoD, you can pay in cash to our delivery agent upon receipt of your order.</p>
                       </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>Is there any amount limit for option of Cash on Delivery payment?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>As you order, there is no amount limit to order through cash on delivery option.</p></li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>How can I pay for my order?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>You will pay when the shipment will arrive at your given shipping address.</p>
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
                     <h4>What happens if I’m not available when you deliver?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>We will deliver the products to provided location and in case of your unavailability, it may be handed over to any associated person within your reach to provide you your order and keeping record (name, signature, relation etc) of that person with us. Moreover, we may also reschedule the delivery if you were unavailable at the time of your order delivery.</p>
                       </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>Can I change the delivery address of my order?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Yes, you can change the delivery address of your order.</p>
                       </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>Can I change my delivery slot?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Yes, it can be changed provided the order is not already dispatched.</p>
                       </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>Who will deliver my order?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Our delivery agent will be delivering your order.</p>
                       </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>How will my order be delivered?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Our fleet of vans is maintained to deliver orders.</p>
                       </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>I missed my delivery. What happens now?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>We will reschedule the delivery after contacting you.</p>
                       </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>Will somebody contact me before delivering the package to my location?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Yes, our Customer Services Department will contact you before the order will be delivered to you.</p>
                       </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>What happens if you’re late?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>We value your time and a best shopping experience with Orderpak, so we will be delivering orders timely. The exemption is with the unavoidable and sudden circumstances like traffic congestion or in transit tragedies that may abstain us to be on time, in case we will be late, you will be informed beforehand.</p>
                       </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>What are the days and timings for delivery?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>There are 2 slots of delivery. The orders will be delivered throughout the weekdays except on weekend and public holidays.</p>
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
                     <h4>What should I do if an item that is delivered is defective (Broken, leaking or expired)?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Contact Orderpak at our helpline, through call or even chat online with our customer support representatives available to facilitate you.</p>
                       </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>How can I cancel my order?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>You can call us to cancel your order provided that the order in not dispatched.</p>
                       </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>What if I have any complaint regarding my order?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>You can contact us through call or having a chat with our online customer support representatives.</p>
                       </li>
                     </ul>
                  </li>
               </ul>
            </div>
            <!-- <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>How long does it take to ship my order?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Once you have placed your order, we will send you a confirmation email to track the status of your order.
                       <p> Once your order is shipped we will send you another email to confirm you the expected delivery date as well as the link to track your order (when the delivery method allows it).</p>
                       <p> Additionally, you can track the status of your order from your "order history" section on your account page on the website.</p></li>
                     </ul>
                  </li>
               </ul>
            </div> -->
           </div>
           <!-- <div id="fifth" class="faq-info">
            <h2>5. Other Questions</h2>
            <hr>
             <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>What is the status of my order?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Once you have placed your order, we will send you a confirmation email to track the status of your order.
                       <p> Once your order is shipped we will send you another email to confirm you the expected delivery date as well as the link to track your order (when the delivery method allows it).</p>
                       <p> Additionally, you can track the status of your order from your "order history" section on your account page on the website.</p></li>
                     </ul>
                  </li>
               </ul>
            </div> -->
            <!-- <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>Can I change my order?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Once you have placed your order, we will send you a confirmation email to track the status of your order.
                       <p> Once your order is shipped we will send you another email to confirm you the expected delivery date as well as the link to track your order (when the delivery method allows it).</p>
                       <p> Additionally, you can track the status of your order from your "order history" section on your account page on the website.</p></li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>Where do you ship?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Once you have placed your order, we will send you a confirmation email to track the status of your order.
                       <p> Once your order is shipped we will send you another email to confirm you the expected delivery date as well as the link to track your order (when the delivery method allows it).</p>
                       <p> Additionally, you can track the status of your order from your "order history" section on your account page on the website.</p></li>
                     </ul>
                  </li>
               </ul>
            </div> -->
            <!-- <div class="faq-content">
               <ul id="accordion">
                  <li>
                     <h4>How long does it take to ship my order?<span class="plusminus">+</span></h4>
                     <ul>
                        <li><p>Once you have placed your order, we will send you a confirmation email to track the status of your order.
                       <p> Once your order is shipped we will send you another email to confirm you the expected delivery date as well as the link to track your order (when the delivery method allows it).</p>
                       <p> Additionally, you can track the status of your order from your "order history" section on your account page on the website.</p></li>
                     </ul>
                  </li>
               </ul>
            </div> -->
           </div>
         </div>
       </div>
     </div>
   </section>
@endsection