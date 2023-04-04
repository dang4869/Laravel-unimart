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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('admin/error', 'AdminErrorController@show')->name('admin.error.show');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'AdminDashboardController@show')->name('admin.dashboard.index');
    Route::get('/profile', 'Auth\ProfileController@show')->name('profile');
    Route::post('/profile/update', 'Auth\ProfileController@update')->name('profile.update');
    Route::get('/changpassword', 'Auth\ChangPasswordController@edit')->name('change');
    Route::post('/changpassword/update', 'Auth\ChangPasswordController@update');
    Route::get('/admin', 'AdminDashboardController@show')->name('admin.show');
    Route::get('/admin/user/list', 'AdminUserController@list')->name('admin.user.list');
    Route::get('/admin/user/add', 'AdminUserController@add')->name('admin.user.add');
    Route::get('/admin/user/role/{id}', 'AdminUserController@role')->name('admin.user.role');
    Route::post('/admin/user/store', 'AdminUserController@store')->name('admin.user.store');
    Route::get('/admin/user/delete/{id}', 'AdminUserController@delete')->name('admin.delete_user');
    Route::get('/admin/user/action', 'AdminUserController@action')->name('admin.user.action');
    Route::get('/admin/user/edit/{id}', 'AdminUserController@edit')->name('admin.user.edit');
    Route::post('/admin/user/update/{id}', 'AdminUserController@update')->name('admin.user.update');
    Route::get('/admin/user/forcedelete/{id}', 'AdminUserController@forceDelete')->name('admin.user.forcedelete');
    Route::get('/admin/user/restore/{id}', 'AdminUserController@restore')->name('admin.user.restore');
    Route::get('admin/post/list', 'AdminPostController@list')->name('admin.post.list');
    Route::get('admin/post/add', 'AdminPostController@add')->name('admin.Post.add');
    Route::post('admin/post/store', 'AdminPostController@store')->name('admin.post.store');
    Route::get('admin/post/delete/{id}', 'AdminPostController@delete')->name('admin.post.delete');
    Route::get('admin/post/action', 'AdminPostController@action')->name('admin.post.action');
    Route::get('admin/post/edit/{id}', 'AdminPostController@edit')->name('admin.post.edit');
    Route::post('admin/post/update/{id}', 'AdminPostController@update')->name('admin.post.update');
    Route::get('admin/post/cat/add', 'AdminCategoryPostController@show')->name('admin.post.cat');
    Route::post('admin/category-post/store', 'AdminCategoryPostController@store')->name('admin.category-post.store');
    Route::get('admin/category-post/delete/{id}', 'AdminCategoryPostController@delete')->name('admin.category_post.delete');
    Route::get('admin/category-post/edit/{id}', 'AdminCategoryPostController@edit')->name('admin.category_post.edit');
    Route::post('admin/category-post/update/{id}', 'AdminCategoryPostController@update')->name('admin.category_post.update');
    Route::get('admin/page/list', 'AdminPageController@list')->name('admin.page.list');
    Route::get('admin/page/add', 'AdminPageController@add')->name('admin.page.add');
    Route::post('admin/page/store', 'AdminPageController@store')->name('admin.page.store');
    Route::get('admin/page/delete/{id}', 'AdminPageController@delete')->name('admin.page.delete');
    Route::get('admin/page/edit/{id}', 'AdminPageController@edit')->name('admin.page.edit');
    Route::post('admin/page/update/{id}', 'AdminPageController@update')->name('admin.page.update');
    Route::get('admin/page/action', 'AdminPageController@action')->name('admin.page.action');
    Route::get('admin/product/cat/list', 'AdminCategoryProductController@list')->name('admin.product.cat');
    Route::post('admin/category-product/store', 'AdminCategoryProductController@store')->name('admin.category-product.store');
    Route::get('admin/category-product/delete/{id}', 'AdminCategoryProductController@delete')->name('admin.categoryproduct.delete');
    Route::get('admin/category-product/edit/{id}', 'AdminCategoryProductController@edit')->name('admin.categoryproduct.edit');
    Route::post('admin/category-product/update/{id}', 'AdminCategoryProductController@update')->name('admin.categoryproduct.update');
    Route::get('admin/product/gallery/add/{id}', 'AdminGalleryController@add')->name('admin.gallery.add');
    Route::post('admin/product/select-gallery', 'AdminGalleryController@select_gallery');
    Route::post('admin/gallery/store/{id}', 'AdminGalleryController@store');
    Route::post('admin/gallery/update/gallery-name', 'AdminGalleryController@update_name');
    Route::post('admin/gallery/delete', 'AdminGalleryController@delete');
    Route::post('admin/gallery/update', 'AdminGalleryController@update');
    Route::get('admin/product/color', 'AdminProductColorController@show');
    Route::post('admin/product/color/store/{id}', 'AdminProductColorController@store');
    Route::get('admin/product/color/delete/{id}', 'AdminProductColorController@delete')->name('admin.color.delete');
    Route::get('admin/product/color/edit/{id}', 'AdminProductColorController@edit')->name('admin.color.edit');
    Route::post('admin/product/color/update/{id}', 'AdminProductColorController@update')->name('admin.color.update');
    Route::get('admin/product/list', 'AdminProductController@list')->name('admin.product.list');
    Route::get('admin/product/add', 'AdminProductController@add')->name('admin.product.add');
    Route::post('admin/product/store', 'AdminProductController@store')->name('admin.product.store');
    Route::get('admin/product/delete/{id}', 'AdminProductController@delete')->name('admin.product.delete');
    Route::get('admin/product/edit/{id}', 'AdminProductController@edit')->name('admin.product.edit');
    Route::post('admin/product/update/{id}', 'AdminProductController@update')->name('admin.product.update');
    Route::get('admin/product/color/show/{id}', 'AdminProductColorController@show')->name('admin.color.show');
    Route::get('admin/product/action', 'AdminProductController@action')->name('admin.product.action');
    Route::get('admin/order/list', 'AdminOrderController@list')->name('admin.order.list');
    Route::post('admin/order/action', 'AdminOrderController@action')->name('admin.order.action');
    Route::get('admin/order/delete/{id}', 'AdminOrderController@delete')->name('admin.order.delete');
    Route::get('admin/order/detail/{id}', 'AdminDetailOrderController@show')->name('admin.order.detail');
    Route::post('admin/order/detail/update/{id}', 'AdminDetailOrderController@update')->name('admin.order.update');
    Route::get('admin/role/list', 'AdminRoleController@list')->name('admin.role.list');
    Route::get('admin/role/add', 'AdminRoleController@add')->name('admin.role.add');
    Route::post('admin/role/store', 'AdminRoleController@store')->name('admin.role.store');
    Route::get('admin/role/delete/{id}', 'AdminRoleController@delete')->name('admin.role.delete');
    Route::get('admin/role/edit/{id}', 'AdminRoleController@edit')->name('admin.role.edit');
    Route::post('admin/role/update/{id}', 'AdminRoleController@update')->name('admin.role.update');
    Route::get('admin/slider/list', 'AdminSliderController@list')->name('admin.slider.list');
    Route::post('admin/slider/store', 'AdminSliderController@store')->name('admin.slider.store');
    Route::post('admin/slider/delete', 'AdminSliderController@delete');
    Route::post('admin/slider/update', 'AdminSliderController@update');
    Route::post('admin/slider/select-slider', 'AdminSliderController@select_slider');
});
Route::get('' , 'PublicController@show')->name('home');
Route::get('san-pham/{slug}', 'CategoryProductController@show')->name('category.product');
Route::get('chi-tiet-san-pham/{slug}', 'ProductController@detail')->name('product.detail');
Route::get('gio-hang', 'CartController@show')->name('product.cart');
Route::post('cart/add/{id}', 'CartController@add')->name('cart.add');
Route::get('cart/remove/{rowId}', 'CartController@remove')->name('cart.remove');
Route::get('cart/destroy', 'CartController@destroy');
Route::post('cart/update', 'CartController@update');
Route::get('thanh-toan', 'CheckOutController@show');
Route::post('checkout/store', 'CheckOutController@store');
Route::post('checkout/vnpay', 'CheckOutController@vnpay');
Route::get('vnpayreturn', 'CheckOutController@vnpReturn');
Route::get('thong-tin-don-hang', 'CheckOutController@single');
Route::get('tim-kiem', 'SearchController@search');
Route::post('search/ajax','SearchController@ajax');
Route::get('tin-tuc','BlogController@show');
Route::get('tin-tuc/{slug}','BlogController@blogdetail')->name('blog.detail');
Route::get('san-pham', 'ProductController@show');
Route::get('lien-he','ContactController@show');
Route::get('gioi-thieu','IntroduceController@show');
Route::get('select/province', 'CheckOutController@province');
Route::get('select/wards', 'CheckOutController@wards');

