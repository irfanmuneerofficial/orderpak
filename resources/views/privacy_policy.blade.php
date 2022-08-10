@extends('layouts.master')

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Online Shopping in Pakistan with Free Home Delivery" />
    <meta property="og:description"        content="OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!" />
    <meta property="og:image"              content="{{ asset('frontend/assets/img/logo_res.png') }}" />
@endsection

@section('twitter_card_meta')
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Orderpak Privacy Policy">
	<meta name="twitter:description" content="Orderpak Privacy Policy">
	<meta name="twitter:image" content="">
	<meta name="twitter:url" content="{{url()->current()}}" />
@endsection

@section('page-title')
Privacy Policy
@endsection

@section('privacy-policy-inside')

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList",
  "name" : "Privacy Policy",
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
      "name": "Privacy Policy"
    }
  }]
}
</script>
@endsection

@section('mainContent')
<section>
    <div class="container">
        <div class="privacy-policy">
            <h1>Orderpak Privacy Policy</h1>
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
                    <span itemprop="name">Privacy Policy</span>
                    <meta itemprop="position" content="2" />
                </li>
            </ol>
        </nav>
        <div class="privacy-policy">
            <p>Welcome to the Orderpak.com (the “Site”). We recognize the importance of privacy and confidentiality of
                personal information and your privacy and data security is our primary concern as we intend to keep your
                personal information safe and secure. To learn more, please read this Privacy Policy. </p>
            <p>This privacy policy sets out the ways in which we collect, use, analyze, utilize and (under certain
                conditions) disclose your personal information. You accept the practices defined in this policy by visit
                the Site directly or through another site. The data protection and your privacy are very important to
                us. We shall therefore only use your personal information (provided by you) which relates to you in the
                manner set out in this Privacy Policy. You will be asked to provide details where it is necessary for us
                to do so and shall not collect/keep irrelevant information.</p>
            <p>The Site will keep your personal information no longer than required by law or as is relevant for the
                purposes for which it was acquired in the first place.</p>
            <p>However, while browsing this Site you are not required to provide your personal details. During browsing
                or visit the site you can stay anonymous and at no time we can identify you until or unless you login
                your account with your credentials. </p><br>
            <h2>Data That We Collect</h2><br>
            <p>We may collect personal information or details when you seek to place an order with us on the Site. This
                information including, but not limited to, your title, name, gender, date of birth, physical/delivery
                address, email address, home/ mobile phone number, preferred mode of payment, and financial/payment
                details.</p>
            <p>We collect, store and process your data for processing your purchase on the Site. This collected
                information is required in identification and verification in certain circumstances, when you apply for
                after-sales services.</p>
            <p>We will use the information you provide us to process your order(s) and to provide you with the
                information and services offered through our website upon your request. In addition, your provided
                personal information will be used for verifying your account and your financial/payment details to carry
                out financial transactions in connection to payments you make. We will also use the collected data for
                identification of the visitors on our website, their browsing habits and for optimising/customising the
                website as per their exceptional requirement. Moreover, the collected data will be used to improve the
                layout and/or content of the pages of our website.</p>
            <p>We may occasionally provide you with information about our products, services and latest offers and
                promotions which might be useful/helpful to you in placing the order(s). This information will be
                provided to you by email subject to your consent. Further, if you prefer or choose not to receive any
                promotional offers and marketing communications from us, you can opt out any time by clicking on the
                link to unsubscribe, provided at the bottom of emails.</p>
            <p>Your name, address, contact number and other related details may also be passed on to a third party (to
                our courier or supplier) in order to make delivery of the product to you successfully. It is important
                that you provide us accurate personal information and you must keep it up to date and update us about
                any changes.</p>
            <p>The actual details about your order(s) may be stored with us but for security reasons we cannot retrieve
                it directly. However, you have all the rights to access this information by signing in into your account
                on the Site. By logging into your account you can view details of your order(s), your personal
                information, your financial details, and also, the status of the orders that have been completed, those
                which are open and those which are shortly to be dispatched. You undertake to treat your personal access
                data confidentially, and thus you are requested not to share it with unauthorised third parties, unless
                required by the law. The Site cannot assume any liability for misuse of passwords unless this misuse is
                our fault. </p><br>
            <h2>Other Uses of Your Personal Information</h2><br>
            <p>Your personal information may be utilised for opinion and market research by the Site. However, your
                details are completely anonymous during such activities and will only be used for statistical purposes.
                You can choose not to participate in such activities at any time. We do not share your responses/answers
                of surveys or opinion polls with any third party. If you would like to take part in competitions, then
                it is necessary for us to disclose your email address. Moreover, your responses to our surveys are saved
                with us separately from your email address.</p>
            <p>We may also send you other information about the Site, new promotions, our products, our newsletters, our
                partners/affiliates, our other websites, and other information related to your interest. However, if you
                would prefer not to receive such information, please click on the “unsubscribe” link in any email that
                we send to you. We will cease to send you these messages within seven (7) business days after receiving
                your request. Moreover, we may contact you for clarification if your request is unclear.</p>
            <p>We may also anonymise data about users of the Site and use it for different purposes, including
                ascertaining the general location of the users and analysing the activity of the users on Site to
                improve the shopping experience. We may, at times, provide your selected information to publishers,
                however, that anonymised data will not be capable of identifying you personally. </p>
            <h2>Competitions</h2><br>
            <p>We use the data to notify the winners of any competition on the Site and advertise our offers as well.
                You can find more details about the competition (if necessary) will be available in our participation
                terms for the respective competition.</p>
            <h2>Third Parties and Links</h2><br>
            <p>The Site may pass your personal details to other companies in our group. We may also pass your details to
                our vendors, suppliers, partners and affiliates. Your personal information will also be passed to our
                agents and subcontractors to help us in using your data set out in our Privacy Policy. For example, we
                may pass your information/details to the third party for delivering product(s) to you, to help us to
                collect payments from you. The Site may also share your information with third parties for various
                purposes including fraud protection and credit risk reduction. If we sell our business or part of it,
                then we may transfer our databases containing your personal information. The criteria and methodology of
                how we collect, use and disclose your information is described in the Privacy Policy, we will not use
                your information other than what is described in Privacy Policy. We shall NOT sell or disclose your
                personal data to third party without your prior consent, unless required by law or defined in Privacy
                Policy. The Site may contain links and advertising of other websites which may divert you to other
                sites. Please note that we are not responsible for the privacy practices employed by those external
                sites. Moreover, the Site is not liable or responsible about the way those external sites handle your
                data, even if we have provided your information to third party as described in the Privacy Policy.</p>
            <h2>Cookies</h2><br>
            <p>For using this Site, the acceptance of cookies is not a requirement. However, you may use all the
                functions and features of the Site if cookies are enabled in your device. In addition, the use of the
                'basket' functionality on the Site and ordering is only possible with the activation of cookies. Cookies
                are tiny text files which are stored in the internet browser on your computer or device. Cookies can
                also be used to identify your device to our server as unique user when you visit certain pages on the
                Site. It recognises your Internet Protocol address that saves your time while you are on, or want to
                enter, the Site. The Site do not use cookies for targeted ads or obtain your information for purposes
                not described above. You have all the rights to disable cookies in your browser, but it will limit your
                use of this Site as you will not be able to use all the functions and features of the Site. Further, the
                cookies we use are free from viruses and malware. In case you want to learn more about how cookies work
                please visit: https://www.allaboutcookies.org or to find out about removing them from your browser, go
                to https:// www.allaboutcookies.org/manage-cookies/index.html. </p>
            <p>This Site uses uses Google Analytics, a web analytics service offered by Google, Inc. ("Google"). Google
                Analytics uses cookies, which enable us to learn more about how users use the Site. Google Analytics
                uses cookies to collect information about your use of the website (including your IP address) will be
                transmitted to and stored by Google on servers in the United States. Google Analytics collects the
                information for evaluation how you use the Site. Further, the collected information will also be used
                for accumulating report about your activities on the Site. However, cookies can be disabled simply from
                your browser settings, but this may limit your access to the Site. By using this Site, you consent that
                your data will be processed through Google in a manner and for the purposes set out above. </p>
            <h2>Security</h2><br>
            <p>To ensure security of your data, the Site employs appropriate technical and latest security measures. Our
                security policies are designed in a way to prevent unlawful or unauthorised access to the data, and to
                evade accidental loss, damage or destruction of your information. Your collected data are stored in our
                secure servers and we use firewalls on our servers. Our strictly security measures mean that we may
                occasionally ask you to provide proof of your identity before we give you an access to your personal
                information. Please note that you are responsible for the security of your device(s) and for protecting
                against unauthorised access to your username, password and other account details. </p>
            <h2>Your Rights</h2><br>
            <p>You will always have access to your personal information as you reserve the right to your information
                with us. You may also request the Site to correct any inaccuracies in your data free of charge. You also
                reserve the right to ask us to stop using your personal information for direct marketing purposes at any
                stage.</p>
        </div>
    </div>
</section>
@endsection