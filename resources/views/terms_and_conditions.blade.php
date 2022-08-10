@extends('layouts.master')

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Online Shopping in Pakistan with Free Home Delivery" />
    <meta property="og:description"        content="OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!" />
    <meta property="og:image"              content="{{ asset('frontend/assets/img/logo_res.png') }}" />
@endsection

@section('twitter_card_meta')
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Terms and Conditions">
	<meta name="twitter:description" content="Terms and Conditions for this website of Orderpak.com">
	<meta name="twitter:image" content="">
	<meta name="twitter:url" content="{{url()->current()}}" />
@endsection

@section('page-title')
Terms & Conditions
@endsection

@section('terms-condition-inside')

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList",
  "name" : "Terms and Conditions",
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
      "name": "Terms and Conditions"
    }
  }]
}
</script>
@endsection

@section('mainContent')
<section>
    <div class="container">
        <div class="privacy-policy">
            <h1>Terms and Conditions for this website of Orderpak.com</h1>
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
                    <span itemprop="name">Terms and Conditions</span>
                    <meta itemprop="position" content="2" />
                </li>
            </ol>
        </nav>
        <div class="privacy-policy">
            <p>These Terms and Conditions are applicable every time you access our website and/or place an order. Please
                note
                that these Terms and Conditions include reference to our Returns Policy and our Privacy Policy on our
                website
                which we advise you to read.
                Before proceeding with an order, you will be required to confirm that you agree to the following Terms
                and
                Conditions so we recommend that you print a copy for your future reference.
            </p>
            <p>This website provides general information about Orderpak.com, its subsidiaries and the products and
                services
                they offer on our website. All products are sold on the basis that they are for personal and domestic
                use only.
            </p><br>
            <p>This website provides general information about Orderpak.com, its subsidiaries and the products and
                services
                they offer on our website. All products are sold on the basis that they are for personal and domestic
                use only.
            </p><br>
            <p>The information contained in this website has been prepared entirely and exceptionally for the purpose of
                providing information about Orderpak.com, its Vendors, Wholesalers, Dealers and the services and
                products they
                offer. While Orderpak.com takes reasonable care to provide information which is accurate and up to date
                when it
                is first added on Orderpak's website, it does not undertake to update or correct such information and
                reserves
                the right to change, delete or move any of the material on this website at any time without notice.</p>
            <br>
            <p>Orderpak.com makes no representation or warranty express or implied as to the accuracy or completeness of
                any
                of the information included on this website. Neither Orderpak.com nor any other person or entity accepts
                liability for any loss of whatsoever nature or howsoever caused, arising directly or indirectly from the
                use of
                or reliance upon this website or any of the information it contains.</p>
            <p>To place an order, users are required to provide accurate personal details and in case there are any
                changes to
                be made, re-register it at your earliest. Users are warned not to provide fraudulent details or details
                of other
                person on the behalf of that person. In case of fake order or incorrect information, order will be
                revocated and
                the person would be held liable of penalty.</p>
            <p>If Orderpak.com notice that User is under the 18 years of age, the account will be deactivated
                automatically.
                It is advisable by Orderpak.com to its Users not to share their account details with anyone under any
                conditions.</p>
            <p>Some postal addresses in the different cities and some remote areas in Pakistan may not be covered by our
                delivery services and we may not be able to arrange delivery of some items to such addresses. Either you
                will be
                notified of this when you place your order or you will receive a call from our Customer Service
                Department.</p>
            <p>Whilst we make every effort to deliver goods on the day we specify, we cannot guarantee delivery on that
                day or
                accept liability for deliveries made outside this timescale. This also applies to products sent direct
                from our
                Vendors, Wholesalers, Dealers. We cannot accept liability for out of pocket expenses or other costs
                incurred due
                to failed or delayed deliveries.</p>
            <p>All items are subject to stock availability.</p>
            <p>Data collected through forms become property of Orderpak.com and they hold the right to use it. The
                information
                submitted by the Users may be used to send promotional emails or in case of addition to the Orderpak.com
                Website.</p>
            <p>Orderpak.com reserves all the rights to take action against anyone who intends to disparage or destroy
                Orderpak.com’s reputation or create confusion amongst its Users.</p>
            <p>Orderpak.com holds the right to cancel your order in case a discrepancy is reported any time. You shall
                receive
                a confirmation call from Orderpak.com’s Customer Service department and you may be asked to provide
                further
                information in case of ambiguity.</p>
            <p>We reserve the right to change these terms and conditions from time to time and any such changes will be
                communicated on our website.</p>
            <p>If you have any questions or require further information on any aspect of your account, please email us
                on
                info@orderpak.com or call us on 021-37290073</p>
        </div>
    </div>
</section>
@endsection