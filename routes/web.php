<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MidtransController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProdukController::class, 'produk']);


Route::get('/dashboard', [DashboardController::class, 'totalCount'])->name('dashboard')->middleware('auth','admin');

Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('auth','admin');
Route::put('/user/{user}', [UserController::class, 'edit'])->name('user.edit')->middleware('auth','admin');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('auth','admin');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk')->middleware('auth','admin');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store')->middleware('auth','admin');
Route::put('/produk/{produk}', [ProdukController::class, 'edit'])->name('produk.edit')->middleware('auth','admin');
Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy')->middleware('auth','admin');

Route::get('/orders', [OrderController::class, 'index'])->name('orders')->middleware('auth','admin');
Route::get('/orders/{id}', [OrderController::class, 'detail'])->name('ordersDetail')->middleware('auth','admin');
Route::post('/orders/change-status/{id}', [OrderController::class, 'changeOrderStatus'])->name('changeOrderStatus')->middleware('auth','admin');
Route::post('/orders/change-payment/{id}', [OrderController::class, 'changePayment'])->name('changePayment')->middleware('auth','admin');
Route::get('/myorder', [OrderController::class, 'orders'])->name('myorder')->middleware('auth','verified');
Route::get('/myorder_detail/{id}', [OrderController::class, 'myorder_detail'])->name('myorder_detail')->middleware('auth','verified');

Route::get('/cart', [CartController::class, 'cart'])->name('cart')->middleware('auth', 'verified');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart')->middleware('auth', 'verified');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('updateCart')->middleware('auth', 'verified');
Route::post('/delete-item', [CartController::class, 'deleteItem'])->name('deleteItem.cart')->middleware('auth', 'verified');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('auth', 'verified');
Route::get('/thankyou', [CartController::class, 'thankyou'])->name('thankyou')->middleware('auth', 'verified');
Route::post('/process-checkout', [CartController::class, 'processCheckout'])->name('processCheckout')->middleware('auth', 'verified');
Route::post('/process-checkout-transfer', [CartController::class, 'processCheckoutTransfer'])->name('processCheckoutTransfer')->middleware('auth', 'verified');
Route::post('/update-payment-status', [CartController::class, 'updatePaymentStatus'])->name('updatePaymentStatus');


Route::get('/admin', function () {
    return view('admin.admin');
})->name('admin')->middleware('auth','admin');


Route::controller(LoginController::class)->group(function (){
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('check_login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
    Route::get('/auth/google', 'redirectgoogle')->name('googlelogin');
    Route::post('/forgot-password', 'forgotpassword')->name('password.email');
    Route::get('/reset-password/{token}', 'restpwtkn')->name('password.reset');
    Route::post('/reset-password', 'restpw')->name('password.update');
});


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/check_register', [RegisterController::class, 'store']);
Route::get('/auth/google/callback', [RegisterController::class, 'handlergoogle'])->name('googlecallback');
Route::get('/email/verify', [RegisterController::class, 'emailverify'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'verifverify'])->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/{id}', [ProdukController::class, 'detail_produk'])->name('product');



