<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\MenuorderkreditController;
use App\Http\Controllers\MenuordertunaiController;
use App\Http\Controllers\OkdController;
use App\Http\Controllers\NotaluringController;
use App\Http\Controllers\PbkController;
use App\Http\Controllers\PbtController;
use App\Http\Controllers\PhbkController;
use App\Http\Controllers\HbkdController;
use App\Http\Controllers\DpController;
use App\Http\Controllers\LpController;
use App\Http\Controllers\LpiutangContonroller;
use App\Http\Controllers\LpersediaanController;
use App\Http\Controllers\FlController;

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

Route::get('/', 'LandingPageController@index');

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index');

Route::get('change-password', 'ChangePasswordController@index')->middleware('auth');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password')->middleware('auth');

Route::get('/category', [CategoryController::class, 'index'])->middleware('auth', 'admin');
Route::get('/category/formstore', [CategoryController::class, 'formstore'])->middleware('auth', 'admin');
Route::post('/category/store', [CategoryController::class, 'store'])->middleware('auth', 'admin');
Route::get('/category/formedit/{id}', [CategoryController::class, 'formedit'])->middleware('auth', 'admin');
Route::patch('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('auth', 'admin');
Route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete')->middleware('auth', 'admin');

Route::get('/products', [ProductController::class, 'index'])->middleware('auth', 'admin');
Route::get('/products/formstore', [ProductController::class, 'formstore'])->middleware('auth','gp');
Route::post('/products/store', [ProductController::class, 'store'])->name('product.store')->middleware('auth','gp');
Route::get('/products/formedit/{id}', [ProductController::class, 'formedit'])->name('product.formedit')->middleware('auth','gp');
Route::patch('/products/edit/{id}', [ProductController::class, 'edit'])->name('product.edit')->middleware('auth','gp');
Route::delete('/products/delete/{id}', [ProductController::class, 'delete'])->name('product.delete')->middleware('auth','gp');

Route::get('/ekspedisi', [EkspedisiController::class, 'index'])->middleware('auth','admin');
Route::get('/ekspedisi/formstore', [EkspedisiController::class, 'formstore'])->middleware('auth','gp');
Route::post('ekspedisi/store', [EkspedisiController::class, 'store'])->middleware('auth','gp');
Route::get('/ekspedisi/formedit/{id}', [EkspedisiController::class, 'formedit'])->middleware('auth','gp');
Route::patch('/ekspedisi/edit/{id}', [EkspedisiController::class, 'edit'])->name('ekspedisi.edit')->middleware('auth','gp');
Route::delete('/ekspedisi/delete/{id}', [EkspedisiController::class, 'delete'])->name('ekspedisi.delete')->middleware('auth','gp');

Route::get('/metode_bayar', 'MetodebayarController@index')->middleware('auth','admin');
Route::get('/metode_bayar/formstore', 'MetodebayarController@formstore')->middleware('auth','bendahara');
Route::post('/metode_bayar/store', 'MetodebayarController@store')->middleware('auth','bendahara');
Route::get('/metode_bayar/formedit/{id}', 'MetodebayarController@formedit')->name('metode_bayar.formedit')->middleware('auth','bendahara');
Route::patch('/metode_bayar/edit/{id}', 'MetodebayarController@edit')->name('metode_bayar.edit')->middleware('auth','bendahara');
Route::delete('/metode_bayar/delete/{id}', 'MetodebayarController@delete')->name('metode_bayar.delete')->middleware('auth','bendahara');

Route::get('/akun/formedit', 'AdminController@formeditakun')->middleware('auth', 'admin');
Route::patch('/akun/editakunadmin/{id}', 'AdminController@editakunadmin')->middleware('auth','admin');

Route::get('/akun/formeditpelanggan', 'UserController@formeditakunpelanggan')->middleware('auth');
Route::patch('/akun/editakunpelanggan/{id}', 'UserController@editakunpelanggan')->middleware('auth');

Route::get('/cart', 'CartController@index')->middleware('auth');
Route::post('/cart/store', 'CartController@store')->middleware('auth');
Route::patch('/cart/{id}', 'CartController@update')->middleware('auth');
Route::delete('/cart/delete/{id}', 'CartController@delete')->name('cart.delete')->middleware('auth');

Route::get('/shop', 'ShopController@index');

Route::get('/shop/detail/{id}', 'ShopController@show')->middleware('auth');

Route::get('/shop/category/{id}', 'ShopController@category')->middleware('auth');

Route::post('/checkout/belikredit', 'CheckoutController@storekredit')->middleware('auth');

Route::post('/checkout/belitunai', 'CheckoutController@storetunai')->middleware('auth');

Route::post('/checkout/beliluring', 'CheckoutController@storeluring')->middleware('auth', 'admin');

Route::middleware(['auth', 'gp'])->group(function () {Route::resource('menupersediaan', PersediaanController::class);});

Route::get('/menuorderk', [MenuorderkreditController::class, 'index'])->middleware('auth','admin');
Route::get('/menuorderk/detail/{id}', [MenuorderkreditController::class, 'detail'])->middleware('auth','admin');
Route::get('/menuorderk/show/{id}', [MenuorderkreditController::class, 'show'])->middleware('auth','penjualan');

Route::get('/menuordert', [MenuordertunaiController::class, 'index'])->name('menuordert.index')->middleware('auth','admin');
Route::get('/menuordert/detail/{id}', [MenuordertunaiController::class, 'edit'])->name('menuordert.edit')->middleware('auth','admin');
Route::get('/menuordert/show/{id}', [MenuordertunaiController::class, 'show'])->name('menuordert.show')->middleware('auth','gp');

Route::get('/okd', [OkdController::class, 'index'])->name('okd.index')->middleware('auth','admin');
Route::post('/okd/store', [OkdController::class, 'store'])->name('okd.store')->middleware('auth','penjualan');
Route::get('/okd/edit/{id}', [OkdController::class, 'edit'])->name('okd.edit')->middleware('auth', 'penjualan');
Route::patch('/okd/update/{id}', [OkdController::class, 'update'])->name('okd.update')->middleware('auth','penjualan');
Route::get('/okd/lihatorder/{id}', [OkdController::class, 'view'])->name('lihatorder')->middleware('auth', 'admin');
Route::delete('/okd/delete/{id}', [OkdController::class, 'delete'])->name('okd.delete')->middleware('auth','penjualan');
Route::get('/okd/show/{id}', [OkdController::class, 'show'])->name('okd.show')->middleware('auth', 'gp');

Route::get('/phbk', [PhbkController::class, 'index'])->name('phbk.index')->middleware('auth','admin');
Route::post('/phbk/store', [PhbkController::class, 'store'])->name('phbk.store')->middleware('auth');
Route::get('/phbk/show/{id}', [PhbkController::class, 'show'])->name('phbk.show')->middleware('auth', 'penj_bend');
Route::delete('/phbk/destroy/{id}', [PhbkController::class, 'destroy'])->name('phbk.destroy')->middleware('auth','penj_bend');

Route::get('/hbkd', [HbkdController::class, 'index'])->name('hbkd.index')->middleware('auth','admin');
Route::post('/hbkd/store', [HbkdController::class, 'store'])->name('hbkd.store')->middleware('auth', 'penj_bend');
Route::delete('/hbkd/destroy/{id}', [HbkdController::class, 'destroy'])->name('hbkd.destroy')->middleware('auth','penj_bend');

Route::get('/pbk', [PbkController::class, 'index'])->name('pbk.index')->middleware('auth', 'admin');
Route::post('/pbk/store', [PbkController::class, 'store'])->name('pbk.store')->middleware('auth', 'gp');
Route::get('/pbk/edit/{id}', [PbkController::class, 'edit'])->name('pbk.edit')->middleware('auth', 'gp');
Route::patch('/pbk/update/{id}', [PbkController::class, 'update'])->name('pbk.update')->middleware('auth', 'gp');
Route::delete('/pbk/delete/{id}', [PbkController::class, 'delete'])->name('pbk.delete')->middleware('auth', 'gp');
Route::get('/pbk/show/{id}', [PbkController::class, 'show'])->name('pbk.show')->middleware('auth', 'bendahara');
Route::get('/pbk/lihatorderan/{id}', [PbkController::class, 'lihatorderan'])->name('pbk.lihatorderan')->middleware('auth', 'admin');
Route::get('/pbt/sendfaktur/{id}', [PbkController::class, 'sendfaktur'])->name('pbk.sendfaktur')->middleware('auth', 'bendahara');

Route::get('/pbt', [PbtController::class, 'index'])->name('pbt.index')->middleware('auth', 'admin');
Route::post('/pbt/store', [PbtController::class, 'store'])->name('pbt.store')->middleware('auth', 'gp');
Route::get('/pbt/sendenota', [PbtController::class, 'sendenota'])->name('pbt.sendenota')->middleware('auth', 'gp');
Route::get('/pbt/show/{id}', [PbtController::class, 'show'])->name('pbt.show')->middleware('auth', 'admin');
Route::get('/pbt/edit/{id}', [PbtController::class, 'edit'])->name('pbt.edit')->middleware('auth', 'gp');
Route::patch('/pbt/update/{id}', [PbtController::class, 'update'])->name('pbt.update')->middleware('auth', 'gp');
Route::delete('/pbt/destroy/{id}', [PbtController::class, 'destroy'])->name('pbt.destroy')->middleware('auth', 'gp');

Route::get('/fl', [FlController::class, 'index'])->name('fl.index')->middleware('auth', 'admin');
Route::post('/fl/store', [FlController::class, 'store'])->name('fl.store')->middleware('auth', 'bendahara');
Route::get('/fl/show/{id}', [FlController::class, 'show'])->name('fl.show')->middleware('auth', 'admin');
Route::get('/fl/edit/{id}', [FlController::class, 'edit'])->name('fl.edit')->middleware('auth', 'bendahara');
Route::patch('/fl/update/{id}', [FlController::class, 'update'])->name('fl.update')->middleware('auth', 'bendahara');
Route::delete('/fl/destroy/{id}', [FlController::class, 'destroy'])->name('fl.destroy')->middleware('auth', 'bendahara');

Route::get('/daftarpesanantunai', [DpController::class, 'tunai'])->name('daftarpesanan.tunai')->middleware('auth');
Route::get('/daftarpesanan/createtunai/{id}', [DpController::class, 'createtunai'])->name('daftarpesanan.createtunai')->middleware('auth');
Route::post('/daftarpesanan/storetunai', [DpController::class, 'storetunai'])->name('daftarpesanan.storetunai')->middleware('auth');
Route::get('/daftarpesanankredit', [DpController::class, 'kredit'])->name('daftarpesanan.kredit')->middleware('auth')->middleware('auth');
Route::get('/daftarpesanan/createkredit/{id}', [DpController::class, 'createkredit'])->name('daftarpesanan.createkredit')->middleware('auth');
Route::post('/daftarpesanan/storekredit', [DpController::class, 'storekredit'])->name('daftarpesanan.storekredit')->middleware('auth');

Route::get('/menunotaluring', [NotaluringController::class, 'index'])->middleware('auth', 'admin');

Route::get('/menunotaluring/formstore', [NotaluringController::class, 'formstore'])->middleware('auth','admin');

Route::post('/menunotaluring/store', [NotaluringController::class, 'store'])->middleware('auth','penj_bend');

Route::get('/menunotaluring/formedit/{id}', [NotaluringController::class, 'formedit'])->middleware('auth','penj_bend');

Route::patch('/menunotaluring/edit/{id}', [NotaluringController::class, 'edit'])->name('notaluring.edit')->middleware('auth','penj_bend');

Route::get('/menunotaluring/detail/{id}', [NotaluringController::class, 'detail'])->name('detailnotal')->middleware('auth','admin');

Route::delete('/menunotaluring/delete/{id}', [NotaluringController::class, 'delete'])->name('deletenotal')->middleware('auth','penj_bend');

Route::get('/lappenjualan', [LpController::class, 'pelanggan'])->name('lp.pelanggan');
Route::get('/lappenjualan/pelv/{id}', [LpController::class, 'pelv'])->name('lp.pelv');
Route::get('/lappenjualan/pelvt/{id}', [LpController::class, 'pelvt'])->name('lp.pelvt');
Route::get('/lappenjualan/produk', [LpController::class, 'produk'])->name('lp.produk');
Route::get('/lappenjualan/produkk/{id}', [LpController::class, 'produkk'])->name('lp.produkk');
Route::get('/lappenjualan/produkt/{id}', [LpController::class, 'produkt'])->name('lp.produkt');

Route::get('/lappiutang', [LpiutangContonroller::class, 'pelanggan'])->name('lpiutang.pelanggan');
Route::get('/lappiutang/kartu/{id}', [LpiutangContonroller::class, 'kartu'])->name('lpiutang.kartu');
Route::get('/lappiutang/tpp', [LpiutangContonroller::class, 'tpp'])->name('lpiutang.tpp');
Route::get('/lappiutang/umurpiutang', [LpiutangContonroller::class, 'umurpiutang'])->name('lpiutang.umurpiutang');

Route::get('/lappersediaan', [LpersediaanController::class, 'index'])->name('lpersediaan.index');
Route::get('/lappersediaan/kp/{id}', [LpersediaanController::class, 'kp'])->name('lpersediaan.kp');