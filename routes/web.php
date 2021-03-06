<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShiprocketController;
use App\Http\Controllers\PaytmController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\RatingController;

// for homepage //
Route::get('/redirect', [RedirectController::class,"redirect"])->name('redirect');

Route::get('/track', [ShipController::class,"track"]);
Route::get('/token', [ShipController::class,"generate_token"]);



Route::get('/', [HomeController::class,"index"])->name('homepage');
Route::get('/product/{name}', [HomeController::class,"product"])->name('home.product');

Route::get('/{slug}/write-review/{id}', [RatingController::class,"review"])->name('home.review');
Route::post('/write-review-rating', [RatingController::class,"review_rating"])->name('home.rating.insert');
Route::post('/write-review-rating-update', [RatingController::class,"review_rating_update"])->name('home.rating.update');

// product filter
//Route::get('/{name}', [HomeController::class,"cat_filter"])->name('cat_filter');
Route::post('/test', [ShipController::class,"check"])->name('abc');
Route::get('/category/{name}',[HomeController::class,"filter"])->name('filter');
Route::get('/search',[HomeController::class,"search"])->name('search');

Route::get('/my_orders',[UserController::class,"my_orders"])->name('my.orders');
Route::get('/order_details/{id}',[UserController::class,"order_details"])->name('order.details');

// cart work //
Route::get('/order_placed/{id}',[CartController::class,"order"])->name('order.placed');
Route::get('/cart', [CartController::class,"cart"])->name('cart');
Route::post('/cart/{id}',[CartController::class,"addToCart"])->name('add.to.cart');
Route::post('/cart/minus/{id}',[CartController::class,"minus"])->name('decrease.items');
Route::get('/cart/remove_item/{id}',[CartController::class,"remove_item"])->name('remove.item');

Route::get('/checkout',[CartController::class,"checkout"])->name('checkout');
Route::post('/checkout',[CartController::class,"address"])->name('insert.address');

Route::get('/myorder',[CartController::class,"orders"])->name('order');

Route::get('/payment',[CartController::class,"payment"])->name('payment.view');
Route::post('/payment',[CartController::class,"payment"])->name('payment');

// add coupon
Route::post('/coupon', [CartController::class,"coupon"])->name('coupon');
// remove coupon
Route::get('/coupon/{id}',[CartController::class,"coupon"])->name('coupon.remove');

Route::post('/wishlist', [WishlistController::class,"add"])->name('wishlist');
Route::post('/wishlist_view', [WishlistController::class,"wishlist"])->name('view.wishlist');
Route::post('/wishlist_remove', [WishlistController::class,"remove_wishlist"])->name('remove.wishlist');

// for users


// For admin Pannel //


Route::prefix('admin')->group(function () {

    // Route::get('/login', [AdminController::class,"login"])->name('admin.login.page');
    // Route::post('/login', [AdminController::class,"login"])->name('admin.login');

    Route::get('/download', [ShipController::class,"download_invoice"]);
    
    // Route::middleware(['auth:sanctum','verified','authadmin'])->group(function(){
        

        Route::get('/', [AdminController::class,"index"])->name('admin.dashboard');

        // Route::post('admin/logout',function(){
        //     session()->forget('ADMIN_LOGIN');
        //     session()->forget('ADMIN_ID');
        //     return redirect()->route('admin.login');
        // })->name('admin.logout');

        
        Route::get('/insert',[ProductController::class,"insert"])->name('insert.product.view');
        Route::post('/insert',[ProductController::class,"InsertProduct"])->name('insert.product');

        Route::get('/products',[ProductController::class,"products"])->name('products.view');
        Route::delete('/product/{id}',[ProductController::class,"dropProduct"])->name('product.delete');

        Route::get('/category',[CategoryController::class,"category"])->name('category.view');
        Route::post('/category',[CategoryController::class,"storeCategory"])->name('insert.category');
        Route::delete('/category/{id}',[CategoryController::class,"drop_category"])->name('category.delete');
        Route::post('/category/edit/{id}',[CategoryController::class,"category_edit"])->name('category.edit');


        Route::get('/coupon',[CouponController::class,"coupon"])->name('coupon.view');
        Route::post('/coupon',[CouponController::class,"store_coupon"])->name('insert.coupon');
        Route::delete('/coupon/{id}',[CouponController::class,"drop_coupon"])->name('coupon.delete');
        Route::post('/coupon/status/{id}',[CouponController::class,"coupon_status"])->name('coupon.status');

        Route::get('/orders',[OrderController::class,"orders"])->name('orders.view');
        Route::get('/placed_orders',[OrderController::class,"placed_orders"])->name('orders.placed');
        Route::get('/order_detail/{id}',[OrderController::class,"order_details"])->name('orders.details.view');

        // Settings
        Route::get('/settings',[SettingController::class,"site_settings"])->name('admin.settings');
        Route::post('/site_setting',[SettingController::class,"site_settings"])->name('site.settings.update');

        // shiprocket api 
        Route::post('/check/{id}',[ShipController::class,"check_requirement"])->name('check_requirement');
        Route::post('/cancel/{id}',[ShipController::class,"cancel_order"])->name('cancel_order');

        // ShipRocket API 
        Route::post('/create/{id}',[ShiprocketController::class,"create"])->name('create_order');
        Route::post('/cancel/{id}',[ShiprocketController::class,"cancel_order"])->name('cancel_order');
        Route::post('/generate_awb',[ShiprocketController::class,"generate_awb"])->name('generate_awb');
        Route::get('/track',[ShiprocketController::class,"track"])->name('track');
        Route::get('/check',[ShiprocketController::class,"check"])->name('check');


    // });   

    
});

    Route::get('/initiate',[PaytmController::class,"initiate"])->name('initiate.payment');
    Route::post('/payment',[PaytmController::class,"pay"])->name('make.payment');
    Route::post('/payment/status',[PaytmController::class,"paymentCallback"])->name('status');


    Route::get('payment/{id}',[PaytmController::Class, 'pay'])->name('paytm.payment');
    Route::post('paytm-callback',[PaytmController::Class, 'paytmcallback'])->name('paytm.callback');
    Route::get('payment',[PaytmController::Class, 'paytmPurchase'])->name('paytm.purchase');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
