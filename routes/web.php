
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

Route::get('/', 'GuestController@home');
Route::get('/product/details/{id}', 'GuestController@productDetails');
Route::get('/product/{idcategory}/list', 'GuestController@shop');
Route::post('/product/search', 'GuestController@search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/Client/dashboard', 'ClientController@Dashboard');
Route::get('/client/profile', 'ClientController@profile')->middleware('auth');
Route::get('/client/cart', 'ClientController@cart')->middleware('auth');
Route::post('/client/profile/update', 'ClientController@profileupdate')->middleware('auth',);
Route::post('/client/review/store', 'ClientController@addReview')->middleware('auth',);
Route::post('/client/order/store', 'CommandeController@store')->middleware('auth','is_active');
Route::get('/client/lignecommande/{id}/delete', 'CommandeController@destroy')->middleware('auth',);
Route::post('/client/checkout', 'ClientController@checkout')->middleware('auth',);
Route::get('/client/commandes', 'ClientController@commandes')->middleware('auth',);

Route::get('/Admin/dashboard', 'AdminController@Dashboard')->middleware('auth','admin');
Route::get('/Admin/clients', 'AdminController@client')->middleware('auth','admin');
Route::get('/Admin/commandes', 'AdminController@commandes')->middleware('auth','admin');
Route::get('/Admin/clients/{id}/bolquee', 'AdminController@bloquee')->middleware('auth','admin');
Route::get('/Admin/clients/{id}/activee', 'AdminController@activee')->middleware('auth','admin');
Route::get('/Admin/profile', 'AdminController@profile')->middleware('auth','admin');
Route::post('/Admin/profile/update', 'AdminController@profileupdate')->middleware('auth','admin');
Route::get('/Admin/categories', 'CategoryController@index')->middleware('auth','admin');
Route::post('/Admin/categories/store', 'CategoryController@store')->middleware('auth','admin');
Route::get('/Admin/categories/{id}/delete', 'CategoryController@destroy')->middleware('auth','admin');
Route::post('/Admin/categories/update', 'CategoryController@update')->middleware('auth','admin');
Route::get('/Admin/products', 'ProductController@index')->middleware('auth','admin');
Route::post('/Admin/products/store', 'ProductController@store')->middleware('auth','admin');
Route::get('/Admin/products/{id}/delete', 'ProductController@destroy')->middleware('auth','admin');
Route::post('/Admin/products/update', 'ProductController@update')->middleware('auth','admin');
Route::post('/Admin/products/search', 'ProductController@search')->middleware('auth','admin');
Route::get('/client/bloquer', 'ClientController@messagedebloque')->middleware('auth',);
