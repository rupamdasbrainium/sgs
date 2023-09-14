<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CMSController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\HomeController;

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
require __DIR__.'/auth.php';

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/',[HomeController::class,'index'])->name('homepage');
Route::get('suscription-form', 'SuscriptionController@suscriptionform')->name('suscriptionform');
Route::get('payment', 'PaymentController@payment')->name('payment');

Route::middleware('guest')->group(function () {
    // Routes for CustomerController
    Route::get('login', 'HomeController@login')->name('login');
    Route::get('forgot-password', 'HomeController@forgotPassword')->name('forgotpassword');
});

Route::group(['middleware'=>'auth'], function(){
    // Route::get('/', 'HomeController@index')->name('homepage');
    Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
});

Route::get('/reload-captcha', 'Admin\Auth\AuthenticatedSessionController@reloadCaptcha');

// Admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function() {
    Route::namespace('Auth')->middleware('guest:admin')->group(function() {
        Route::get('login', 'AuthenticatedSessionController@create')->name('login');
        Route::post('login', 'AuthenticatedSessionController@store')->name('adminlogin');
        Route::get('forgot-password', 'PasswordResetLinkController@create')->name('password.request');
        Route::post('forgot-password', 'PasswordResetLinkController@store')
                ->name('password.email');
    });
    Route::get('/reload-captcha', 'Auth\AuthenticatedSessionController@reloadCaptcha');
    Route::middleware('admin')->group(function() {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('configuration', 'AdminController@configuration')->name('configuration');
        Route::post('configuration', 'AdminController@configurationStore')->name('configuration');
        Route::get('settings', 'AdminController@settings')->name('settings');
        Route::post('settings', 'AdminController@settingsStore')->name('settings');
        Route::get('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');
        Route::get('account', 'AdminController@account')->name('account');
        Route::post('account', 'AdminController@accountpost')->name('adminpostaccount');
        Route::get('accountpassword', 'AdminController@accountpassword')->name('accountpassword');
        Route::post('accountpassword', 'AdminController@accountpasswordpost')->name('accountpasswordpost');
        Route::get('cms', 'AdminController@cmslist')->name('cms');
        Route::get('cmsadd', 'AdminController@cmsadd')->name('cmsadd');
        Route::get('cmsadd/{id}', 'AdminController@cmsadd')->name('cmsadd2');
        Route::post('cmsaddpost', 'AdminController@cmsaddpost')->name('cmsaddpost');
        Route::post('cmsaddpost/{id}', 'AdminController@cmsaddpost')->name('cmsaddpost');
        Route::get('cmsdelete/{id}', 'AdminController@cmsdelete')->name('cmsdelete');
        Route::get('user/{type}', 'AdminController@userlist')->name('userlist');
        Route::get('useredit/{id}', 'AdminController@useredit')->name('useredit');
        Route::post('usereditpost/{id}', 'AdminController@usereditpost')->name('usereditpost');
        Route::get('userview/{id}', 'AdminController@userview')->name('userview');
    });
});