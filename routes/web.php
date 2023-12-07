<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\ProductpageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserCheckoutController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\MailController;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//------Home routes--------------
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/productdetails/{id}',[HomeController::class,'productdetails'])->name('productdetails');
Route::get('/order/history',[HomeController::class,'orders_history'])->name('orders_history');
Route::get('/order/history/{id}',[HomeController::class,'cancel_order'])->name('cancel_order');

//------Productpage routes--------------
Route::get('/products',[ProductpageController::class, 'products'])->name('products_page');
Route::get('/products/search',[ProductpageController::class, 'products_search'])->name('products_search');

//------login routes--------------
Route::get('/redirect',[AdminController::class,'redirect'])->middleware('auth','verified');

//------category routes--------------
Route::middleware(['auth', 'checkUserType:1'])->group(function () {
    Route::get('/category',[AdminController::class,'view_category'])->name('view_category');
    Route::post('/category/add',[AdminController::class,'add_category'])->name('add_category');
    Route::get('/category/delete/{id}',[AdminController::class,'delete_category'])->name('delete_category');
    Route::get('/category/edit/{id}',[AdminController::class,'edit'])->name('category_edit');
    Route::post('/category/update/{id}',[AdminController::class,'update'])->name('category_update');
});


//------Products routes--------------
Route::middleware(['auth','checkUserType:1'])->group(function (){
    Route::get('/products/view',[ProductController::class,'index'])->name('view_products');
    Route::get('/products/add',[ProductController::class,'add_products'])->name('add_products');
    Route::post('/products/add',[ProductController::class,'product_store'])->name('add_product');
    Route::get('/products/delete/{id}',[ProductController::class,'delete_product'])->name('delete_product');
    Route::get('/products/update/{id}',[ProductController::class,'edit_product'])->name('edit_product');
    Route::post('/products/update/{id}',[ProductController::class,'update_product'])->name('update_product');
});


//------Cart routes--------------

Route::post('/products/add_cart/{id}',[CartController::class,'add_cart'])->name('add_cart');
Route::get('/cart',[CartController::class,'show_cart'])->name('show_cart');
Route::post('/cart',[CartController::class,'updateCart'])->name('updateCart');
Route::get('/cart/delete/{id}',[CartController::class,'cart_delete'])->name('cart_delete');


//------order routes--------------
Route::get('/order',[OrderController::class,'orders'])->name('orders');
Route::get('/order/cash',[OrderController::class,'cash_order'])->name('cash_order');
Route::get('/order/stripe/{totalprice}',[OrderController::class,'stripe_order'])->name('stripe_order');
Route::post('stripe/{totalprice}',[OrderController::class,'stripePost'])->name('stripe.post');
Route::post('/order/update-delivery-status',[OrderController::class,'updateDeliveryStatus'])->name('update.delivery.status');
Route::get('/order/PDF/{id}',[OrderController::class,'order_pdf'])->name('order_pdf');
Route::get('/order/search',[OrderController::class,'search_order'])->name('search_order');
Route::get('/orders/generate/pdf',[OrderController::class,'orders_list_pdf'])->name('orders_list_pdf');
Route::get('/orders/generate/Excel',[OrderController::class,'orders_list_Excel'])->name('orders_list_Excel');



//------Email Routes--------------
Route::get('/email/user/{id}',[AdminController::class,'send_email'])->name('send_email');
Route::post('/email/user/{id}',[AdminController::class,'send_user_email'])->name('send_user_email');


//------Comment Routes--------------
Route::post('/comment',[CommentController::class,'add_comment'])->name('add_comment');


//------Reply Routes--------------
Route::post('/reply',[ReplyController::class,'add_reply'])->name('add_reply');

//------Reply Routes--------------
Route::get('/contact',[ContactController::class,'index'])->name('contact_us');


Route::get('/checkout',[UserCheckoutController::class,'personal_info'])->name('checkout');
Route::post('/checkout',[UserCheckoutController::class,'personal_infoSave'])->name('personal_infoSave');
Route::get('/abondanedcheckouts',[UserCheckoutController::class,'abondanedcheckouts'])->name('abondanedcheckouts');


//------Payment Routes--------------
Route::get('/payment',[PaymentController::class,'index'])->name('payments');

Route::get('/emails', [MailController::class, 'index'])->name('emails');
Route::get('/emails/{folder?}',[MailController::class, 'show'])->name('emails.index');
Route::get('/emails/{id}', [MailController::class, 'show'])->name('emails.show');
Route::get('/emails/{id}/reply',[MailController::class, 'showReplyForm'])->name('emails.reply');
Route::post('/emails/{id}/reply',[MailController::class, 'sendReply'])->name('emails.sendReply');


