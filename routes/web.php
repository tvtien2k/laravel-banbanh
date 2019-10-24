<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/trang-chu', 'PagesController@getIndex')->name('trangchu');

Route::get('/chung-loai/{id}', 'PagesController@getChungLoai')->name('chungloai');

Route::get('/gioi-thieu', 'PagesController@getGioiThieu')->name('gioithieu');

Route::get('/lien-he', 'PagesController@getLienHe')->name('lienhe');

Route::get('/chi-tiet-san-pham/{id}', 'PagesController@getChiTiet')->name('chitiet');

Route::get('/add-to-cart/{id}', 'PagesController@getAddToCart')->name('themgiohang');
Route::post('/add-to-cart', 'PagesController@postAddToCart')->name('postthemgiohang');

Route::get('/delete-cart/{id}', 'PagesController@getDelItemCart')->name('xoagiohang');

Route::get('/dat-hang', 'PagesController@getDatHang')->name('dathang');
Route::post('/dat-hang', 'PagesController@postDatHang')->name('dathang2');

Route::get('/dang-ki', 'PagesController@getDangKi')->name('dangki');
Route::post('/dang-ki', 'PagesController@postDangKi')->name('dangki');

Route::get('/dang-nhap', 'PagesController@getDangNhap')->name('dangnhap');
Route::post('/dang-nhap', 'PagesController@postDangNhap')->name('dangnhap');

Route::get('/dang-xuat', 'PagesController@getDangXuat')->name('dangxuat');

Route::get('/tim-kiem', 'PagesController@getTimKiem')->name('timkiem');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
