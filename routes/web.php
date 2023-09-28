<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CMSController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\App;

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


Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

// Route::get('/',[HomeController::class,'index'])->name('homepage');
// Route::get('suscription-form', 'SuscriptionController@suscriptionform')->name('suscriptionform');
// Route::get('payment', 'PaymentController@payment')->name('payment');
Route::get('/planType/{id}',[HomeController::class,'planType']);
Route::get('/planTypeDetails/{id}',[HomeController::class,'planTypeDetails']);
Route::get('suscription-form/{id}', 'SuscriptionController@suscriptionform')->name('suscriptionform');
Route::get('new-membership/{id}', 'SuscriptionController@new_membership')->name('newMembershipfont');
Route::post('new-membership/{id}', 'SuscriptionController@new_membership_save')->name('newMembershipSave');
Route::post('suscription-form-save/{id}', 'SuscriptionController@suscriptionformsave')->name('suscriptionformSave');
Route::get('payment', 'PaymentController@payment')->name('payment');
Route::post('paymentSave', 'PaymentController@paymentSave')->name('paymentSave');
Route::get('addPayment', 'PaymentController@addPayment')->name('front.addPayment');
Route::post('paymentaddSave', 'PaymentController@paymentaddSave')->name('paymentaddSave');

Route::middleware('guest')->group(function () {
    // Routes for CustomerController
    Route::get('login', 'HomeController@login')->name('login');
    Route::post('login','Auth\AuthenticatedSessionController@store')->name('userLogin');
    Route::get('forgot-password', 'HomeController@forgotPassword')->name('forgotpassword');
    Route::get('logout', 'Auth\AuthenticatedSessionController@destroy')->name('userLogout');
});

Route::group(['middleware'=>'verifyToken'], function(){
    // Route::get('/', 'HomeController@index')->name('homepage');
    Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('account', 'AccountController@account')->name('account');
    Route::get('change-language', 'AccountController@changeLanguage')->name('changeLanguage');
    Route::post('languageUpdate',"AccountController@languageUpdate")->name('userLanguageUpdate');
    Route::post('mylanguagechange',"AccountController@mylanguagechange")->name('mylanguagechange');
    Route::get('change-password', 'AccountController@changePassword')->name('changePassword');

    Route::post('changePasswordUser', 'AccountController@changePasswordUser')->name('changePasswordUser');

    Route::get('myprofile', 'AccountController@myProfile')->name('myProfile');
    Route::get('my-contact-information', 'AccountController@myContactInformation')->name('myContactInformation');
    Route::post('my-contact-information',"AccountController@updateContactInformation")->name('user.update');
    Route::get('my-bank-cards', 'AccountController@myBankCards')->name('myBankCards');
    Route::get('pay-outstanding-balance', 'AccountController@payMyOutstandingBalance')->name('payMyOutstandingBalance');
    Route::get('new-membership', 'AccountController@newMembership')->name('newMembership');
    Route::get('upgrade-membership', 'AccountController@upgradeMembership')->name('upgradeMembership');
    Route::post('upgrademembershipsubmit', 'AccountController@upgrademembershipsubmit')->name('upgrademembershipsubmit');
    Route::get('upgrademembershipfinal', 'AccountController@upgrademembershipfinal')->name('upgrademembershipfinal');
    Route::post('upgrademembershipfinalsubmit', 'AccountController@upgrademembershipfinalsubmit')->name('upgrademembershipfinalsubmit');

    Route::get('referral-code', 'AccountController@referralCode')->name('referralCode');
    Route::get('new-membership', 'AccountController@newMembership')->name('newMembership');
    Route::get('new-membership-step-two/{id}', 'AccountController@newMembershipSteptwo')->name('newMembershipSteptwo');
    Route::post('new-membership-step-two/{id}', 'AccountController@newMembershipSteptwosubmit')->name('newMembershipSteptwosave');
    Route::get('new-membership-final', 'AccountController@newMembershipFinal')->name('newMembershipFinal');
    Route::post('new-membership-final', 'AccountController@newMembershipFinalSave')->name('newMembershipFinalsave');

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

Route::get('/{short_code}',[HomeController::class,'index'])->name('homepage');
