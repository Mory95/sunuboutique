<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers;
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
// 	$prod = DB::table('produits')->get();
// 	// dd($prod);
// 	return view('welcome', compact('prod'));
// });

// produit controller
Route::resource('/', 'App\Http\Controllers\ProductControllers');
Route::resource('/produit', 'App\Http\Controllers\ProductControllers');
Route::get('/prod', ['App\Http\Controllers\ProductControllers', 'index'])->name('prod');
Route::get('/search', ['App\Http\Controllers\ProductControllers', 'search'])->name('search');

// coupon controller
Route::post('/coupon',  ['App\Http\Controllers\CouponControllers', 'store'])->name('storeCoupon');
Route::delete('/coupon',  ['App\Http\Controllers\CouponControllers', 'destroy'])->name('destroyCoupon');

// cart controllers //
Route::resource('/cart', 'App\Http\Controllers\CartControllers');
Route::patch('/cart/{rowId}', 'App\Http\Controllers\CartControllers@update');
Route::get('/addcart/{id}', ['App\Http\Controllers\CartControllers', 'AddProductToCart'])->name('AddProductToCart');

// pay controllers //
Route::group(['middleware' => 'auth'], function () {
	Route::resource('/paiemant', 'App\Http\Controllers\PaiemantControllers');
});

// user account
Route::group(['middleware' => 'auth'], function(){
	Route::get('/mon-compte', ['App\Http\Controllers\ProfilControllers', 'index'])->name('mon-compte');
	Route::patch('/mon-compte', ['App\Http\Controllers\ProfilControllers', 'update'])->name('mon-compte.update');
	Route::get('/mes-commandes', ['App\Http\Controllers\CommandeControllers', 'index'])->name('mes-commandes');
	Route::get('/ma-commande/{IdCommande}', ['App\Http\Controllers\CommandeControllers', 'show'])->name('ma-commande');
});
// paiement entant qu'invité
Route::get('/invite', ['App\Http\Controllers\PaiemantControllers', 'index'])->name('payment.invite');
Route::get('/page_inviter', ['App\Http\Controllers\PaiemantControllers', 'indexInvite'])->name('paiement');
Route::post('/paiement_invite', ['App\Http\Controllers\PaiemantControllers', 'store'])->name('storepaiement.invite');


//admin route
Route::group(['prefix' => 'admin'], function () {
	Voyager::routes();
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	return view('dashboard');
})->name('dashboard');

	//pay with palpay
Route::get('/handle-payment', ['App\Http\Controllers\PaypalControllers', 'handlePayment'])->name('make.payment');
Route::get('/cancel-payment', ['App\Http\Controllers\PaypalControllers', 'paymentCancel'])->name('cancel.payment');
Route::get('/payment-success', ['App\Http\Controllers\PaypalControllers', 'paymentSuccess'])->name('success.payment');