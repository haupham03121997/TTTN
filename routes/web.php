<?php
use App\Http\Middleware\CheckPermission;
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
//frontend 
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::post('/tim-kiem','HomeController@search');
//danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_id}','CategoryProduct@Show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}','BrandProduct@Show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}','ProductController@details_product');

//backend

Route::get('/admin', 'AdminController@index');
// Route::post('admin-dashboard','AdminController@dashboard' );
Route::post('admin-dashboard','AdminController@dashboard' );
Route::group(['middleware' => 'admin'], function () {
    Route::get('/logout', 'AdminController@logout');
  

    Route::get('/dashboard', 'AdminController@Showdashboard');
//category Product

Route::get('/add-category-product', 'CategoryProduct@add_category_product');
Route::get('/all-category-product', 'CategoryProduct@all_category_product');
Route::post('/save-category-product', 'CategoryProduct@save_category_product');

Route::get('/unactive-category-product/{category_product_id}', 'CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'CategoryProduct@active_category_product');

Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');
Route::post('/update-category-product', 'CategoryProduct@update_category_product');

//brand product
Route::get('/add-brand-product', 'BrandProduct@add_brand_product');
Route::get('/all-brand-product', 'BrandProduct@all_brand_product');
Route::post('/save-brand-product', 'BrandProduct@save_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}', 'BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}', 'BrandProduct@active_brand_product');

Route::get('/edit-brand-product/{brand_product_id}', 'BrandProduct@edit_brand_product');
Route::get('/delete-category-product/{brand_product_id}', 'BrandProduct@delete_brand_product');
Route::post('/update-brand-product', 'BrandProduct@update_brand_product');

//product

Route::get('/add-product', 'ProductController@add_product');
Route::get('/all-product', 'ProductController@all_product');
Route::post('/save-product', 'ProductController@save_product');

Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');

Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');


//manager user 
//  Route::prefix('admin')->group(function (){
    Route::get('/all-admin', 'AdminController@all_admin')->middleware('check:list_admin');
    Route::get('/add-admin', 'AdminController@add_admin');
    Route::post('/save-admin', 'AdminController@save_admin');
    Route::get('/edit-admin/{id}', 'AdminController@edit_admin');
    Route::post('/update-admin/{id}', 'AdminController@update_admin');
    Route::get('/delete-admin/{id}', 'AdminController@delete_admin');

//  });
//role 
// Route::group(['middleware' => 'check'], function () {
//     Route::get('/all-role', 'RoleController@all_role');

//         });

Route::get('/all-role', 'RoleController@all_role');
Route::get('/add-role', 'RoleController@add_role');
Route::post('/save-role', 'RoleController@save_role');
Route::get('/edit-role/{id}', 'RoleController@edit_role');
Route::post('/update-role/{id}', 'RoleController@update_role');
Route::get('/delete-role/{id}', 'RoleController@delete_role');
});

//cart 
Route::post('/save-cart', 'CartController@save_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');
Route::post('/update-cart-quantity', 'CartController@update_cart_quantity');
//check-out
Route::get('/login-checkout', 'CheckoutController@check_out');
Route::post('/add-customer', 'CheckoutController@add_customer');
Route::get('/logout-checkout', 'CheckoutController@logout_checkout');

Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/save-checkout-customer', 'CheckoutController@save_checkout_customer');
Route::post('/login-customer', 'CheckoutController@login_customer');

Route::get('/payment', 'CheckoutController@payment');
Route::post('/order-place', 'CheckoutController@order_place');


//order
Route::get('/manager-order', 'CheckoutController@manager_order');
Route::get('/view-order/{id}', 'CheckoutController@view_order');


//test 
Route::get('/test-view1', 'TestController@index');
Route::post('/form_1', 'TestController@get_form');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
