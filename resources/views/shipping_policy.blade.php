@extends('layouts.master')

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Online Shopping in Pakistan with Free Home Delivery" />
    <meta property="og:description"        content="OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!" />
    <meta property="og:image"              content="{{ asset('frontend/assets/img/logo_res.png') }}" />
@endsection

@section('twitter_card_meta')
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Shipping Policy">
	<meta name="twitter:description" content="Shipping Policy">
	<meta name="twitter:image" content="">
	<meta name="twitter:url" content="{{url()->current()}}" />
@endsection

@section('page-title')
Shipping Policy
@endsection

@section('shipping-policy-inside')

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList",
  "name" : "Shipping Policy",
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
      "name": "Shipping Policy"
    }
  }]
}
</script>
@endsection

@section('mainContent')
<section>
  <div class="container">
    <div class="privacy-policy">
      <h1>Shipping Policy</h1>
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
          <span itemprop="name">Shipping Policy</span>
          <meta itemprop="position" content="2" />
        </li>
      </ol>
    </nav>
    <div class="privacy-policy">
      <p>BY USING THIS WEBSITE YOU CONFIRM THAT YOU HAVE READ, UNDERSTAND AND AGREE TO COMPLY WITH OUR TERMS OF USE AND
        THE ENTIRE PRIVACY POLICY STATEMENT. TOGETHER, THESE DOCUMENTS CONSTITUTE THE ENTIRE AGREEMENT BETWEEN THE
        PARTIES IN CONNECTION WITH THE USE OF THIS WEBSITE. THE TERMS OF YOUR SPECIFIC USE AND ANY “CONTENT” OR OTHER
        SOFTWARE OR SERVICE AS DEFINED IN THE MERCHANT USER LICENSE AGREEMENT YOU ENTERED INTO WITH orderpak (THE
        “MULA”) ARE GOVERNED BY SUCH MULA. IN THE EVENT OF A CONFLICT BETWEEN THIS PRIVACY POLICY STATEMENT AND THE
        MULA, THE MULA SHALL GOVERN.</p><br>
      <p>Effective date: 01/06/2013</p><br>
      <p>orderpak LLC. d/b/a orderpak (“orderpak”, “we”, “us” or “our”) (“orderpak” or “We”) is committed to
        safeguarding your privacy online.</p><br>
      <p>Please read the following Privacy Policy (“Privacy Policy”) to understand how your User Specific Information
        will be treated, as you make use of this Website. This policy may be amended from time to time, so please check
        it periodically.</p><br>
      <p>As part of the operations of orderpak and its related companies, we gather certain types of information about
        our users through our Website and Web Application. This Privacy Policy explains the types of information
        gathered, and what we do with it.</p>
    </div>
  </div>
</section>
@endsection