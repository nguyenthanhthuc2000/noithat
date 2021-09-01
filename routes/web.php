<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Middleware\CheckLogoutAD;
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

//client
Route::get('/','Client\HomeController@index');
Route::get('/trang-chu','Client\HomeController@index')->name('shop.index');
Route::resource('chi-tiet-san-pham','Client\ProductController')->except([
	'create', 'store','destroy','edit'
]);
Route::resource('chi-tiet-bai-viet','Client\BlogController')->except([
	'create', 'store','destroy','edit'
]);
Route::resource('san-pham','Client\CategoryController')->except([
	'create', 'store','destroy','edit'
]);
Route::resource('thuong-hieu','Client\BrandController')->except([
	'create', 'store','destroy','edit'
]);
Route::get('/search','Client\SearchController@search_product')->name('search.product');
Route::get('/tag/{slug}','Client\ProductController@tag')->name('product.tag');
Route::get('/contact','Client\HomeController@contact')->name('shop.contact');
Route::post('/post-contact','Client\HomeController@post_contact')->name('shop.post_contact');

Route::get('/logout','Client\LoginController@logout')->name('shop.logout');
Route::get('/login','Client\LoginController@index')->name('shop.viewlogin');
Route::POST('/login','Client\LoginController@login')->name('shop.login');
Route::get('/checkout','Client\CartController@checkout')->name('shop.checkout');
Route::POST('/apply-coupon','Client\CartController@apply_coupon')->name('shop.apply_coupon');
Route::POST('/get-address','Client\CartController@get_address')->name('shop.get_address');
Route::POST('/update-cart','Client\CartController@update_cart')->name('shop.update_cart');
Route::POST('/order-store','Client\OrderController@store')->name('order.store');
Route::get('/destroy-coupon','Client\CartController@destroy_coupon')->name('shop.destroy_coupon');
Route::resource('customer','Client\CustomerController')->except([
	'destroy'
]);
Route::resource('cart','Client\CartController');
//admin
Route::get('/admin-login','Admin\LoginController@index')->name('admin.login')->middleware(CheckLogoutAD::class);
Route::post('/post-login','Admin\LoginController@postLogin')->name('admin.postlogin');

Route::group(['middleware' => 'auth'],function(){
	//admin
	Route::get('/admin-logout','Admin\LoginController@logout')->name('admin.logout');
	Route::get('/admin','Admin\AdminController@index')->name('admin.index');
	Route::prefix('admin')->group(function () {
		Route::resource('admin','Admin\AdminController')->except([
		    'create', 'store','destroy','edit'
		]);
		Route::resource('setting-manager','Admin\SettingController')->except([
		    'create', 'store','destroy','edit'
		]);
		Route::resource('contact-manager','Admin\ContactController')->except([
		    'create', 'store','edit'
		]);
		Route::resource('tag-product-manager','Admin\TagProductController');
		Route::resource('notification-manager','Admin\NotificationController');
		Route::resource('coupon-manager','Admin\CouponController');
		Route::resource('item-manager','Admin\ItemController');
		Route::resource('category-manager','Admin\CategoryController');
		Route::resource('brand-manager','Admin\BrandController');
		Route::resource('order-manager','Admin\OrderController');
		Route::resource('feeship-manager','Admin\FeeShipController');
		Route::resource('roles-manager','Admin\RolesController');
		Route::resource('user-manager','Admin\ModUserController');
		Route::resource('product-manager','Admin\ProductController');
		Route::post('product-manager/choose_cat','Admin\ProductController@choose_cat' )->name('product-manager.choose_cat');

		Route::get('print-order/{id}','Admin\OrderController@print_order' )->name('order-manager.print_order');
		Route::get('user-manager/permission/{type}','Admin\ModUserController@permission' )->name('user-manager.permission');
		Route::post('user-manager/insert-role-user/{id}','Admin\ModUserController@insert_role_user' )->name('user-manager.insert_role_user');
		Route::get('thong-bao/{type}','Admin\NotificationController@index')->name('notification-manager.index');
		Route::post('thong-bao/update/{id}','Admin\NotificationController@update' )->name('notification-manager.update');
		
		Route::prefix('upload-manager')->group(function () {
			Route::post('uploads-ckeditor','Admin\UploadController@uploads_ckeditor');
			Route::get('file/file-browser','Admin\UploadController@file_browser');
		});
		
		
		Route::prefix('blog-manager')->group(function () {
			Route::post('store/{type}','Admin\BlogController@store');
			Route::get('edit/{type}','Admin\BlogController@edit');
		    Route::post('update/{id}','Admin\BlogController@update')->name('blog-manager.update');
		    Route::post('destroy/{id}','Admin\BlogController@destroy')->name('blog-manager.destroy');
		    Route::get('create/{type}', 'Admin\BlogController@create');
		    Route::get('list/intro','Admin\BlogController@intro' )->name('blog-manager.intro');
		    Route::get('list/{type}','Admin\BlogController@list_post' )->name('blog-manager.list_post');
		});
		Route::prefix('photo-manager')->group(function () {
		    Route::get('photo/{type}','Admin\PhotoController@photo' )->name('photo-manager.photo');
		    Route::get('list/{type}','Admin\PhotoController@list_photo' )->name('photo-manager.listphoto');
		    Route::get('create/{type}','Admin\PhotoController@create' )->name('photo-manager.create');
		    Route::post('update/{id}','Admin\PhotoController@update')->name('photo-manager.update');
		    Route::post('store','Admin\PhotoController@store')->name('photo-manager.store');
		    Route::get('edit/{id}','Admin\PhotoController@edit')->name('photo-manager.edit');
		    Route::POST('destroy/{id}','Admin\PhotoController@destroy')->name('photo-manager.destroy');
		});
	});
});
