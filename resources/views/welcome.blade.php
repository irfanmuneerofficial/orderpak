@extends('layouts.master')

<?php
if($content->meta_title){
  $title = $content->meta_title;
}
else{
  $title = 'Online Shopping in Pakistan with Free Home Delivery';
}
if($content->meta_description){
  $desc = $content->meta_description;
}
else{
  $desc = 'OrderPak is the leading Online Marketplace in Pakistan known for delivering memorable shopping experiences. If you are in search of premium quality electronics, home appliances, catering, health & beauty, kids & toys, fashion, and sports products then OrderPak should be your one-stop destination. We are determined to make your life easy for you so that you can live a little better. It’s Pakistan’s first online emporium!!!';
}

?>

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ $title }}" />
    <meta property="og:description"        content="{{ $desc }}" />
    <meta property="og:image"              content="{{ asset('frontend/assets/img/logo_res.png') }}" />
@endsection

@section('twitter_card_meta')
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Home">
	<meta name="twitter:description" content="Home">
	<meta name="twitter:image" content="{{ asset('uploads/home/banner/'. $banner1->banner_img  ) }}">

@endsection

@section('page-title')
Online Shopping Store | Get the Best Deals
@endsection
@section('title')
<?php echo $content->meta_title ?>
@endsection
@section('description')
<?php echo $content->meta_description ?>
@endsection
@section('mainContent')
<!-- START MAIN CONTENT -->
<section>
	<div class="row m-0">
		<div class="col-12 p-0">
			<div id="carouselExampleFade" class="carousel slide carousel-fade order-slider" data-ride="carousel">
				<ol class="carousel-indicators indicators-order">
					@foreach($sliders as $row => $value)
					<li data-target="#carouselExampleFade" data-slide-to="{{$row}}" class="@if($loop->first) active @endif"></li>
					@endforeach
				</ol>
				<div class="carousel-inner order-slider-inner">
					@foreach($sliders as $row)
					<div class="carousel-item order-slide-one  @if($loop->first) active @endif" style="background-color:{{$row->name}};">
						<div class="order-slide-info">
							<div class="container min-con">
								<a href="{{$row->link}}"><img src="http://orderpak.com/uploads/slider/{{$row->slider_img}}" alt="{{$row->title}}"></a>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<div class="container max-con">
		<div class="row">
			<div class="col-12">
				<!-- CATEGORIES MOBILE START -->
				<div class="categories-info">
					<div class="main_nav">
						<strong><i class="fa fa-bars" aria-hidden="true"></i> Categories</strong>
						<div class="main_nav_content">
							<!-- MAIN LINKS START -->
							<ul class="cat_menu">
								<!-- SUB LINKS START -->
								<ul class="cat_menu">
									@foreach($categories as $row)
									<li class="hassubs">
										<a href="/category/{{ $row->slug }}"><img src="http://orderpak.com/uploads/category/{{ $row->category_icon }}" alt="{{ $row->meta_title }}">
											{{\Illuminate\Support\Str::limit(  $row->title, 22, '...')}}
											<?php
                      							// $prow= new App\Models\ParentCategory;
												if($row->childCategories->count() > 0){
													$pcategories = $row->childCategories;
												}
												else{
													$pcategories = [];
												}
											?>
											@foreach($pcategories as $prow)
											<i class="fas fa-chevron-right"></i>
											@endforeach
										</a>
										<ul>
											@foreach($pcategories as $prow)
											<li class="hassubs">
												<a href="/category/{{$row->slug}}/{{ $prow->slug }}">
													{{$prow->title}}
													<?php
														// $crow= new App\Models\ChildCategory;
														if($prow->childCategories->count() > 0){
															$ccategories = $prow->childCategories;
														}
														else{
															$ccategories = [];
														}

													?>
													@foreach($ccategories as $crow)
													<i class="fas fa-chevron-right"></i>
													@endforeach
												</a>
												@foreach($ccategories as $crow)
													<ul>
														<?php $count = 0; ?>
														@foreach($ccategories as $crow)
														<?php $count++; ?>
															@if($count == 15)
															<li>
																<a href="/category/{{$row->slug}}/{{$prow->slug}}/{{$crow->slug}}"></i>
															View More</a>
															</li>
															@break
															@endif
															<li>
																<a href="/category/{{$row->slug}}/{{$prow->slug}}/{{$crow->slug}}"><i class="fas fa-chevron-right"></i>
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
								<!-- SUB LINKS END -->

							</ul>
							<!-- MAIN LINKS END -->
						</div>
					</div>
				</div>
				<!-- CATEGORIES MOBILE END -->
			</div>
		</div>
	</div>
	<!-- TOP SELLING SECTION START -->
	<div class="top-selling">
		<div class="container">
			<div class="selling-info">
				<strong>Top Selling Items</strong>
				<strong>of the week</strong>
				<p>Checkout the trending niches of the year as per your needs!</p>
			</div>
		</div>
  <div class="container max-con">
	<div class="row">

	  @foreach($product_sec1 as $row)
	  <?php
		$category= new App\Models\Categories;
		$categoryc = $category::where('id',$row->category_id)->first();
		?>
		<div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 home-sm">
			<div class="selling-item">
				<a href="/product/{{$row->slug}}" style="text-decoration: none; color:#2C5779;">
				  <div class="product-grid">
					<div class="product-image">
					  <img class="pic-1" src="http://orderpak.com/uploads/product_images/{{$row->image_1}}">
					</div>
					<div class="product-content">
					  <div class="row">
						<div class="col-12">
						  <strong>{{\Illuminate\Support\Str::limit(  $row->title, 15, '...')}}</strong>
						  @if($categoryc)
						  <strong class="home_cat">({{$categoryc->title}})</strong>
						  @endif
						  <div class="row">
							<div class="col-12">
							  <ul>
								<li>
									<a><i class="fa fa-star"></i></a></li>
									<li><a><i class="fa fa-star"></i></a></li>
									<li><a><i class="fa fa-star"></i></a></li>
									<li><a><i class="fa fa-star"></i></a></li>
									<li><a><i class="fa fa-star"></i></a></li>
								</ul>
							</div>
							<div class="col-12">
							@if($row->price)
							@if($row->sale_price > 0)
							<strong class="price">PKR {{number_format($row->sale_price)}}</strong>
								<strong class="princ del-price">PKR <del>{{number_format($row->price)}}</del></strong>
							@else
							<strong class="price">PKR {{number_format($row->price)}}</strong>
							@endif
							@endif
							</div>
							</div>
							<a href="/product/{{$row->slug}}"><button class="btn btn-light">View More</button></a>
							<?php
								$shops= new App\Models\Shopinfo;
								$shopsc = $shops::where('vendor_id',$row->vendor_id)->first();
							?>
							<div class="brand-img">
							    @if($shopsc)
								<img src="http://orderpak.com/uploads/vendor/shop/{{ $shopsc->shop_img }} ">
								@else
								<img src="http://orderpak.com/uploads/no_image.png ">
								@endif
							</div>
						</div>
						</div>
					</div>
				</div>
				</a>
			  </div>
			</div>
		@endforeach
	</div>
	</div>
	</div>
	<!-- TOP SELLING SECTION END -->
	<!-- ELECTRONIC & COMPUTER SECTION START -->
	{{-- @foreach($banners as $row) --}}
	@if ($banner1)
	<?php
	$main= new App\Models\Categories;
	$mainc = $main::where('id',$banner1->category_id)->first();
	?>
	<div class="electronic-main">
		<div class="container max-con">
			<div class="row">
				<div class="col-12">
					<strong class="banner-h">{{$mainc->title}}</strong>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
					<a href="/category/{{$mainc->slug}}">
						<div class="banner-img" style="background-image: url('/uploads/home/banner/<?php echo $banner1->banner_img ?>');">
							<div class="row">
								<div class="col-12">
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="owl-carousel">
						@foreach($product_banner1 as $product)
						<div class="item">
							<div class="selling-item">
							<a href="/product/{{$product->slug}}" style="text-decoration: none; color:#2C5779;">
									<div class="product-grid">
										<div class="product-image">
										 @if($product->image_1)
										   <img class="pic-1" src="http://orderpak.com/uploads/product_images/{{$product->image_1}}">
                                         @else
                                          <img src="http://orderpak.com/uploads/no_image.png">
                                         @endif
										</div>
										<div class="product-content">
											<div class="row">
												<div class="col-12">
													<strong>{{\Illuminate\Support\Str::limit(  $product->title, 15, '...')}}</strong>
													<strong class="home_cat">({{$mainc->title}})</strong>
													<div class="row">
														<div class="col-12">
															<ul>
																<li><a><i class="fa fa-star"></i></a></li>
																<li><a><i class="fa fa-star"></i></a></li>
																<li><a><i class="fa fa-star"></i></a></li>
																<li><a><i class="fa fa-star"></i></a></li>
																<li><a><i class="fa fa-star"></i></a></li>
															</ul>
														</div>
														<div class="col-12">
															@if($product->price)
															@if($product->sale_price > 0)
															<strong class="price">PKR {{number_format($product->sale_price)}}</strong>
															<strong class="del-price">PKR <del>{{number_format($product->price)}}</del></strong>
															@else
															<strong class="price">PKR {{number_format($product->price)}}</strong>
															@endif
															@endif
														</div>
													</div>
													<a href="/product/{{$product->slug}}"><button class="btn btn-light">View More</button></a>
													<?php
														$shopsc = $shops::where('vendor_id',$product->vendor_id)->first();
													?>
													<div class="brand-img">
														@if($shopsc)
                                        				<img src="http://orderpak.com/uploads/vendor/shop/{{ $shopsc->shop_img }} ">
                                        				@else
                                        				<img src="http://orderpak.com/uploads/no_image.png ">
                                        				@endif
													</div>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="shope-btn">
		<a href="/category/{{$mainc->slug}}"><button class="btn btn-light">Shop More</button></a>
	</div>
	@endif
	@if ($banner2)
	<?php
	$main= new App\Models\Categories;
	$mainc = $main::where('id',$banner2->category_id)->first();
	?>
	<div class="electronic-main">
		<div class="container max-con">
			<div class="row">
				<div class="col-12">
					<strong class="banner-h">{{$mainc->title}}</strong>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
					<a href="/category/{{$mainc->slug}}">
						<div class="banner-img" style="background-image: url('/uploads/home/banner/<?php echo $banner2->banner_img ?>');">
							<div class="row">
								<div class="col-12">
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="owl-carousel">
						@foreach($product_banner2 as $product)
							<div class="item">
							<div class="selling-item">
								<a href="/product/{{$product->slug}}" style="text-decoration: none; color:#2C5779;">
									<div class="product-grid">
										<div class="product-image">
										@if($product->image_1)
											<img class="pic-1" src="http://orderpak.com/uploads/product_images/{{$product->image_1}}">
										 @else
                                          <img src="http://orderpak.com/uploads/no_image.png">
                                        @endif
										</div>
										<div class="product-content">
											<div class="row">
												<div class="col-12">
													<strong>{{\Illuminate\Support\Str::limit(  $product->title, 15, '...')}}</strong>
													<strong  class="home_cat">({{$mainc->title}})</strong>
													<div class="row">
														<div class="col-12">
															<ul>
																<li><a><i class="fa fa-star"></i></a></li>
																<li><a><i class="fa fa-star"></i></a></li>
																<li><a><i class="fa fa-star"></i></a></li>
																<li><a><i class="fa fa-star"></i></a></li>
																<li><a><i class="fa fa-star"></i></a></li>
															</ul>
														</div>
														<div class="col-12">
															@if($product->price)
															@if($product->sale_price > 0)
															<strong class="price">PKR {{number_format($product->sale_price)}}</strong>
															<strong class="del-price">PKR <del>{{number_format($product->price)}}</del></strong>
															@else
															<strong class="price">PKR {{number_format($product->price)}}</strong>
															@endif
															@endif
														</div>
													</div>
													<?php
													$brand= new App\Models\Brand;
													$brandc = $brand::where('id',$product->brand_id)->first();
													?>
													<a href="/product/{{$product->slug}}"><button class="btn btn-light">View More</button></a>
													<?php
														$shopsc = $shops::where('vendor_id',$product->vendor_id)->first();
													?>
													<div class="brand-img">
													    @if($shopsc)
                                        				<img src="http://orderpak.com/uploads/vendor/shop/{{ $shopsc->shop_img }} ">
                                        				@else
                                        				<img src="http://orderpak.com/uploads/no_image.png ">
                                        				@endif
													</div>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="shope-btn">
		<a href="/category/{{$mainc->slug}}"><button class="btn btn-light">Shop More</button></a>
	</div>
	@endif

	@if ($banner3)
	<?php
	$main= new App\Models\Categories;
	$mainc = $main::where('id',$banner3->category_id)->first();
	?>
	<div class="electronic-main">
		<div class="container max-con">
			<div class="row">
				<div class="col-12">
					<strong class="banner-h">{{$mainc->title}}</strong>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
					<a href="/category/{{$mainc->slug}}">
						<div class="banner-img" style="background-image: url('/uploads/home/banner/<?php echo $banner3->banner_img ?>');">
							<div class="row">
								<div class="col-12">
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="owl-carousel">
						@foreach($product_banner3 as $product)
							<div class="item">
							<div class="selling-item">
								<a href="/product/{{$product->slug}}" style="text-decoration: none; color:#2C5779;">
									<div class="product-grid">
										<div class="product-image">
										@if($product->image_1)
											<img class="pic-1" src="http://orderpak.com/uploads/product_images/{{$product->image_1}}">
										 @else
                                          <img src="http://orderpak.com/uploads/no_image.png">
                                        @endif
										</div>
										<div class="product-content">
											<div class="row">
												<div class="col-12">
													<strong>{{\Illuminate\Support\Str::limit(  $product->title, 15, '...')}}</strong>
													<div class="row">
														<div class="col-12">
															<ul>
																<li><a><i class="fa fa-star"></i></a></li>
																<li><a><i class="fa fa-star"></i></a></li>
																<li><a><i class="fa fa-star"></i></a></li>
																<li><a><i class="fa fa-star"></i></a></li>
																<li><a><i class="fa fa-star"></i></a></li>
															</ul>
														</div>
														<div class="col-12">
															@if($product->price)
															@if($product->sale_price > 0)
															<strong class="price">PKR {{number_format($product->sale_price)}}</strong>
															<strong class="del-price">PKR <del>{{$product->price}}</del></strong>
															@else
															<strong>PKR {{number_format($product->price)}}</strong>
															@endif
															@endif
														</div>
													</div>
													<?php
													$brand= new App\Models\Brand;
													$brandc = $brand::where('id',$product->brand_id)->first();
													?>
													<a href="/product/{{$product->slug}}"><button class="btn btn-light">View More</button></a>
													<?php
														$shopsc = $shops::where('vendor_id',$product->vendor_id)->first();
													?>
													<div class="brand-img">
													    @if($shopsc)
                                        				<img src="http://orderpak.com/uploads/vendor/shop/{{ $shopsc->shop_img }} ">
                                        				@else
                                        				<img src="http://orderpak.com/uploads/no_image.png ">
                                        				@endif
													</div>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="shope-btn">
		<a href="/category/{{$mainc->slug}}"><button class="btn btn-light">Shop More</button></a>
	</div>
	@endif
	<!-- BEST SELLER START -->
	<div class="seller-main">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="seller-info">
						<strong>Best Seller Brands</strong>
					</div>
				</div>
			</div>
		</div>
		<div class="container max-con">
			<div class="row">
				<div class="col-12">
					<div class="carousel-wrap">
						<div class="owl-carousel carouselowl">
							@foreach($brands as $brand)
							<div class="item">
								<div class="seller-logo">
									<a href="{{$brand->link}}"><img src="http://orderpak.com/uploads/brand/{{$brand->brand_img}}" alt="{{$brand->title}}"></a>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- BEST SELLER END -->

	<!-- SEO CONTENT START -->
	<div class="electronic-main">
	  <div class="row">
	  	<div class="col-2">
	  	</div>
				<div class="col-8">

                   @if (!empty(trim(strip_tags($content->title))))
                  {!! $content->title !!}
                     <span id="moredata" >
                     {!! $content->description !!}
                   </span>

                    @if (!empty(trim(strip_tags($content->description))))
                        <div class="shope-btn">
                            <button onclick="hidecontent()" id="myBtn"  class="btn btn-light">Read More</button>
                        </div>
                    @endif
                  @endif

				</div>
				<div class="col-2">
	  	     </div>
	  </div>
</div>
	<!-- SEO CONTENT END -->


</section>
<!-- END MAIN CONTENT -->
@endsection
