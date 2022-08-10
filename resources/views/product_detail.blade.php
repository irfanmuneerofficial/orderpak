@extends('layouts.master')
<?php 
if($product->image_1){
  $img = asset('uploads/product_images/'. $product->image_1);
}else{
  $img =  asset('frontend/assets/img/logo_res.png');
}

$product_price = $product->price ?? 0;
$produc_sale_price = $product->sale_price ?? 0;

$pcslug = '';
if(isset($product->categoryname->slug)){
  $pcslug = $product->categoryname->slug;
}

$ppcslug = '';
if(isset($product->parentcategory->slug)){
  $ppcslug = $product->parentcategory->slug;
}

$pccslug = '';
if(isset($product->childcategory->slug)){
  $pccslug = $product->childcategory->slug;
}
?>

<!-- @section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ $product->title }}  in Pakistan, OrderPak" />
    <meta property="og:description"        content="Buy best {{ $product->short_description }}  online at OrderPak.com. {{ $product->short_description }}  price in Pakistan." />
    <meta property="og:image"              content="{{ $img }}" />
@endsection

@section('twitter_card_meta')
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="{{ $product->title }}  in Pakistan, OrderPak">
  <meta name="twitter:description" content="Buy best {{ $product->short_description }}  online at OrderPak.com. {{ $product->short_description }}  price in Pakistan.">
  <meta name="twitter:image" content="{{ asset('uploads/product_images/'. $product->image_1 ) }}">
  <meta name="twitter:url" content="{{url()->current()}}" />
@endsection -->

@section('page-title')
{{$product->title}}
@endsection
@section('title')
{{$product->title}}  in Pakistan, OrderPak
 @endsection
@section('description')
Buy best {{$product->short_description}}  online at OrderPak.com. {{$product->short_description}}  price in Pakistan.
 @endsection
@section('product-inside')
    <?php $ptime = strtotime($product->created_at); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "{{$product->title}}",
  "image": "https://orderpak.com/uploads/product_images/{{$product->image_1}}",
  "description": "{{ $product->short_description }}",
//   "brand": "Local-Brand",
  "gtin8": "10110111",
  "offers": {
    "@type": "AggregateOffer",
    "url": "{{url()->current()}}",
    "priceCurrency": "PKR",
    "lowPrice": "{{number_format($produc_sale_price)}}",
    "highPrice": "{{number_format($product_price)}}",
    "offerCount": "0"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.3",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "130",
    "reviewCount": "1"
  },
  "review": {
    "@type": "Review",
    "name": "Haris Paracha",
    "reviewBody": "I was looking for the same product although price doesn't matter if the product meet your needs",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "4.1",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "{{date('Y M d', $ptime)}}",
    "author": {"@type": "Person", "name": "Person"},
    "publisher": {"@type": "Person", "name": "Haris Paracha"}
  }
}
</script>

<script type="application/ld+json">
<!-- {
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "item": {
      "@id": "{{ url('category', $pcslug) }}",
      "name": "{{ $product->categoryname->title }}"
    }
  },{
    "@type": "ListItem",
    "position": 2,
    "item": {
      "@id": "{{ url('category/'.$pcslug.'/'.$ppcslug) }}",
      "name": "{{ $product->parentcategory->title }}"
    }
  },{
    "@type": "ListItem",
    "position": 3,
    "item": {
      "@id": "{{ url('category/'.$pcslug.'/'.$ppcslug.'/'.$pccslug) }}",
      "name": "{{ $product->childcategory->title ?? '' }}"
      }
    },
    {
    "@type": "ListItem",
    "position": 4,
    "item": {
      "name": "{{ \Illuminate\Support\Str::limit($product->title, 50, '...') }}"
      }
    }] -->

}
</script>
@endsection
@section('mainContent')
<!-- END HEADER -->
<div class="container-fluid max-con">
  <nav aria-label="breadcrumb">
    <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb custom-breadcrumb">
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1">
          <a itemprop="item" href="{{ url('category', $pcslug) }}">
            <span itemprop="name">{{ $product->categoryname->title }}</span>
          </a>
          <meta itemprop="position" content="1" />
        </li>
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1">
          <a itemprop="item" href="{{ url('category/'.$pcslug.'/'.$ppcslug) }}">
            <span itemprop="name">{{ $product->parentcategory->title }}</span>
          </a>
          <meta itemprop="position" content="2" />
        </li>
        @if(!empty($product->child_id))
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1">
          <a itemprop="item" href="{{ url('category/'.$pcslug.'/'.$ppcslug.'/'.$pccslug) }}">
            <span itemprop="name">{{ $product->childcategory->title }}</span>
          </a>
          <meta itemprop="position" content="3" />
        </li>
        @endif
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1 active" aria-current="page">
          <span itemprop="name"> {{ \Illuminate\Support\Str::limit($product->title, 50, '...') }}</span>
          <meta itemprop="position" content="4" />
        </li>
      </ol>
  </nav>
</div>
<div class="container-fluid max-con">
  <div class="row">
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
      <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5">
             <div class="all">
                <div class="slider">
                    <div class="owl-carousel owl-theme one">
                      @if($product->video_url)
                      <?php 
                      $url_components = parse_url($product->video_url);
                      
                      if($url_components['host']=='www.youtube.com')
                      {
                          $video_id = explode("?v=", $product->video_url);
                          $video_id = $video_id[1];
                          $thumbnail="http://img.youtube.com/vi/".$video_id."/sddefault.jpg";                          
                      }else{
                          $thumbnail="{{asset('uploads/product_images').'/'.$product->image_1}}"; 
                      }
                      ?>                        
                          <!--<div class="item-video" data-merge="3"><a class="owl-video" href="https://vimeo.com/35741668"></a></div>-->
                       <div class="item-video" data-merge="1">
                           <a class="owl-video" href="{{$product->video_url}}"></a>
                       </div>
                      @endif                        
                      @if($product->image_1)
                      <div class="item-box zoom ex1" style="cursor: pointer;">
                        <img src="{{ asset('uploads/product_images').'/'.$product->image_1}}" alt="{{$product->title}}">
                      </div>
                      @endif
                      @if($product->video_url)
                      <?php 
                      $video_id = explode("?v=", $product->video_url);
                      $video_id = $video_id[1];
                      $thumbnail="http://img.youtube.com/vi/".$video_id."/sddefault.jpg";
                      ?>                        
                        <div class="item-video" data-merge="1"><a class="owl-video" href="{{ $product->video_url }}"></a></div>
                      @endif 
                      @if($product->image_2)
                      <div class="item-box zoom ex1" style="cursor: pointer;">
                        <img src="{{ asset('uploads/product_images').'/'.$product->image_2}}" alt="{{$product->title}}">
                      </div>
                      @endif
                      @if($product->image_3)
                      <div class="item-box zoom ex1" style="cursor: pointer;">
                        <img src="{{ asset('uploads/product_images').'/'.$product->image_3}}" alt="{{$product->title}}">
                      </div>
                      @endif
                      @if($product->image_4)
                      <div class="item-box zoom ex1" style="cursor: pointer;">
                        <img src="{{ asset('uploads/product_images').'/'.$product->image_4}}" alt="{{$product->title}}">
                      </div>
                      @endif
                      @if($product->image_5)
                      <div class="item-box zoom ex1" style="cursor: pointer;">
                        <img src="{{ asset('uploads/product_images').'/'.$product->image_5}}" alt="{{$product->title}}">
                      </div>
                      @endif
                      @if($product->image_6)
                      <div class="item-box zoom ex1" style="cursor: pointer;">
                        <img src="{{ asset('uploads/product_images').'/'.$product->image_6}}" alt="{{$product->title}}">
                      </div>
                      @endif
                      <div class="item-box zoom2 ex1" id="attr_big_img" style="cursor: pointer;" >
                          <img class='attr_img' id="attr_img2" src="#" alt="{{$product->title}}">
                        </div>
                    </div>
                </div>
                <div class="slider-two">
                    <div class="owl-carousel owl-theme two">
                    @if($product->video_url)
                      <div class="item active">
                          <?php if($url_components['host']=='www.youtube.com'){ 
                          ?>
                          <img src="{{$thumbnail}}" alt="{{$product->title}}"/>
                         <? } 
                          else
                          {
                          ?>
                         <img src="{{ asset('uploads/product_images').'/'.$product->image_1}}" alt="{{$product->title}}"/>
                        <?php
                          }
                        ?>
                      </div>
                    @endif                        
                    @if($product->image_1)
                    <div class="item active">
                    <img src="{{ asset('uploads/product_images').'/'.$product->image_1}}" alt="{{$product->title}}"/>
                    </div>
                    @endif
            @if($product->image_2)
            <div class="item ">
              <img src="{{ asset('uploads/product_images').'/'.$product->image_2}}" alt="{{$product->title}}">
            </div>
            @endif
            @if($product->image_3)
            <div class="item ">
              <img src="{{ asset('uploads/product_images').'/'.$product->image_3}}" alt="{{$product->title}}"/>
            </div>
            @endif
            @if($product->image_4)
            <div class="item ">
              <img src="{{ asset('uploads/product_images').'/'.$product->image_4}}" alt="{{$product->title}}">
            </div>
            @endif
            @if($product->image_5)
            <div class="item ">
              <img src="{{ asset('uploads/product_images').'/'.$product->image_5}}" alt="{{$product->title}}"/>
            </div>
            @endif
            @if($product->image_6)
            <div class="item ">
              <img src="{{ asset('uploads/product_images').'/'.$product->image_6}}" alt="{{$product->title}}">
            </div>
            @endif
            <div class="item active" id="attr_class">
              <img class='attr_img' id="attr_img21" src="{{ asset('uploads/product_images').'/default-thumb.png'}}" alt="{{$product->title}}">
            </div>
            </div>
            <div class="left-t nonl-t">
              <i class="fas fa-angle-left"></i>
            </div>
            <div class="right-t">
              <i class="fas fa-angle-right"></i>
            </div>
            </div>
        </div>             
        </div>
        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7">
          <div class="product-inside-info">
            <h1 class="product-title">{{$product->title}}</h1>
            <p class="condition-p">Condition : <span>{{$product->condition}}</span></p>
            <p class="condition-p">Brand : <span>{{$product->brand_id}}</span></p>
            <?php 
            if($product->sale_status ==1)
            {
              $simple_sale_date = explode(" ",$product->sale_details);
              dump($simple_sale_date[0]);
              dump($simple_sale_date[2]);
              $data['start_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $simple_sale_date[0])->format('Y-m-d');
              $data['end_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $simple_sale_date[2])->format('Y-m-d');
              $date11 = \Carbon\Carbon::now();
              $startDate11 = \Carbon\Carbon::parse($data['start_date'].' 00:00:01');
              $sdate11 = $date11->gte($startDate11);
              // dump("START: ".$sdate11);
              $date22 = \Carbon\Carbon::now();
              $endDate22 = \Carbon\Carbon::parse($data['end_date'].' 23:59:58');
              $edate22 = $date22->lte($endDate22);
              dump("END: ".$edate22);
              if(($sdate11 == true)&&($edate22 == true))
              {
                $sale22 ='true';
              }
              else{
                  $sale22 ='false';
              }
              dump($sale22);
            }
            // dump($data);            
//if first item have sale date  available 0
              if($result["product_attr"][$product->id][0]->id > 0)
              {
                if($result["product_attr"][$product->id][0]->attr_sale_start!='' && $result["product_attr"][$product->id][0]->attr_sale_end!='')
                {
                  $date1 = \Carbon\Carbon::now();
                  $startDate = \Carbon\Carbon::parse($result["product_attr"][$product->id][0]->attr_sale_start.' 00:00:01');
                  $sdate = $date1->gte($startDate);
          
                  $date2 = \Carbon\Carbon::now();
                  $endDate = \Carbon\Carbon::parse($result["product_attr"][$product->id][0]->attr_sale_end.' 23:59:58');
                  $edate = $date2->lte($endDate);
                  if(($sdate == true)&&($edate == true))
                  {
                    $sale ='true';
                  }
                  else{
                      $sale ='false';
                  }
                }
              }
            ?>
                    @if($result["product_attr"][$product->id][0]->id >0)
                    <div class="aa-prod-view-size">
                        @php
                          $arrSize=[];
                          $sum_size=0;
                          foreach($result["product_attr"][$product->id] as $attr){
                            $arrSize[$attr->size_id]=$attr->option_code;
                            $sum_size += $attr->size_id;
                          }  
                          $arrSize=array_unique($arrSize);
                        @endphp
                        <?php //print_r($arrSize); 
                        // $num_array = array(1,2,3,4,0,0);
                        ?>
                        @if(!array_key_exists("0",$arrSize))
                        <p class="size-p">Size :
                          <select id="selectsize" class="color-select" onchange="showColor(this.value)">
                            <option value="">Select</option>
                            @foreach($arrSize as $key => $attr)  
                              @if($attr!='')
                                  <option value="{{str_replace('.','dot',str_replace(' ','',$attr))}}">{{str_replace(' ','',$attr)}}</option>
                              @endif  
                            @endforeach 
                          </select>
                        </p>
                        @endif                        
                    </div>
                      <input type="hidden" name="have_size"  id="have_size" value='{{$sum_size}}'>
                    @else
                      <input type="hidden" name="have_size" id="have_size" value='0'>
                    @endif
                    @if($result["product_attr"][$product->id][0]->id>0)
                      <div class="aa-color-tag">
                      <p class="color-p product_color"><span  id="color-p">Color : </span><span id="color_name"></span></p>
                      @php
                          $sum_color=0;
                      @endphp
                      <?php //dd($result["product_attr"][$product->id]); ?>
                        @if($result["product_attr"][$product->id][0]->id >0)
                        @foreach($result["product_attr"][$product->id] as $key => $attr)  
                          @if($attr->title!='')
                            <!-- <a href="javascript:void(0)" id="selectcolor" class="aa-color-{{str_replace(' ','',strtolower($attr->title))}} product_color size_{{str_replace('.','dot',str_replace(' ','',$attr->option_code))}}"  onclick=change_product_color_image("{{$attr->color_id}}","{{str_replace(' ','',strtolower($attr->title))}}","{{$product->id}}","{{$attr->attr_id}}","{{asset('uploads/product_images/'.$attr->attr_image)}}")></a>                       -->
                            <a href="javascript:void(0)" id="selectcolor" style="background-color:{{$attr->color_code}}" class=" product_color size_{{str_replace('.','dot',str_replace(' ','',$attr->option_code))}}" onclick=change_product_color_image("{{$attr->color_id}}","{{str_replace(' ','',strtolower($attr->title))}}","{{$product->id}}","{{$attr->attr_id}}","{{asset('uploads/product_images/'.$attr->attr_image)}}")></a>                                                  
                            <?php $sum_color += $attr->color_id; ?>
                          @endif  
                        @endforeach  
                        @endif
                      </div>
                      <input type="hidden" name="have_color" id="have_color" value='{{$sum_color}}'>
                    @else
                      <input type="hidden" name="have_color" id="have_color" value='0'>
                    @endif  
            @if($product->warrenty_period)
            <p class="warranty-p">Warranty :<span> {{$product->warrenty_period}}</span></p>
            @endif
            @if($product->short_description)
            <p class="waranty-para"><span class="description">Description : </span> <span class="description-p">{{ $product->short_description }}</span></p>
            @endif
          </div>
          <div class="product-info m-0 p-0">
            @if($product->systematic_sku)
            <p class="sku-p"><span class="sku-span text-uppercase">SKU : </span><span class="info-code info-code1 text-uppercase attr_sku_p">{{$product->systematic_sku}}</span></p>
            @else
            <p class="sku-p"><span class="sku-span text-uppercase">SKU : </span><span class="info-code info-code1 text-uppercase">{{$product->vendor_id}}-{{$product->category_id}}-{{$product->product_sku}}</span></p>
            @endif

            @if($result["product_attr"][$product->id][0]->id> 0)
              <p class="avaibility-p"><span class="avaibility-span">Availability : </span><span class="info-code info-code1" id="avail_stock">In Stock</span><span id="instock_qty">(1)</span>
            @elseif($product->quantity > 0)
            <p class="avaibility-p"><span class="avaibility-span">Availability : </span><span class="info-code info-code1">In Stock</span><span id="instock_qty"> ({{$product->quantity}})</span>
            <!-- <p class="avaibility-p"><span class="avaibility-span">Availability : </span><span class="info-code info-code1">In Stock</span> ({{$product->quantity}})  -->
              {{-- <?php $sum_tot_Price = 0 ?>
              @foreach($OrderBook as $order)
              <?php $sum_tot_Price += $order->quantity ?>
              @endforeach
              ({{$product->quantity - $sum_tot_Price }})  --}}
            </p>
            @else
            <p class="avaibility-p"><span class="avaibility-span">Availability : </span><span class="info-code info-code1">Out of stock</span></p>
            @endif
            
            
            <p class="tags-p">
              @if(sizeof(json_decode($product->tagss))>1)
                <span class="tages-span">Tags : </span>
                @if(!empty(json_decode($product->tagss)))
                @foreach(json_decode($product->tagss) as $tags)
                <span class="info-code info-code1"> {{ $tags }},</span>
                @endforeach
                @else
                @foreach($product->tags as $tag)
                <span class="info-code info-code1"> {{ $tag->name }},</span>
                @endforeach
                @endif
              @endif
            </p>  
          </div>
          <div class="product-price1">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
              @if($result["product_attr"][$product->id][0]->id > 0)
              <p id="sale_price" class="price-info price-info1">Sale Price : <span class="price__sec-1 price__sec-2">{{$product->productAttribute[0]->sale_price}}</span></p>
               <p class="price-info price-info1">Price : <span id="price__sec-1" class="price__sec-1 ">{{$product->productAttribute[0]->price}}</span></p>
               @elseif($product->price)
                @if($product->sale_price > 0 && $sale22 =='true')
                <p class="price-info price-info1">Sale Price : <span class="price__sec-1 price__sec-2">PKR {{number_format($product->sale_price)}}</span></p>
                <p class="price-info price-info1">Price : <span class="price__sec price__sec-2"> PKR {{number_format($product->price)}}</span> </p>
                @else
                <p class="price-info price-info1">Price : <span  class="price__sec-1 price__sec-2">PKR {{number_format($product->price)}}</span></p>
                @endif
              @endif
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                &nbsp;
              </p>
            </div>
          </div>
        </div>
       <div id="add_to_cart_msg" class="container"></div>
        <div class="product-cart-section">
          <div class="row">
              <div class="col-4 padding_cart">
                <div class="quantity12">
                 <!-- {{ dump("---1---") }} -->
                @if($result["product_attr"][$product->id][0]->id> 0)
                  <input readonly="" type="number" step="0" onkeypress="return isNumeric(this.value)" onchange="return isNumeric(this.value)"id="quantity" oninput="maxLengthCheck(this)" min="1" max="{{$product->productAttribute[0]->quantity}}" value="1" class="number11">
                 @elseif($product->quantity > 0)
                  <input readonly="" type="number" step="0" onkeypress="return isNumeric(this.value)" onchange="return isNumeric(this.value)"id="quantity" oninput="maxLengthCheck(this)" min="1" max="{{$product->quantity}}" value="1" class="number11">
                  @else
                  <input readonly="" type="number"  id="quantity" min="0" max="0" value="0" class="number11" disabled="">
                  @endif
                </div>
              </div>
              <div class="col-5 padding_carts">
                <div class="cart-btn">
                  @if (Auth()->check())
                  <span id="pid" name="{{$product->id}}"></span>
                  <span id="uid" name="{{Auth::user()->id}}"></span>
                  <!-- {{ dump("---2---") }} -->
                  @if($result["product_attr"][$product->id][0]->id> 0)
                    <a href="javascript::void(0)" id="addcart" onclick=cart_check("{{$product->id}}",this.id)>
                      <button type="button" @if($product->admin_status == 'PENDING') disabled="" @endif class="btn btn-light">Add To Cart</button>
                    </a>
                  @elseif($product->quantity > 0)
                        <a href="javascript::void(0)" id="addcart" onclick=cart_check("{{$product->id}}",this.id)><button type="button" @if($product->admin_status == 'PENDING') disabled="" @endif class="btn btn-light">Add To Cart</button></a>
                  @else
                        <a href="javascript::void(0)" id="addcart"><button @if($product->admin_status == 'PENDING') disabled="" @endif ) type="button" class="btn btn-light" disabled="">Add To Cart</button></a>
                  @endif
                  @elseif(Auth::guard('vendor')->check())
                  <span id="pid" name="{{$product->id}}"></span>
                  <span id="uid" name="{{ Auth::guard('vendor')->user()->id }}"></span>
                  <button type="button" class="btn btn-light">Add To Cart Disable</button><br>
                  <span class="alert-login">Please Login As a User</span>
                  @else
                  <!-- {{ dump("---3---") }} -->
                  @if($result["product_attr"][$product->id][0]->id > 0)
                  <span id="pid" name="{{$product->id}}"></span>
                  <a href="javascript::void(0)" id="addcartCheckout" onclick=cart_check("{{$product->id}}",this.id)><button type="button" @if($product->admin_status == 'PENDING') disabled="" @endif class="btn btn-light">Add To Cart</button></a>
                  @elseif($product->quantity > 0)
                  <span id="pid" name="{{$product->id}}"></span>
                  <a href="javascript::void(0)" id="addcartCheckout" onclick=cart_check("{{$product->id}}",this.id)><button type="button" @if($product->admin_status == 'PENDING') disabled="" @endif class="btn btn-light">Add To Cart</button></a>
                  @else
                  <a href="" id="addcartCheckout"><button @if($product->admin_status == 'PENDING') disabled="" @endif ) type="button" class="btn btn-light" disabled="">Add To Cart</button></a>
                  @endif
                  <!-- {{ dump("---4---") }} -->
                  @if($result["product_attr"][$product->id][0]->id > 0)
                  <a href="javascript::void(0)" id="buynow_link" onclick=cart_check("{{$product->id}}",this.id)><button @if($product->admin_status == 'PENDING') disabled="" @endif type="button" class="btn btn-light">Buy Now</button></a>
                  @elseif($product->quantity > 0)
                  <a href="javascript::void(0)" id="buynow_link" onclick=cart_check("{{$product->id}}",this.id)><button @if($product->admin_status == 'PENDING') disabled="" @endif type="button" class="btn btn-light">Buy Now</button></a>
                  @else
                  <a href="javascript::void(0)" id="buynow_link"><button type="button" @if($product->admin_status == 'PENDING') disabled="" @endif class="btn btn-light" disabled="">Buy Now</button></a>
                  @endif
                  <!-- {{ dump("---5---") }} -->

                  <div class="modal fade" id="modal-id">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-body">
                              <div class="image text-center">
                                <a href="/"><img src="/frontend/assets/img/Logo.png" class="logo" alt=""></a>
                              </div>
                              <div id="message" class="alert alert-danger" hidden>
                                These credentials do not match our records!
                              </div>
                              <form id="login-form" method="post" action="javascript:void(0)" onsubmit="return LoginUser()" method="post" class="login-form">
                                @csrf
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="custom-icon"><i class="fa fa-user"></i></span>
                                  </div>
                                  <input type="email" name="email" id="email" class="form-control" placeholder="User name Or email" required>
                                </div>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="custom-icon"><i class="fa fa-lock"></i></span>
                                  </div>
                                  <input class="form-control py-2 border-right-0 border" type="password" name="password" id="password" placeholder="Password" required>
                                  <!--<span class="input-group-append">-->
                                  <!--  <div class="custom-icon eye-icon"><i class="fas fa-eye" id="eye"></i></div>-->
                                  <!--</span>-->
                                </div>
                                
                                <div class="checkbox-main">
                                  <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                      <div class="checkbox">
                                        <a href="/user/register">Register</a>
                                      
                                      </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 text-right">
                                      <div class="login-sucess">
                                        <button type="submit" class="btn btn-success">Login</button>
                                        <button type="button" class="btn btn-default close-default" data-dismiss="modal">Close</button>
                                      </div>
                                      <!--<div class="login-btn">-->
                                      <!--  <button type="submit" class="btn btn-success">Login</button>-->
                                      <!--</div>-->
                                    </div>
                                  </div>
                                </div>              
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                  @endif

                  @if($result["product_attr"][$product->id][0]->id > 0)
                  <input type="hidden" name="attr_id" id="attr_id" value="">
                  <input type="hidden" name="color_id" id="color_id" value="">
                  <input type="hidden" name="size_id" id="size_id" value="">
                  <input type="hidden" name="attr_pd" id="attr_pd" value="{{count($result["product_attr"][$product->id])}}">
                  <input type="hidden" name="first_price" id="first_price" value="{{ $product->productAttribute[0]->price }}">                                    
                  <input type="hidden" name="first_sale_price" id="first_sale_price" value="{{ $product->productAttribute[0]->attr_sale_price }}">                                    
                  <input type="hidden" name="first_sale_date" id="first_sale_date" value="{{  isset($sale) ? $sale : '' }}">                                                      
                  @endif
                </div>
              </div>
              @if (Auth()->check())
              <?php
              $wishlist = new App\Models\Wishlist;
              $wp = $wishlist::where('product_id',$product->id)->where('user_id',Auth::user()->id)->first();
              ?>
              @if($wp)
              <div class="wrapper">
                <div class="in-wishlist" @if($product->admin_status == 'PENDING') disabled="" @endif id="{{$product->id}}" onclick="unwishlist()"></div>
              </div>
              @else
              <div class="wrapper">
                <div class="icon-wishlist" @if($product->admin_status == 'PENDING') disabled="" @endif id="{{$product->id}}" onclick="wishlist()"></div>
              </div>
              @endif
              @elseif(Auth::guard('vendor')->check())
              @else
              <div class="wrapper">
                <div data-toggle="modal" href='#modal-id' class="icon-wishlist11"></div>
              </div>
              <style type="text/css">
              .icon-wishlist11 {
              cursor: pointer;
              width: 35px;
              height: 30px;
              opacity: 1;
              background: url(/frontend/assets/img/Icon_awesome-heart.png) no-repeat;
              z-index: 100;
              position: relative;
              }
              </style>
              <div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                      <div class="image text-center">
                        <a href="/"><img src="/frontend/assets/img/Logo.png" class="logo" alt=""></a>
                      </div>
                      <form id="login-form" method="post" action="javascript:void(0)" onsubmit="return LoginUser()" method="post" class="login-form">
                        @csrf
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="custom-icon"><i class="fa fa-user"></i></span>
                          </div>
                          <input type="email" name="email" id="email" class="form-control" placeholder="User name Or email" required>
                        </div>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="custom-icon"><i class="fa fa-lock"></i></span>
                          </div>
                          <input class="form-control py-2 border-right-0 border" type="password" name="password" id="password" placeholder="Password" required>
                          <!--<span class="input-group-append">-->
                          <!--  <div class="custom-icon eye-icon"><i class="fas fa-eye" id="eye"></i></div>-->
                          <!--</span>-->
                        </div>
                        
                        <div class="checkbox-main">
                          <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                              <div class="checkbox">
                                <a href="/user/register">Register</a>
                                
                              </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 text-right">
                              <div class="login-btn">
                                <button type="submit" class="btn btn-success">Login</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              @endif
            </div>
        </div>
      </div>
    </div>
    <div id="tabs" class="project-tab container-fluid max-con">
      <div class="row">
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
          <nav class="navtab">
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
              @if($product->product_description)
              <a class="nav-item nav-link nav-link1 active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Description</a>
              @endif
              @if($product->size_chart)
              <a class="nav-item nav-link nav-link1" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Size Guide</a>
              @endif
              @if($product->additional_details)
              <a class="nav-item nav-link nav-link1" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Additional Information</a>
              @endif
              <!--<a class="nav-item nav-link nav-link1" id="nav-desc-tab" data-toggle="tab" href="#nav-desc" role="tab" aria-controls="nav-desc" aria-selected="false">Reviews</a>-->
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <div class="description-section">
                @if($product->product_description)
                {!! $product->product_description !!}
                @endif
              </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                  <!-- <div class="size-guide">
                    <img src="/frontend/assets/img/order-size-guide.png" alt="">
                  </div> -->
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                  <div class="guid-size">
                    @if($product->size_chart)
                    <img src="{{ asset('uploads/product_images').'/'.$product->size_chart }}">
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <div class="add-info">
                @if($product->additional_details)
                <div class="add-info-p">
                  <span>{!! $product->additional_details !!}</span>
                </div>
                @endif
              </div>
            </div>
            <div class="tab-pane fade" id="nav-desc" role="tabpanel" aria-labelledby="nav-desc-tab">
              <div class="review-section">
                <p>3 Review for G-Z peaker ultra Headset</p>
                <div class="row review">
                  <div class="col-2 pr-0">
                    <img src="/frontend/assets/img/avatar.png" alt="Avatar" class="avatar">
                  </div>
                  <div class="col-10">
                    <div class="review-box">
                      <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                          <p>John Doe - <span>February 22, 2018</span></p>
                          <p>Awesome</p>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                          <div class="starrating custom-starrating risingstar d-flex flex-row-reverse">
                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 star"></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 star"></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 star"></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 star"></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"></label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row review">
                  <div class="col-2 pr-0">
                    <img src="/frontend/assets/img/avatar.png" alt="Avatar" class="avatar">
                  </div>
                  <div class="col-10">
                    <div class="review-box">
                      <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                          <p>John Doe - <span>February 22, 2018</span></p>
                          <p>Awesome</p>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                          <div class="starrating custom-starrating risingstar d-flex flex-row-reverse">
                            <input type="radio" id="star6" name="rating" value="5" /><label for="star6" title="5 star"></label>
                            <input type="radio" id="star7" name="rating" value="4" /><label for="star7" title="4 star"></label>
                            <input type="radio" id="star8" name="rating" value="3" /><label for="star8" title="3 star"></label>
                            <input type="radio" id="star9" name="rating" value="2" /><label for="star9" title="2 star"></label>
                            <input type="radio" id="star10" name="rating" value="1" /><label for="star10" title="1 star"></label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row review">
                  <div class="col-2 pr-0">
                    <img src="/frontend/assets/img/avatar.png" alt="Avatar" class="avatar">
                  </div>
                  <div class="col-10">
                    <div class="review-box">
                      <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                          <p>John Doe - <span>February 22, 2018</span></p>
                          <p>Awesome</p>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                          <div class="starrating custom-starrating risingstar d-flex flex-row-reverse">
                            <input type="radio" id="star11" name="rating" value="5" /><label for="star11" title="5 star"></label>
                            <input type="radio" id="star12" name="rating" value="4" /><label for="star12" title="4 star"></label>
                            <input type="radio" id="star13" name="rating" value="3" /><label for="star12" title="3 star"></label>
                            <input type="radio" id="star14" name="rating" value="2" /><label for="star14" title="2 star"></label>
                            <input type="radio" id="star15" name="rating" value="1" /><label for="star15" title="1 star"></label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="comment-section">
                  <p class="review-title">Add a Review</p>
                  <div class="comment-body">
                    <p class="review-rate">Your Rating*</p>
                    <div class="starrating custom-starrating risingstar d-flex flex-row-reverse float-left">
                      <input type="radio" id="star5555" name="rating" value="5" /><label for="star5555" title="5 star"></label>
                      <input type="radio" id="star4444" name="rating" value="4" /><label for="star4444" title="4 star"></label>
                      <input type="radio" id="star3333" name="rating" value="3" /><label for="star3333" title="3 star"></label>
                      <input type="radio" id="star2222" name="rating" value="2" /><label for="star2222" title="2 star"></label>
                      <input type="radio" id="star1111" name="rating" value="1" /><label for="star1111" title="1 star"></label>
                    </div>
                    <br><br>
                    <form class="custom-form">
                      <div class="form-group">
                        <p>Your Review</p>
                        <textarea class="form-control" rows="3"></textarea>
                      </div>
                      <div class="form-group">
                        <p>Name*</p>
                        <input type="text" class="form-control">
                      </div>
                      <div class="form-group">
                        <p>Email*</p>
                        <input type="email" class="form-control">
                      </div>
                      <div class="checkbox">
                        <span><input  type="checkbox" id="vehicle1" name="vehicle1" value="Bike"></span>
                        <span><label for="vehicle1" class="label save"> Save my name, email and website in the browser forthe next time I comment</label></span>
                      </div>
                      
                      <div class="review-btn">
                        <button type="button" class="btn btn-light">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr class="">
        </div>
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-4">
          &nbsp;
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
    <div class="retailers-info">
      <div class="retailer-sec">
        @if($shop)
        <p class="member">Member Since
          <?php $newtime = strtotime($shop->created_at); ?>
          {{date('Y M d', $newtime)}}
        </p>
        <div class="retail-img text-center">
          <img src="https://orderpak.com/uploads/vendor/shop/{{$shop->shop_img}}" alt="{{$shop->shop_name}}">
        </div>
        <div class="retailer-detail">
          <div class="retailers-left">
            <h4>{{$product->vendor->business_name}}</h4>
            <div class="container">
              <div class="starrating risingstar start-rating-info d-flex justify-content-center flex-row-reverse">
                <span class="mt-2 ml-2">(0)</span>
                <input type="radio" id="star-5" name="rating" value="5" /><label for="star-5" title="5 star"></label>
                <input type="radio" id="star-4" name="rating" value="4" /><label for="star-4" title="4 star"></label>
                <input type="radio" id="star-3" name="rating" value="3" /><label for="star-3" title="3 star"></label>
                <input type="radio" id="star-2" name="rating" value="2" /><label for="star-2" title="2 star"></label>
                <input type="radio" id="star-1" name="rating" value="1" /><label for="star-1" title="1 star"></label>
              </div>
              <div class="single-rating1">
                <p><i class="fas fa-check"></i>Positive rating (0)</p>
              </div>
              <div class="single-rating">
                <p><i class="fas fa-times"></i>Negative rating (0)</p>
              </div>
            </div>
          </div>
          <div class="total-sale">
            <p>Total Sales</p>
            <p>
              <?php $count = 0; ?>
              @if($booked)
              @foreach($booked as $order)
              @if($order->status == 'Complete')
              <?php $count++; ?>
              @endif
              @endforeach
              @endif
              <?php echo $count++; ?>
            </p>
            <p>Total Products listed</p>
            <p>{{$totalp}}</p>
          </div>
          <div class="product-btn1 text-center">
            <a href="/shop/{{$product->vendor->slug}}"><button type="button" class="btn btn-light">Visit Shop</button></a>
          </div>
        </div>
        @else
        <div class="retail-img text-center">
          <img src="https://orderpak.com/uploads/no_image.png">
        </div>
        <div class="product-title text-center">
          <div>
            <p>{{$product->vendor->business_name}}</p>
          </div>
          <div class="product-btn1 text-center">
            <a href="/shop/{{$product->vendor->slug}}"><button type="button" class="btn btn-light">Visit Shop</button></a>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
  
</div>
<div class="related-main">
  <div class="container-fluid max-con">
    <h2 class="relate-title">{{$product->title}} Related Products</h2>
    <div class="row">
      <?php
      $vendor = new App\Models\Vendor;
      $vendors = $vendor::where('status','ACTIVE')->get();
      $id = '0';
      ?>
      @foreach($products as $row)
      @foreach($vendors as $vendor)
      @if($vendor->id == $row->vendor_id)
      <?php $id++ ?>
      @if($id > '4')
      @break
      @else
       <a href="/product/{{$row->slug ?? ''}}" style="text-decoration: none; color:#2C5779;" rel="nofollow">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 respon-card">
          <div class="thumbnail card product-grid7 related-product">
            <div class="button-product">
              <div class="img-event product-image7">
                @if($row->image_1)
                  <img class="pic-1 group list-group-image img-fluid" src="{{ asset('uploads/product_images').'/'.$row->image_1 }}" alt="" />
                @else
                  <img src="https://orderpak.com/uploads/no_image.png">
                @endif
                <ul class="social">
                  {{--<li><a href="" class="fa fa-heart"></a></li>
                  <li><a href="/product_inside/{{$row->id}}" class="fa fa-shopping-cart"></a></li>--}}
                </ul>
              </div>
              <div class="caption card-body body-card">
                {{-- <p>({{$category->title}})</p> --}}
                {{-- <hr> --}}
                @foreach($categories as $category)
                @if($row->category_id == $category->id)
                <h4>({{$category->title}})</h4>
                @endif
                @endforeach
                <hr>
                @if($category->childCategory)
                  @foreach($category->childCategory as $pcategory)
                  @if($pcategory->id == $row->parent_id)
                  <p>({{$pcategory->title}})</p>
                  @endif
                  @endforeach
                @endif
                <p class="group card-title inner list-group-item-heading">
                {{\Illuminate\Support\Str::limit(  $row->title, 40, '...')}}
                </p>
                <p class="lead">
                  @if($row->price)
                  @if($row->sale_price > 0)
                  PKR {{number_format($row->sale_price)}}<br><span class="pkr-color">PKR </span><del class="minus-price">{{number_format($row->price)}}</del>
                  @else
                  PKR {{number_format($row->price)}}
                  @endif
                  @endif
                </p>
              </div>
              <div class="product-btn">
                <a class="" href="/product/{{$row->slug ?? ''}}"><button type="button" class="btn btn-info">View More</button></a>
              </div>
            </div>
          </div>
        </div>
      </a>
      @endif
      @endif
      @endforeach
      @endforeach
    </div>
  </div>
</div>
<span id="child_id" class="{{$product->child_id}}"></span>
@if($product->slug)
  <span id="product_slug" class="{{$product->slug}}"></span>
@endif
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
//default hide color box
//---------------------------------------
var color = $("#selectcolor").val();
var size = $("#selectsize").val();
var hv_size = $("#have_size").val();
var hv_color = $("#have_color").val();
$('#attr_class').hide();

// jQuery('#color-p').hide();
// alert(hv_color);
if(hv_size !=0)
{
  jQuery('.aa-color-tag').hide();
}
// jQuery('.price-info1').hide();

var quantity = $('#quantity').val();
var pid = $('#pid').attr('name');
var uid = $('#uid').attr('name');
var vid = {{$product->vendor_id}};

var product_slug = $('#product_slug').attr('class');
var product_child = $('#child_id').attr('class');
var pshipping = $('#pshipping').attr('class');
var cshipping = $('#cshipping').attr('class');
// alert(attr_pd);
/*
var chk_attr_exist = $('#attr_pd').val();
if(chk_attr_exist > 0)
{
  jQuery('.avaibility-span').hide();
  jQuery('.product-price1').hide();
}
*/
if($('#first_sale_price').val()>0)
{
  // $("#sale_price").html($('#first_sale_price').val());         
  // alert($("#first_sale_date").val());
  // if()
  if($("#first_sale_date").val()=='true')
  {
    // $("#sale_price").html("<span class='limit-sec'>Sale Price: PKR "+$('#first_sale_price').val()+'</span>');
    $("#sale_price").html("<span class='price-info price-info1'>Sale Price:</span><span class='price__sec-1 price__sec-2'> PKR "+$('#first_sale_price').val()+'</span>');
    $("#price__sec-1").html("<span class='price__sec price__sec-2'>PKR "+$('#first_price').val()+"</span>");
  }
  else{
    $("#sale_price").hide();          
  }
}
else{
  $("#sale_price").hide();          
}



// var uid = $('#uid')valuee;
//---------------------------------------


$(document).ready(function() {
        var slider = $("#slider");
        var thumb = $("#thumb");
        var slidesPerPage = 4; //globaly define number of elements per page
        var syncedSecondary = true;
        slider.owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: false,
            autoplay: false, 
            dots: false,
            loop: true,
            responsiveRefreshRate: 200
        }).on('changed.owl.carousel', syncPosition);
        thumb
            .on('initialized.owl.carousel', function() {
                thumb.find(".owl-item").eq(0).addClass("current");
            })
            .owlCarousel({
                items: slidesPerPage,
                dots: false,
                nav: true,
                item: 4,
                smartSpeed: 200,
                slideSpeed: 500,
                slideBy: slidesPerPage, 
              navText: ['<i class="fa fa-angle-left nav-pre"></i>', '<i class="fa fa-angle-right nav-next"></i>'],
                responsiveRefreshRate: 100
            }).on('changed.owl.carousel', syncPosition2);
        function syncPosition(el) {
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);
            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }
            thumb
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = thumb.find('.owl-item.active').length - 1;
            var start = thumb.find('.owl-item.active').first().index();
            var end = thumb.find('.owl-item.active').last().index();
            if (current > end) {
                thumb.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                thumb.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }
        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                slider.data('owl.carousel').to(number, 100, true);
            }
        }
        thumb.on("click", ".owl-item", function(e) {
            e.preventDefault();
            var number = $(this).index();
            slider.data('owl.carousel').to(number, 300, true);
        });


            $(".qtyminus").on("click",function(){
                var now = $(".qty").val();
                if ($.isNumeric(now)){
                    if (parseInt(now) -1> 0)
                    { now--;}
                    $(".qty").val(now);
                }
            })            
            $(".qtyplus").on("click",function(){
                var now = $(".qty").val();
                if ($.isNumeric(now)){
                    $(".qty").val(parseInt(now)+1);
                }
            });
    });

function LoginUser(e)
{
$.ajaxSetup({
  headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  });
  var email = $('#email').val();
  var password = $('#password').val();
  var data = {
  email:email,
  password:password
  };
  $.ajax({
  type :"get",
  url:"/login/user",
  data:data,
  cache: false,
  success:function(data)
{
// alert(data.status);
if(data.status == 'success'){
location.reload();
}
else{
$('#message').removeAttr('hidden');
$('#message').html(data.message);
}
},
error:function(data) {
$('#message').html(data.message);
}
});
return false;
}
function change_product_color_image(color_id,color,pid,id,img)
{
    // jQuery('.owl-stage-outer').html('<div class="owl-item active" style="width: 407.5px;"><div class="item-box zoom ex1" style="cursor: pointer; position: relative; overflow: hidden;"><img role="presentation" alt="" src="http://127.0.0.1:8000/uploads/product_images/6f07309c5b50be498c3fa2b25e245d651642142361.jpg" class="zoomImg" style="position: absolute; top: -182.531px; left: -48.5454px; opacity: 1; width: 1154px; height: 1500px; border: none; max-width: none; max-height: none;"></div></div>');
    // jQuery('.owl-stage').html('<div class="owl-item active" style="width: 407.5px;"><div class="item-box zoom ex1" style="cursor: pointer; position: relative; overflow: hidden;"><img src="http://127.0.0.1:8000/uploads/product_images/44815231fbff6ed33bc095af1196c2381642142361.jpeg" alt="Dot Printed Office Wear Gents Dress Semi Formal Shirt for Men"><img role="presentation" alt="" src="http://127.0.0.1:8000/uploads/product_images/44815231fbff6ed33bc095af1196c2381642142361.jpeg" class="zoomImg" style="position: absolute; top: 37.0172px; left: 94.1025px; opacity: 0; width: 189px; height: 267px; border: none; max-width: none; max-height: none;"></div></div>');

      $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    if($('#selectsize').val())
    {
      let text = $('#selectsize').val(); 
      var size =text.replace("dot", ".");
    }
    // var size = $('#selectsize').val();
    var color = color;
    var pid = pid;
    var id = id;
    $.ajax({
        type:'get',
        url:"/product-price",
        data:{size:size ,color:color_id ,pid:pid, id:id},
        success:function(data)
        {
          // alert('ajax Response');
          // alert(color);
          $("#color_name").html(""+color);
          if(data.sale == "true"){
            // alert(data.sale_price);
            $("#sale_price").show();          
            $("#sale_price").html("<span class='price-info price-info1'>Sale Price:</span><span class='price__sec-1 price__sec-2'> PKR "+data.sale_price+'</span>');
            // $("#sale_price").html("<span class='limit-sec'>Sale Price: PKR "+data.sale_price+'</span>');
            $(".price-info1").show();          
            $("#price__sec-1").html("<span class='price__sec price__sec-2'>PKR "+data.price+"</span>");
            // $("#price__sec-1").html("<del>PKR "+data.price+"</del>");
          }
          else{
            // alert(data.sale);
            $("#sale_price").hide();          
            $("#sale_price").html("");
            $(".price-info1").show();          
            $("#price__sec-1").html("PKR "+data.price);
          }
          $("#attr_id").val(id);
          // alert("ATTR-ID: "+id);
          $('#attr_id').val(data.attr_id);
          // alert(data.attr_id);
          $('.attr_sku_p').html(data.attr_sku);
          
          $("#color_id").val(color);          
          if(data.quantity != 0)
          {
          $("#quantity").val(1);
          $("#avail_stock").html("In Stock");          
          $("#instock_qty").html(" "+ data.quantity);
          }
          else{
            $("#avail_stock").html("Out of Stock");          
            $("#quantity").val(data.quantity);
            $("#instock_qty").html(" "+ data.quantity);
          }
          $("#quantity").attr({
          "max" : data.quantity
          });
          jQuery('#add_to_cart_msg').hide();
        }
      });
    // return false;
$('#attr_big_img').trigger('zoom.destroy'); // remove zoom
$('.zoomImg').trigger('zoom.destroy'); // remove zoom

    // return false;
$('#attr_class').show();
$(".attr_img").show();
$(".attr_img").attr("src",img);
var b = $(".item").index(this);
$(".slider .owl-dots .owl-dot").eq(b).trigger('click');
$(".slider-two .item").removeClass("active");
$(this).addClass("active");
$('.zoom2').zoom({
  magnify: 1
});

}

function cart_check(prid,btn_id)
{

//12feb22  alert('[cart-check]-1');
var host_name = $(location).attr('hostname');
var quantity = jQuery('#quantity').val();
var pid = jQuery('#pid').attr('name');
var uid = jQuery('#uid').attr('name');
var attr_id = jQuery('#attr_id').val();
var size_id=jQuery('#selectsize').val();
// var color_id=jQuery('#selectcolor').val();
var color = jQuery("#color_id").val();
var attribute_exist  = jQuery("#attr_pd").val();

if(quantity <= 0)
{
  alert('Out of Stock')
  return false;
}

if( (attribute_exist > 0))
{
  /*
  //12feb22 
  alert('color'+color.length);
  alert('size'+size_id.length);
  alert('have color'+hv_color);
  alert('have size'+hv_size);
*/
  if((size_id=='')&&(hv_size > 0)){
    //12feb22 alert('ATTR [cart-check]-2');
    jQuery('#add_to_cart_msg').html('<div class="alert alert-danger alert-dismissible mt10"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>Please select size</div>');
  }
  else if((color.length == 0) && (hv_color >0)){
    //12feb22 alert('ATTR [Color cart-check]-3');
    jQuery('#add_to_cart_msg').html('<div  class="alert alert-danger fade show alert-dismissible" style="margin-bottom:22px"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>Please select color</div>');
    jQuery('#add_to_cart_msg').show();
    return false;
  }

  // alert('size ID: '+size_id);
  // alert('color ID: '+color);
  // addcart

  if(size_id !='' && color!='')
  {
    //12feb22 alert('ATTR [cart-check]-4');

      if((uid!='')&&(btn_id =='addcart'))
      {
        //12feb22 alert('ATTR addtocart[cart-check]-5');

          // $('#addcart').prop('href', '/addtocart/'+product_slug+'?userid='+uid+'&quantity='+quantity+'&color='+color+'&size='+size+'&aid='+id);
          window.location.href = '/addtocart/'+product_slug+'?userid='+uid+'&quantity='+quantity+'&color='+color+'&size='+size_id+'&aid='+attr_id;

      }
      else if((uid == undefined)&& (btn_id == 'addcartCheckout'))
      {
        //12feb22 alert('ATTR [cart-check]-7');
        //12feb22 alert('addcartCheckout');    
        window.location.href = '/addtocart_guest/'+product_slug+'?quantity='+quantity+'&color='+color+'&size='+size_id+'&aid='+attr_id;
      }
      else if((uid == undefined)&&(btn_id == 'buynow_link'))
      {
        //12feb22 alert('ATTR [cart-check]-8');
        //12feb22 alert('checkoutg');
        window.location.href = '/checkoutg/'+product_slug+'?quantity='+quantity+'&color='+color+'&size='+size_id+'&aid='+attr_id;
      }
  }
  else if((size_id !='' && color =='') || (size_id =='' && color !=''))
    {
        //12feb22 alert('ATTR [cart-check]-9');
        if((uid!='')&&(btn_id =='addcart'))
        {
            //12feb22 alert('ATTR [cart-check]-9');
            //12feb22 alert('addtocart');
            // $('#addcart').prop('href', '/addtocart/'+product_slug+'?userid='+uid+'&quantity='+quantity+'&color='+color+'&size='+size+'&aid='+id);
            window.location.href ='/addtocart/'+product_slug+'?userid='+uid+'&quantity='+quantity+'&color='+color+'&size='+size_id+'&aid='+attr_id;

        }
        else if((uid == undefined)&& (btn_id == 'addcartCheckout'))
        {
          //12feb22 alert('ATTR [cart-check]-10');
          //12feb22 alert('[attribute] addcartCheckout 11');    
          window.location.href = "http://"+$(location).attr('hostname')+'/addtocart_guest/'+product_slug+'?quantity='+quantity+'&color='+color+'&size='+size_id+'&aid='+attr_id;
        }
        else if((uid == undefined)&&(btn_id == 'buynow_link'))
        {
          //12feb22 alert('ATTR [cart-check]-11');
          //12feb22 alert('[attribute] checkoutg 12');
          window.location.href ='/checkoutg/'+product_slug+'?quantity='+quantity+'&color='+color+'&size='+size_id+'&aid='+attr_id;
        }
    }
}
else{
//12feb22  alert('Im out');
  if(uid!=undefined)
  {
    //12feb22 alert('OUT [add cart]-13');
      $('#addcart').prop('href', '/addtocart/'+product_slug+'?userid='+uid+'&quantity='+quantity+'&color='+color+'&size='+size);
  }
 //12feb22  alert('OUT [checkout cart]-14');
      // window.location.href = "http://"+$(location).attr('hostname')+'/addtocart_guest/'+product_slug+'?quantity='+quantity+'&color='+undefined+'&size='+undefined+'&aid='+attr_id;
      $('#addcartCheckout').prop('href', '/addtocart_guest/'+product_slug+'?quantity='+quantity+'&color=undefined'+'&size='+size);
      $('#buynow_link').prop('href', '/checkoutg/'+product_slug+'?quantity='+quantity+'&color='+color+'&size='+size);
}
}


function showColor(size,id){
    // alert('show color');
    // alert("Size"+size);
    jQuery('.aa-color-tag').show();
    // alert($('#have_clr').val());
    $("#color_name").html("");
    $("#instock_qty").html("");
    // $("#price__sec-1").html("");
    $("#sale_price").html("");
    $("#attr_id").val("");
    $("#color_id").val("");
    $("#size_id").val(size);
  //  alert(jQuery('#size_id').val(size).get());
  // alert(size);
  if(!size)
  {
    if($('#first_sale_price').val()>0)
    {
        if($("#first_sale_date").val()=='true')
        {
          $("#sale_price").html("<span class='limit-sec'>Sale Price: PKR "+$('#first_sale_price').val()+'</span>');
          $("#price__sec-1").html('<del>'+$('#first_price').val()+'</del>');
        }
        else{
          $("#sale_price").hide();          
        }      

      // $("#sale_price").html("<span class='limit-sec'>Sale Price: PKR "+$('#first_sale_price').val()+'</span>');
      // $("#price__sec-1").html('<del>'+$('#first_price').val()+'</del>');
    }
  }
  
  


    jQuery('.product_color').hide();
    jQuery('.size_'+size).show();
    jQuery('.size_link').css('border','1px solid #ddd');
    jQuery('#size_'+size).css('border','1px solid black');
    var pid = $('#pid').attr('name');
    var have_val = $('#have_clr').val();
    // alert('HAVE COLOR: '+have_val);
    if(have_val =='0')
    {
      // alert('Im in Color');
      change_product_color_image('','',pid,id,'');
    }
  }

//$('#addcart').prop('href', '/addtocart/'+product_slug+'?userid='+uid+'&quantity='+quantity+'&color='+color+'&size='+size);
//$('#addcartCheckout').prop('href', '/addtocart_guest/'+product_slug+'?quantity='+quantity+'&color='+color+'&size='+size);
//$('#buynow_link').prop('href', '/checkoutg/'+product_slug+'?quantity='+quantity+'&color='+color+'&size='+size);

function maxLengthCheck(object) {
if (object.value.length > object.maxLength)
object.value = object.value.slice(0, object.maxLength)
}

function isNumeric (evt) {
  // alert(evt);
  // $('#addcart').prop('href', '/addtocart/'+product_slug+'?userid='+uid+'&quantity='+evt+'&color='+color+'&size='+size);
  // $('#addcartCheckout').prop('href', '/addtocart_guest/'+product_slug+'?quantity='+evt+'&color='+color+'&size='+size);
  // $('#buynow_link').prop('href', '/checkoutg/'+product_slug+'?quantity='+evt+'&color='+color+'&size='+size);
  if ( !regex.test(evt) ) 
  {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

function colorselect() {
var x = document.getElementById("selectcolor").value;
// alert(x);
  $('#addcart').prop('href', '/addtocart/'+product_slug+'?userid='+uid+'&quantity='+quantity+'&color='+x+'&size='+size);

  $('#addcartCheckout').prop('href', '/addtocart_guest/'+product_slug+'?quantity='+quantity+'&color='+x+'&size='+size);

  $('#buynow_link').prop('href', '/checkoutg/'+product_slug+'?quantity='+evt+'&color='+x+'&size='+size);
}
function sizeselect() {
var x = document.getElementById("selectsize").value;

$('#addcart').prop('href', '/addtocart/'+product_slug+'?userid='+uid+'&quantity='+quantity+'&color='+color+'&size='+x);

$('#addcartCheckout').prop('href', '/addtocart_guest/'+product_slug+'?quantity='+quantity+'&color='+color+'&size='+x);

// ---------------------------------------------

$('#buynow_link').prop('href', '/checkoutg/'+product_slug+'?quantity='+evt+'&color='+color+'&size='+x);

}
function wishlist() {
var id = {{$product->id}};
$.get('/wishlist/'+id,
function( data )
{
$( "div.icon-wishlist" ).replaceWith('<div class="in-wishlist" id="{{$product->id}}" onclick="unwishlist()"></div>');
location.reload();
}
);
}
function unwishlist() {
var id = {{$product->id}};
$.get('/unwishlist/'+id,
function( data )
{
// location.reload();
$( "div.in-wishlist" ).replaceWith('<div class="icon-wishlist" id="{{$product->id}}" onclick="wishlist()"></div>');
location.reload();
// document.getElementById(id).classList.remove('in-wishlist');
// document.getElementById(id).classList.add('icon-wishlist');
}
);
}

$(document).ready(function(){
    $("#buynow").click(function(event){
   event.preventDefault();
  showpopup();
 });
 $("#cancel_button").click(function(){
  hidepopup();
 });
 $("#buynow_link").click(function(){
  hidepopup();
 });
 $("#close_button").click(function(){
  hidepopup();
 });
});


function showpopup()
{
 $("#popup_box").fadeToggle();
 $("#popup_box").css({"visibility":"visible","display":"block"});
}

function hidepopup()
{
 $("#popup_box").fadeToggle();
 $("#popup_box").css({"visibility":"hidden","display":"none"});
}

var changeSlide = 4; 
var slide = changeSlide;
          if ($(window).width() < 600) {
             var slide = changeSlide;
              slide--;
          }
          else if ($(window).width() > 999) {
             var slide = changeSlide;
              slide++;
          }
          else{
           var slide = changeSlide;
          }
  $(document).ready(function() {
      $('.one').owlCarousel({
          nav: true,
          items: 1,
      })
      $('.two').owlCarousel({
          nav: true,
          margin: 10,
          mouseDrag: false,
          touchDrag: false,
          responsive: {
              0: {
                  items: changeSlide - 1,
                  slideBy: changeSlide - 1
              },
              600: {
                  items: changeSlide,
                  slideBy: changeSlide
              },
              1000: {
                  items: changeSlide + 1,
                  slideBy: changeSlide + 1
              }
          }
      })
      var owl = $('.one');
      owl.owlCarousel();
      owl.on('translated.owl.carousel', function(event) {
          $(".right").removeClass("nonr");
          $(".left").removeClass("nonl");
          if ($('.one .owl-next').is(".disabled")) {
              $(".slider .right").addClass("nonr");
          }
          if ($('.one .owl-prev').is(".disabled")) {
              $(".slider .left").addClass("nonl");
          }
          $('.slider-two .item').removeClass("active");
          var c = $(".slider .owl-item.active").index();
          $('.slider-two .item').eq(c).addClass("active");
          var d = Math.ceil((c + 1) / (slide)) - 1;
          $(".slider-two .owl-dots .owl-dot").eq(d).trigger('click');
      })
      $('.right').click(function() {
          $(".slider .owl-next").trigger('click');
      });
      $('.left').click(function() {
          $(".slider .owl-prev").trigger('click');
      });
      $('.slider-two .item').click(function() {
          var b = $(".item").index(this);
          $(".slider .owl-dots .owl-dot").eq(b).trigger('click');
          $(".slider-two .item").removeClass("active");
          $(this).addClass("active");
      });
      var owl2 = $('.two');
      owl2.owlCarousel();
      owl2.on('translated.owl.carousel', function(event) {
          $(".right-t").removeClass("nonr-t");
          $(".left-t").removeClass("nonl-t");
          if ($('.two .owl-next').is(".disabled")) {
              $(".slider-two .right-t").addClass("nonr-t");
          }
          if ($('.two .owl-prev').is(".disabled")) {
              $(".slider-two .left-t").addClass("nonl-t");
          }
      })
      $('.right-t').click(function() {
          $(".slider-two .owl-next").trigger('click');
      });
      $('.left-t').click(function() {
          $(".slider-two .owl-prev").trigger('click');
      });
  });

</script>
 <style>
   /* product detail color */
  .aa-prod-view-size a {
  border: 1px solid #ddd;
  display: inline-block;
  font-size: 14px;
  letter-spacing: 0.5px;
  margin-bottom: 5px;
  margin-right: 8px;
  padding: 5px 10px;
  -webkit-transition: all 0.5s;
  -moz-transition: all 0.5s;
  -ms-transition: all 0.5s;
  -o-transition: all 0.5s;
  transition: all 0.5s;
}
.aa-color-tag {
  display: block;
  width: 100%;
  margin-top: 10px;
}
.aa-color-tag a {
  display: inline-block;
  height: 15px;
 /* margin-bottom: 10px;
   margin-right: 10px; */
  width: 20px;
}
 /*Product Detail Color*/
  .owl-carousel .owl-video-play-icon {
    /* position: absolute;
    height: 180px;
    width: 180px;
    left: 50%;
    top: 50%;
    margin-left: -40px; 
    margin-top: 70px;
    background: url(owl.video.play.png) no-repeat;
    border:5px solid;
    cursor: pointer;
    z-index: 1;
    -webkit-backface-visibility: hidden;
    transition: transform .1s ease; */
  }
  .owl-carousel .item-video {
    height: 300px;
}
</style>
@endsection