<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'prefix' => 'user',
    'as' => 'api.',
    'middleware' => ['auth:api']
], function () {
    //lists all users
    Route::get('/', 'Api\V1\Customer\CustomerController@allUsers')->name('customers');

    //auth routes
    Route::post('/create/', 'Api\V1\Customer\Auth\AuthController@register')->withoutMiddleware(['auth:api']);
    Route::post('/login/', 'Api\V1\Customer\Auth\AuthController@login')->withoutMiddleware(['auth:api']);
    Route::post('/forgot-password/', 'Api\V1\Customer\Auth\ForgotPasswordController@sendResetEmail')->withoutMiddleware(['auth:api']);
    Route::post('/reset-password/', 'Api\V1\Customer\Auth\ResetPasswordController@updatePassword')->withoutMiddleware(['auth:api']);
    Route::post('/logout/', 'Api\V1\Customer\CustomerController@logout');
    Route::post('/change-password/', 'Api\V1\Customer\Account\AccountController@changePass');
    Route::get('/me/', 'Api\V1\Customer\Account\AccountController@profile');
    Route::post('/me/', 'Api\V1\Customer\Account\AccountController@editProfile');
    Route::get('/order-history/', 'Api\V1\Customer\Account\AccountController@myorders');
    Route::get('/order-history/{orderid}/', 'Api\V1\Customer\Account\AccountController@findOrder');
    Route::get('/wishlist/', 'Api\V1\Customer\Account\AccountController@wishlistview');
    Route::get('/wishlist/{id}/', 'Api\V1\Customer\Account\AccountController@wishlistadd');
    Route::delete('/wishlist/{id}/', 'Api\V1\Customer\Account\AccountController@wishlistremove');
    Route::post('/contact/', 'Api\V1\Customer\WebOperations\WebOperationsController@contact')->withoutMiddleware(['auth:api']);
    Route::post('/subscribe/', 'Api\V1\Customer\WebOperations\WebOperationsController@subscribe')->withoutMiddleware(['auth:api']);
});

Route::group([
    'prefix' => 'cart',
    'as' => 'api.',
], function () {
    Route::post('/create/', 'Api\V1\Customer\Cart\CartController@cartCreate');
    Route::post('/update/', 'Api\V1\Customer\Cart\CartController@updateCart');
    Route::get('/payment-methods/', 'Api\V1\Customer\Cart\CartController@payment_methods');
    Route::get('/pull/', 'Api\V1\Customer\Cart\CartController@cartpull');
    Route::get('/totals/', 'Api\V1\Customer\Cart\CartController@carttotal');
    Route::post('/delete/{id}/', 'Api\V1\Customer\Cart\CartController@cartItemdelete');

    Route::post('/shipping-methods/', 'Api\V1\Customer\Cart\CartController@shipping_methods');

    Route::post('/apply-coupon/', 'Api\V1\Customer\Cart\CartController@apply_coupon');
    Route::post('/delete-coupon/', 'Api\V1\Customer\Cart\CartController@delete_coupon');
    Route::get('/coupon/', 'Api\V1\Customer\Cart\CartController@coupon');
    
    
});

Route::group([
    'prefix' => 'stock',
    'as' => 'api.',
], function () {

    Route::get('/check/{sku}/', 'Api\V1\Customer\Stock\StockController@stock_check');
    
    
});

Route::group([
    'prefix' => 'order',
    'as' => 'api.',
], function () {
    Route::post('/create/', 'Api\V1\Customer\Cart\CartController@orderCreate');
});

Route::group([
    'prefix' => 'elastic',
    'as' => 'api.',
    'middleware' => ['auth:api']
], function () {
    //list of categories parent to child
    Route::get('/product', 'Api\V1\Customer\ElasticSearch\ElasticSearchController@getProduct')->withoutMiddleware(['auth:api']);
    Route::get('/categories', 'Api\V1\Customer\ElasticSearch\ElasticSearchController@getCategories')->withoutMiddleware(['auth:api']);
    Route::get('/attributes', 'Api\V1\Customer\ElasticSearch\ElasticSearchController@getAttributes')->withoutMiddleware(['auth:api']);
});

Route::group([
    'prefix' => 'v1/customer/category',
    'as' => 'api.',
    'middleware' => ['auth:api']
], function () {
    //list of categories parent to child
    Route::get('/', 'Api\V1\Customer\Category\CategoryController@getCategories');
});

// Route::post('v1/greeting/', function () {
//     return 'Hello World';
// });


Route::group([
    'prefix' => 'v1/vendor',
    'as' => 'api.',
    'middleware' => ['auth:apivendor']
], function () {

    Route::post('/registration/', 'Api\V1\Vendor\Auth\RegisterController@register')->withoutMiddleware(['auth:apivendor']);
    Route::post('/login/', 'Api\V1\Vendor\Auth\LoginController@login')->withoutMiddleware(['auth:apivendor']);
    Route::post('/forgot-password/', 'Api\V1\Vendor\Auth\ForgotPasswordController@sendResetEmail')->withoutMiddleware(['auth:apivendor']);
    Route::post('/reset-password/', 'Api\V1\Vendor\Auth\ResetPasswordController@updatePassword')->withoutMiddleware(['auth:apivendor']);
    Route::post('/logout/', 'Api\V1\Vendor\VendorController@logout');
});


Route::group([
    'prefix' => 'v1/product',
    'as' => 'api.',
    'middleware' => ['auth:apivendor']
], function () {
    //list all products
    Route::get('/listproduct', 'Api\V1\Product\ProductController@allProduct');
    // view product by id
    Route::get('/viewproduct/{id}', 'Api\V1\Product\ProductController@findProduct');
    //delete product based on id
    Route::delete('/deleteproduct/{id}/', 'Api\V1\Product\ProductController@deleteProduct');
    // add new product
    Route::post('/addproduct/', 'Api\V1\Product\ProductController@addProduct');
    // add editor image
    Route::post('/addimageeditor/', 'Api\V1\Product\ProductController@addProductImage');
    // edit new product
    Route::post('/editproduct/{id}/', 'Api\V1\Product\ProductController@editProduct');
    //list category
    Route::get('/listcategory', 'Api\V1\Product\ProductController@allCategory');
    //list Subcategory
    Route::get('/listsubcategory/{id}', 'Api\V1\Product\ProductController@SubCategory');
    //list Childcategory
    Route::get('/listchildcategory/{id}', 'Api\V1\Product\ProductController@ChildCategory');
    //list color
    Route::get('/listcolor', 'Api\V1\Product\ProductController@colors');

    // delete editorimage
    Route::get('/deleteimageeditor/{name}/', 'Api\V1\Product\ProductController@removeProductImage');

    Route::get('/bestselling', 'Api\V1\Product\ProductController@bestSellingProducts');

    Route::post('/editproductstatus/{id}/', 'Api\V1\Product\ProductController@editProductStatus');
});

Route::group([
    'prefix' => 'v1/profile',
    'as' => 'api.',
    'middleware' => ['auth:apivendor']
], function () {
    // view profile by id
    Route::get('/viewprofile', 'Api\V1\Vendor\ProfileController@findVendor');

    // edit new product
    Route::put('/editprofile/', 'Api\V1\Vendor\ProfileController@editVendor');

    // edit shop
    Route::post('/editshop/', 'Api\V1\Vendor\ProfileController@editVendorShop');

    // view shop
    Route::get('/viewshop', 'Api\V1\Vendor\ProfileController@findVendorShop');

    // change vendor password
    Route::post('/changePassword/', 'Api\V1\Vendor\ProfileController@changePass');

    // update shop post request -- optional
    Route::post('/updateshop/', 'Api\V1\Vendor\ProfileController@updateVendorShop');
});


Route::group([
    'prefix' => 'v1/commission',
    'as' => 'api.',
    'middleware' => ['auth:apivendor']
], function () {
    // view commission list
    Route::get('/listcommission', 'Api\V1\Commission\CommissionController@commissionList');
});

Route::group([
    'prefix' => 'v1/orders',
    'as' => 'api.',
    'middleware' => ['auth:apivendor']
], function () {
    // view order list
    Route::get('/listorders', 'Api\V1\Orders\OrderController@allOrders');

    // view order
    Route::get('/vieworder/{orderid}', 'Api\V1\Orders\OrderController@findOrder');

    // view invoie
    Route::get('/viewinvoice/{orderid}', 'Api\V1\Orders\OrderController@genereateInvoice');

    // change order status
    Route::post('/changestatus/{orderid}/', 'Api\V1\Orders\OrderController@changestatus');

});

Route::group([
    'prefix' => 'v1/bankinfo',
    'as' => 'api.',
    'middleware' => ['auth:apivendor']
], function () {
    // view bankInfo list
    Route::get('/bankinfo', 'Api\V1\BankInfo\BankInfoController@BankInfoList');

    // create bankInfo
    Route::post('/bankinfo/', 'Api\V1\BankInfo\BankInfoController@createInfo');

    // delete bankInfo
    Route::delete('/bankinfo/{id}/', 'Api\V1\BankInfo\BankInfoController@deleteInfo');

    // update bankInfo
    Route::put('/bankinfo/{id}/', 'Api\V1\BankInfo\BankInfoController@editInfo');

    // request otp
    Route::get('/request_otp', 'Api\V1\BankInfo\BankInfoController@requestOtp');

    // verify otp
    Route::post('/verify_otp/', 'Api\V1\BankInfo\BankInfoController@verifyOtp');
});

Route::group([
    'prefix' => 'v1/wallet',
    'as' => 'api.',
    'middleware' => ['auth:apivendor']
], function () {
    // view wallet list
    Route::get('/walletlist', 'Api\V1\Wallet\WalletController@WalletList');

});

Route::group([
    'prefix' => 'v1/dashboard',
    'as' => 'api.',
    'middleware' => ['auth:apivendor']
], function () {
    // view commission list
    Route::get('/dashboard', 'Api\V1\Dashboard\DashboardController@dashboardNumbers');
});
