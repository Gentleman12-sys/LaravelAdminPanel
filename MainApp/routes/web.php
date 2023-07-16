<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin/login', 'App\Http\Controllers\AdminController')->name('admin-login');

Route::post('/admin/login/submit', 'App\Http\Controllers\AdminController@submit')->name('admin-login-submit');

// ifp
Route::get('/admin/ifp', 'App\Http\Controllers\IFPController')->name('admin-ifp');

Route::get('/admin/ifp/edit_page/{id}', 'App\Http\Controllers\IFPController@edit_page')->name('admin-ifp-edit-page');
Route::post('/admin/ifp/edit', 'App\Http\Controllers\IFPController@edit')->name('admin-ifp-edit');

Route::post('/admin/ifp/delete', 'App\Http\Controllers\IFPController@delete')->name('admin-ifp-delete');

// user
Route::get('/admin/user', 'App\Http\Controllers\UserController')->name('admin-user');

Route::get('/admin/user/edit_page/{id}', 'App\Http\Controllers\UserController@edit_page')->name('admin-user-edit-page');
Route::post('/admin/user/edit', 'App\Http\Controllers\UserController@edit')->name('admin-user-edit');

Route::post('/admin/user/delete', 'App\Http\Controllers\UserController@delete')->name('admin-user-delete');

// advt
Route::get('/admin/advt', 'App\Http\Controllers\AdvtController')->name('admin-advt');

Route::get('/admin/advt/edit_page/{id}', 'App\Http\Controllers\AdvtController@edit_page')->name('admin-advt-edit-page');
Route::post('/admin/advt/edit', 'App\Http\Controllers\AdvtController@edit')->name('admin-advt-edit');

Route::post('/admin/advt/delete', 'App\Http\Controllers\AdvtController@delete')->name('admin-advt-delete');

// company
Route::get('/admin/company', 'App\Http\Controllers\CompanyController')->name('admin-company');

Route::get('/admin/company/edit_page/{id}', 'App\Http\Controllers\CompanyController@edit_page')->name('admin-company-edit-page');
Route::post('/admin/company/edit', 'App\Http\Controllers\CompanyController@edit')->name('admin-company-edit');

Route::post('/admin/company/delete', 'App\Http\Controllers\CompanyController@delete')->name('admin-company-delete');