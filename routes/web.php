<?php

use App\Http\Controllers\Telkom;
use App\Http\Controllers\TelkomPayment;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\DataOrderController;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use Auth;
// use Illuminate\Support\Facades\Auth;


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
//     return view('/');
// });
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [Telkom::class, 'index'])->name('index');
    Route::post('/insurance_telkom', [Telkom::class, 'store'])->name('insurance_telkom');
    Route::get('/payment_method/{id}', [Telkom::class, 'payment_method'])->name('payment_method');
    Route::get('/detail_method_payment/{method}/{id}', [TelkomPayment::class, 'index'])->name('detail_method_payment');
    Route::get('/checkout/{method}/{id}/{token?}', [TelkomPayment::class, 'checkout'])->name('checkout');
    Route::get('/finish/{id}', [TelkomPayment::class, 'finish'])->name('finish');
});

// Auth::routes();
// // Route::get('/operator', 'OperatorController@index')->name('Operator')->middleware('Operator');
// // Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');

// // Admin
// Route::get('/admin',  [AdminController::class, 'index'])->name('index')->middleware('admin');
// Route::get('/data_order',  [DataOrderController::class, 'index'])->name('index')->middleware('admin');
// Route::get('/pengguna', 'PenggunaController@index')->name('Pengguna')->middleware('Pengguna');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
