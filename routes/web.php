<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Vendor\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', 'HomeController@index');
Route::post('/subscribe', 'HomeController@subscribe');
//Sitemap
// Route::get('/sitemap_create', 'SitemapController@unified');
// Route::get('/sitemap_update', 'SitemapController@sitemapUpdate');
// Route::get('/sitemap_add', 'SitemapController@sitemapAdd');
// Route::get('/sitemap_delete', 'SitemapController@sitemapDelete');
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
//Sitemap
	// Admin Panel
	// Route::group(['prefix' => 'admin','name'=>'Admin'], function(){
		// Route::post('/register', 'RegisterController@store');
	// });
		// Route::prefix('admin')->group(function () {
		Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){

			Route::group(['namespace' => 'Auth'], function(){

				//Login Routes
				Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
				Route::post('/login', 'LoginController@login');
				Route::post('/logout', 'LoginController@logout')->name('admin.logout');

				//Forgot Password Routes
				Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
				Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

				//Reset Password Routes
				Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
				Route::post('/password/reset', 'ResetPasswordController@reset')->name('admin.password.update');
			});

			Route::group(['middleware' => 'auth:admin'], function(){

				Route::resource('/dashboard', DashboardController::class);
				
				Route::resource('/headline', HeadlineController::class);
				Route::get('/headlne/remove_img', 'HeadlineController@remove');

				Route::get('/subscribe', 'DashboardController@subscribe');
				Route::get('/users', 'DashboardController@users');
				Route::get('/users/edit/{id}', 'DashboardController@edit');
				Route::post('/users/update/{id}/', 'DashboardController@update');
				Route::post('/users/changepassword/{id}/', 'DashboardController@changepassword');
				Route::delete('/users/delete/{id}','DashboardController@user_delete');

				//01042022
				Route::get('/notify', 'DashboardController@notify_count');
				Route::get('/mark-as-read/{id}', 'DashboardController@markNotification')->name('markNotification');
				Route::get('/notification', 'DashboardController@showNotification');


				// Shipping Charges
				Route::resource('/shipping', 'ShippingController');
				Route::get('/shipping/length/{length}', 'ShippingController@search_by_length');
				Route::get('/getparentcategory', 'ShippingController@getparentcategory');
				
				// Home Page Banner
				Route::resource('/home_banner_one', Home\BannerOneController::class);
				
					// Home Page 
			Route::get('/home_content', 'ContentController@gethome');
					// Get Home  Content
			Route::get('/gethomecontent', 'ContentController@getHomeData');
					// Update  Content
			Route::post('/updatecontent', 'ContentController@update');
			
				// Get Parent Category on product creat
				Route::get('/getparentcategory', 'Home\BannerOneController@getparentcategory');
				Route::get('/getchildcategory', 'Home\BannerOneController@getchildcategory');
				
				// Shipping Charges
				Route::resource('/shipping_charges', 'ShippingController');
				
				//Orders
				Route::get('/orders', 'OrderController@index');
				Route::get('/order/pending', 'OrderController@process');
				Route::get('/order/process', 'OrderController@process');
				Route::get('/order/cancel', 'OrderController@process');
				Route::get('/order/ship', 'OrderController@process');
				Route::get('/order/complete', 'OrderController@process');
				Route::get('/order/show/{id}', 'OrderController@show');
				Route::post('/order/generate/', 'OrderController@generateShipmentMP');
				Route::get('/order/gettrackinginfo/{consignment_number}', 'OrderController@tracking_by_consignmentMP');

				Route::get('/orderr/{id}','OrderController@edit');

				Route::get('/order/edit/{id}','OrderController@edit_order');
				Route::post('/order/update/{id}/','OrderController@update_order');
				

				// Print
				Route::get('/order/print/{id}', 'OrderController@print');
				
			// Change Password
				Route::match(['get', 'post'], '/change_passowrd', 'DashboardController@change_password');
				
				
				//Products
				Route::get('/products', 'DashboardController@products');
				//Latest Products
				Route::get('/product/latest', 'DashboardController@latest');
				//Pending Products
				Route::get('/product/pending', 'DashboardController@pending');
				//Approved Products
				Route::get('/product/approved', 'DashboardController@approved');

				Route::resource('/home_banner_two', Home\BannerTwoController::class);
				Route::resource('/home_banner_three', Home\BannerThreeController::class);
				Route::resource('/home_banner_four', Home\BannerFourController::class);

				Route::resource('/sliders', SliderController::class);
				Route::get('/sliders/{id}/delete','SliderController@destroy');
				
				
				Route::resource('/vendors', VendorController::class);
				Route::get('/showproduct','VendorController@showproduct');
				Route::get('/product_status/{id}','VendorController@product_status');
				Route::get('/vendor_status','VendorController@vendor_status');
				Route::delete('/vendor_delete/{id}','VendorController@vendor_delete');
				Route::get('/vendors/edit/{id}','VendorController@edit');
				Route::post('/vendor/update/{id}/','VendorController@update_vendor');
				Route::post('/vendor/change_password/{id}/','VendorController@change_password');
				Route::post('/vendor/blocked/','VendorController@vendor_blocked');
				Route::get('/vendor/unblock/{id}','VendorController@vendor_unblock_ip');
				Route::get('/blockedips','BlockedIpController@index');
				
				Route::get('/venodrspayout', 'VendorController@venodrspayout');
				Route::get('/venodrspayout/details/{details}', 'VendorController@venodrspayout_detail');
				Route::get('/payment/transfer', 'OrderController@payment_transfer_form');
				Route::post('/payment_transfer', 'OrderController@payment_transfer');
				//24march2022
				Route::get('/payment/order', 'OrderController@order_vendor_list');	
				Route::get('/order/unpaid_list', 'OrderController@unpaid_paymets');				
				Route::get('/order/payment', 'OrderController@paymets');
				Route::delete('/payment/{id}', 'OrderController@payment_delete');
				
				//Active Vendors
				Route::get('/vendor/active','VendorController@vendor_active');
				Route::get('/vendor/deactive','VendorController@vendor_deactive');
				Route::get('/vendor/suspend','VendorController@vendor_suspend');
				
				Route::resource('/colors', ColorController::class);
				Route::get('/color_slug','ColorController@check_slug');


				Route::resource('/category', CategoryController::class);
				Route::get('/main_category_slug', 'CategoryController@check_slug');
				Route::get('/view_category', 'CategoryController@view_category');

				Route::resource('/subcategory', ParentCategoryController::class);
				Route::get('/check_parent_slug','ParentCategoryController@check_slug');
				Route::get('/view_subcategory', 'ParentCategoryController@view_subcategory');

				Route::resource('/childcategory', ChildCategoryController::class);
				Route::get('/check_child_slug','ChildCategoryController@check_slug');
				Route::get('/view_childcategory', 'ChildCategoryController@view_childcategory');


				Route::resource('/colors', ColorController::class);
				Route::resource('/brand', BrandController::class);
				Route::get('/brand_slug','BrandController@brand_slug');
				Route::get('/brandd','BrandController@indexx');

				Route::resource('/commission', CommissionController::class);
				Route::get('/commission/length/{length}', 'CommissionController@search_by_length');
				Route::get('/commission_category', 'CommissionController@get_category_data');
				Route::get('/getsliders', 'SliderController@get_company_data');
				
				// Category banners
				Route::get('/category_banner', 'CategoryController@banner');
				Route::post('/category_banner', 'CategoryController@banner');
				Route::put('/category_banner', 'CategoryController@banner');
				Route::delete('/category_banner', 'CategoryController@banner');

				// Print
				Route::get('/print/order/{id}', 'OrderController@printt');
				
				// Shop banners
				Route::get('/shop_banner', 'ShopController@banner');
				Route::post('/shop_banner', 'ShopController@banner');
				Route::put('/shop_banner', 'ShopController@banner');
				Route::delete('/shop_banner', 'ShopController@banner');

				//Settings
				Route::get('/settings', 'SettingsController@index');
				Route::post('/settings/process', 'SettingsController@process');

				// wishlist
				Route::get('/wishlist', 'WishlistController@index');
				Route::delete('/wishlist/delete/{id}','WishlistController@delete');

				Route::get('/order/addcart_quantity/{product_id}/{order_id}','OrderController@add_cart_quantity');
				Route::get('/order/get_quantity/{id}','OrderController@get_quantity');
				Route::get('/order/subtract_quantity/{product_id}/{order_id}','OrderController@subtract_quantity');
				Route::post('/products/titlekeyword/{id}', 'DashboardController@product_url_change');

				// Roles resource routes index, show, create, store, edit, update, destroy
				Route::resource('/roles', RoleController::class, ['names' => 'admin.roles']);

				// Account setttings profile routes
				Route::get('/profile', 'AccountSettingController@profileShow')->name('admin.profile.show');
				Route::get('/profile/edit', 'AccountSettingController@profileEdit')->name('admin.profile.edit');
				Route::match(['put', 'patch'],'/profile/update', 'AccountSettingController@profileUpdate')->name('admin.profile.update');
				Route::get('/profile/changepassword', 'AccountSettingController@profileChangePassword')->name('admin.profile.changepassword');
				Route::match(['put', 'patch'],'/profile/updatepassword', 'AccountSettingController@profileUpdatePassword')->name('admin.profile.updatepassword');
				
				// Route::get('/categories','CategoriesController@index');
			});
		});
			
	// User Panel
	Route::group(['prefix' => 'user', 'namespace' => 'User'], function(){
		Route::get('/dashboard', 'DashboardController@index');
		
		Route::get('/order/{id}', 'PurchaseItemController@detail');
		Route::get('/purchase_item/Pending', 'PurchaseItemController@pending');
		Route::get('/purchase_item/In Process', 'PurchaseItemController@process');
		Route::get('/purchase_item/Ship', 'PurchaseItemController@ship');
		Route::get('/purchase_item/Cancel', 'PurchaseItemController@cancel');
		Route::get('/purchase_item/Complete', 'PurchaseItemController@complete');
		Route::get('profile','ProfileController@index');
		Route::post('addressbook','ProfileController@addressbook');
		Route::get('editname','ProfileController@editname');
		Route::get('changephone','ProfileController@changephone');
		Route::post('change_phone','ProfileController@change_phone');
		Route::put('addressbook/{addressbook}','ProfileController@addressbookupdate');
		Route::get('addressbookd','ProfileController@delete');
		//wishlist
		Route::get('wishlist','DashboardController@wishlist');
		// Cart
		Route::get('cart_product','PurchaseItemController@cart');

		Route::get('/order/gettrackinginfo/{consignment_number}', 'PurchaseItemController@tracking_by_consignmentMP');
	});

	// Vendor Panel
	Route::group(['prefix' => 'vendor', 'namespace' => 'Vendor'], function(){

		Route::get('/dashboard', 'DashboardController@index');
		Route::resource('/payout', VendorPayoutController::class);
		// Route::resource('/wallet', TransectionController::class);
		Route::get('/wallet', 'TransactionController@wallet');

		Route::resource('/shop', ShopInfoController::class);
		Route::get('/check_slug', 'ShopInfoController@check_slug');
		
        //Orders
        Route::get('/orders', 'OrderController@index');
        Route::get('/order/{id}','OrderController@edit');
        Route::get('/order_show/{id}','OrderController@show_detail');
        Route::get('/order', 'OrderController@process');

		Route::get('/order/gettrackinginfo/{consignment_number}', 'OrderController@tracking_by_consignmentMP');

        
        // Guest Order
		Route::get('/guest_order_book/{id}','GuestCheckoutController@edit');
        
        // Print
        Route::get('/order/print/{id}', 'OrderController@print');
		Route::get('/product/remove_image1/{id}', 'ProductController@remove_image1');
		Route::get('/product/remove_image2/{id}', 'ProductController@remove_image2');
		Route::get('/product/remove_image3/{id}', 'ProductController@remove_image3');
		Route::get('/product/remove_image4/{id}', 'ProductController@remove_image4');
		Route::get('/product/remove_image5/{id}', 'ProductController@remove_image5');
		Route::get('/product/remove_image6/{id}', 'ProductController@remove_image6');

		Route::get('product/images/{id}', 'ProductController@show_images');
	    Route::post('product/images/{id}', 'ProductController@store_images');
	    Route::delete('product/images/{id}', 'ProductController@delete_images');
		Route::resource('product', 'ProductController');
		Route::get('/product_sku','ProductController@checksku');
		Route::get('/colors','ProductController@colors');
		Route::get('/product/product_attr_delete/{paid}/{pid}','ProductController@product_attr_delete');
		//16March2022
		Route::get('/sizes','ProductController@sizes');

		Route::get('/status/{status}','ProductController@status');

		// Approved Product
		Route::get('/product_approved','ProductController@approved');
		Route::get('/product_pending','ProductController@pending');
		Route::get('/product_rejected','ProductController@rejected');

		// Get Parent Category on product creat
		Route::get('/getparentcategory', 'ParentCategoryController@getparentcategory');
		Route::get('/getchildcategory', 'ParentCategoryController@getchildcategory');

		// check sale status ajax
		Route::get('/product/{id}/check_sale_status', 'ProductController@check_sale_status');

		// check size status ajax
		Route::get('/product/{id}/check_size', 'ProductController@check_size');

		// check size status ajax
		Route::get('/product/{id}/check_color', 'ProductController@check_color');
		// 16March 2022 	for attribute status ajax
		Route::get('/changeAttrStatus', 'ProductController@changeAttrStatus');

		// check size status ajax
		Route::get('/product/{id}/check_sale', 'ProductController@check_sale');
        
        Route::get('commission','CommissionController@index');

		// Profile
		Route::get('profile','ProfileController@index');
		Route::get('profile/{id}/edit','ProfileController@edit');
		Route::put('profile/{id}/edit','ProfileController@update');
	});

	
// Login 
// Route::get('/superadmin','Admin\LoginController@index');
// Route::post('/superadmin', 'Admin\LoginController@login');

// Vendor Register
Route::get('/register/check/phone', [App\Http\Controllers\Auth\VendorController::class, 'check_phone']);
Route::get('/register/phone', [App\Http\Controllers\Auth\VendorController::class, 'verify_phone']);
Route::get('/register/check/business_email', [App\Http\Controllers\Auth\VendorController::class,'check_businessmail']);
Route::get('/register/check/business_name', [App\Http\Controllers\Auth\VendorController::class,'check_businessname']);
Route::get('/register/check/business_cnic', [App\Http\Controllers\Auth\VendorController::class,'check_businesscnic']);
Route::get('/vendor/register', [App\Http\Controllers\Auth\VendorController::class, 'index']);
Route::post('/verification', [App\Http\Controllers\Auth\VendorController::class, 'verification']);
Route::post('/register_vendor', [App\Http\Controllers\Auth\VendorController::class, 'register']);
Route::get('get-cities', [App\Http\Controllers\ZoneController::class, 'getCities'])->name('getCities');
Route::get('get-provinces', [App\Http\Controllers\ZoneController::class, 'getProvinces'])->name('getProvinces');

Route::get('/vendor/login', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm']);
Route::post('/vendor/login', [App\Http\Controllers\Auth\LoginController::class,'vendorlogin']);
Route::post('/vendor/logout', [App\Http\Controllers\Auth\VendorController::class,'vendorlogout'])->name('vendor.logout');

// Forgot Vendor
Route::get('/vendor/forget-password', [App\Http\Controllers\Auth\VendorForgotPasswordController::class,'getEmail']);
Route::post('/vendor/forget-password', [App\Http\Controllers\Auth\VendorForgotPasswordController::class,'postEmail']);

Route::get('/vendor/reset-password/{token}', [App\Http\Controllers\Auth\VendorResetPasswordController::class,'getPassword']);
Route::post('vendor/reset-password', [App\Http\Controllers\Auth\VendorResetPasswordController::class,'updatePassword']);
Route::post('change_password/update', 'Vendor\ChangePasswordController@ChangePassword')->name('update.password');


// User
Route::get('/register_user/check/email', [App\Http\Controllers\Auth\UserController::class,'email']);
Route::get('/register_user/check/phone', [App\Http\Controllers\Auth\UserController::class, 'check_phone']);
Route::get('/register_user/phone', [App\Http\Controllers\Auth\UserController::class, 'verify_phone']);
Route::get('/user/logout', [App\Http\Controllers\Auth\UserController::class,'userlogout'])->name('user.logout');
Route::get('/user/register', function () {
    return view('auth.register_user');
});
Route::post('/user_verification', [App\Http\Controllers\Auth\UserController::class, 'verification']);
Route::post('/user/register', [App\Http\Controllers\Auth\UserController::class, 'register']);

Route::get('/user/forgot', function () {
    return view('auth.passwords.email');
});

Route::post('/user/change_password', 'Auth\UserController@store');


//*************************************** FRONT START ***************************************

Route::get('/privacy_policy', 'PrivacyPolicyController@index');
Route::get('/orders_and_returns', 'OrdersAndReturnsController@index');
Route::get('/shipping_policy', 'ShippingPolicyController@index');
Route::get('/terms_and_conditions', 'TermsAndConditionsController@index');
Route::get('/help', 'HelpController@index');
Route::get('/faq', 'FaqController@index');
Route::get('/contact', 'ContactController@index');
Route::get('/blog_detail', 'BlogDetailController@index');
Route::get('/blog', 'BlogController@index');
Route::get('/about', 'AboutController@index');
Route::get('/category', 'CategoryController@index');
// Route::get('/main_category/{id}', 'CategoryController@main_category');
Route::get('/main_category/{main_category}', 'CategoryController@main_category');

Route::get('/category/{main_category}', 'CategoryController@main_category');
Route::get('/category/{main_category}/{parent_category}', 'CategoryController@parent_category');
Route::get('/category/{main_category}/{parent_category}/{child_category}', 'CategoryController@child_category');


Route::get('/parent_category/{id}', 'CategoryController@parent_category');
Route::get('/child_category/{id}', 'CategoryController@child_category');
Route::get('/shop', 'ShopController@index');
Route::get('/shop/{id}', 'ShopController@detail');
Route::get('search', 'SearchController@search')->name('search');
Route::post('/contact-form', [App\Http\Controllers\ContactController::class, 'storeContactForm'])->name('contact-form.store');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Product
Route::get('/product/{null}','ProductController@slug');
Route::get('/product_inside/{null}','ProductController@product_detail');
//16March2022
Route::get('/product-price','ProductController@getprice');
// Wishlist
Route::get('/wishlist/{id}','WishlistController@add');
Route::get('/unwishlist/{id}','WishlistController@delete');
// Add Cart
Route::get('/cart','AddCartController@index');
Route::get('/checkout','AddCartController@checkout');
Route::get('/remove/{id}','AddCartController@remove');
Route::get('/guest_checkout/{id}','GuestCheckoutController@checkout');
Route::get('/checkoutg/{id}','GuestCheckoutController@checkoutg');
Route::post('/guest_order_book','GuestCheckoutController@guest_order_book');
Route::get('/addcart','AddCartController@add');
Route::get('/addtocart/{id}','AddCartController@addtocart');
Route::get('/cart/{id}','AddCartController@delete');
Route::get('/addcart_quantity/{id}','AddCartController@add_cart_quantity');
Route::get('/mincart_quantity/{id}','AddCartController@min_cart_quantity');
Route::post('/borderbook','AddCartController@orderbooked');
Route::get('/login/user','CustomLoginController@LoginUser');

Route::get('/addtocart_guest/{id}','AddCartController@addtocart_guest_new');

Route::get('/order/gettrackinginfo/{consignment_number}', 'GuestOrderTrackingController@tracking_by_consignmentMP');



Route::get('/thankyou', function () {
    return view('thankyou');
});

Route::get('/user-register-thankyou', function () {
    return view('user_register_thankyou');
});

Route::get('/vendor-register-thankyou', function () {
    return view('vendor_register_thankyou');
});