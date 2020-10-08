<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/test','MainController@Print');
//tampilan
Route::get('/','MainController@LoginIndex');
Route::get('/Laporan','MainController@LaporanIndex');
Route::get('/Karyawan','MainController@KaryawanIndex');
Route::get('/Stok','MainController@StokIndex');
Route::get('/Scanning','MainController@ScanningIndex');
Route::get('/Pembelian','MainController@PembelianIndex');
Route::get('/Pelunasan','MainController@PelunasanIndex');
Route::get('/ShowBarang','MainController@ShowBarangIndex');
Route::get('/ShowSupplier','MainController@ShowSupplierIndex');

//post data
Route::post('/LoginPost','MainController@LoginPost');
Route::post('/KaryawanPost','MainController@KaryawanPost');
Route::post('/JenisFormPost','MainController@JenisFormPost');
Route::post('/StokPost','MainController@StokPost');
Route::post('/SupplierPost','MainController@SupplierPost');
Route::post('/PenjualanPost','MainController@PenjualanPost');
Route::post('/PembelianPost','MainController@PembelianPost');
Route::post('/PelunasanTPost','MainController@PelunasanTPost');

//eksekusi data
Route::get('/KaryawanLoad','MainController@KaryawanLoad');
Route::get('/StokLoad','MainController@StokLoad');
Route::get('/SupplierLoad','MainController@SupplierLoad');
Route::get('/CartLoad/','MainController@CartLoad');
Route::get('/CartBeliLoad/','MainController@CartBeliLoad');
Route::get('/CartPost/{kode}','MainController@CartPost');
Route::get('/CartBeliPost/{kode}','MainController@CartBeliPost');
Route::get('/PelunasanLoad','MainController@Pelunasan');
Route::get('/HutangLoad','MainController@Hutang');
Route::get('/LaporanAbsensiLoad','MainController@LaporanAbsensiLoad');
Route::get('/Logout','MainController@Logout');
Route::get('/PostAbsen','MainController@PostAbsen');
Route::get('/AbsenLoad','MainController@AbsenLoad');

//eksekusi data2
Route::get('/AbsenDelete/{id}','MainController@DeleteAbsen');
Route::get('/UserrDelete/{id}','MainController@DeleteUser');
Route::get('/SupplierDelete/{id}','MainController@DeleteSupplier');
Route::get('/SupplierEdit/{id}','MainController@EditSupplier');
Route::get('/UserEdit/{id}','MainController@EditUser');
Route::get('/SupplierUpdate','MainController@SupplierUpdate');
Route::get('/UserUpdate','MainController@UserUpdate');
Route::get('/StokDelete/{id}','MainController@DeleteStok');
Route::get('/StokEdit/{id}','MainController@EditStok');
Route::get('/StokUpdate','MainController@StokUpdate');
Route::get('/CartDelete/{id}','MainController@DeleteCart');
Route::get('/CartBeliDelete/{id}','MainController@DeleteCartBeli');
Route::get('/ShowStok/{id}','MainController@ShowStok');
Route::get('/CartUpdate/{id}/{qty}/{disc1}/{disc2}/{discnominal}/{subtotal}','MainController@CartUpdate');
Route::get('/CartBeliUpdate/{id}/{qty}/{disc1}/{disc2}/{discnominal}/{subtotal}','MainController@CartBeliUpdate');
Route::get('/LaporanPenjualanLoad','MainController@LaporanPenjualanLoad');
Route::get('/LaporanPembelianLoad','MainController@LaporanPembelianLoad');
Route::get('/LaporanUntungLoad','MainController@LaporanUntungLoad');
Route::get('/CollapseLaporanBeli/{id}','MainController@CollapseLaporanBeli');
Route::get('/CollapseLaporanj/{id}','MainController@CollapseLaporanJual');
Route::get('/detilpelunasanbayar/{id}','MainController@detilpelunasanbayar');
Route::get('/Search','MainController@Search');