<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CMSController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

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

require __DIR__ . '/auth.php';

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    if (session()->has('clientToken')) {
        if ($locale == 'en') {
            $language_id = 2;
        } else {
            $language_id = 1;
        }
        APICall('Clients/language?language_id=' . $language_id, "put", "{}", 'client_app');
        session()->put('language_id', $language_id);
    }
    session()->put('locale', $locale);
    if(session()->has('message')){
        $data_array = [];
        $data_array['message'] = session()->get('message');
        if(session()->has('message_type')){
            $data_array['message_type'] = session()->get('message_type');
        }
        if(session()->has('message_raw')){
            $data_array['message'] = trans(session()->get('message_raw'));
        }
        return redirect()->back()->with($data_array);
    }
    return redirect()->back();
});

Route::get('/planType/{id}', [HomeController::class, 'planType']);
Route::get('/planTypeDetails/{id}', [HomeController::class, 'planTypeDetails']);
Route::get('/terms-and-condition', [HomeController::class, 'termsAndCondition'])->name('front.terms');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('front.privacy');
Route::get("/law-25", [HomeController::class, 'law25'])->name('front.law25');
Route::get('suscription-form/{id}', 'SuscriptionController@suscriptionform')->name('suscriptionform');
Route::get('new-membership/{id}', 'SuscriptionController@new_membership')->name('newMembershipfont');
Route::post('new-membership/{id}', 'SuscriptionController@new_membership_save')->name('newMembershipSave');
Route::post('suscription-form-save/{id}', 'SuscriptionController@suscriptionformsave')->name('suscriptionformSave');
Route::get('payment', 'PaymentController@payment')->name('payment');
Route::post('paymentSave', 'PaymentController@paymentSave')->name('paymentSave');
Route::get('addPayment', 'PaymentController@addPayment')->name('front.addPayment');
Route::post('paymentaddSave', 'PaymentController@paymentaddSave')->name('paymentaddSave');

Route::post('newmembershippaymentSave', 'AccountController@newmembershippaymentSave')->name('newmembershippaymentSave');

Route::middleware('guest')->group(function () {
    // Routes for CustomerController
    Route::get('login', 'HomeController@login')->name('login');
    Route::post('login', 'Auth\AuthenticatedSessionController@store')->name('userLogin');
    Route::get('forgot-password', 'HomeController@forgotPassword')->name('forgotpassword');
    Route::post('forgotPasswordsendmail', 'HomeController@forgotPasswordsendmail')->name('forgotPasswordsendmail');
    Route::get('new_password_from_code', 'HomeController@new_password_from_code')->name('new_password_from_code');
    Route::post('update_password_from_mail', 'HomeController@update_password_from_mail')->name('update_password_from_mail');
    Route::get('logout', 'Auth\AuthenticatedSessionController@destroy')->name('userLogout');
});

Route::group(['middleware' => 'verifyToken'], function () {
    Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('account', 'AccountController@account')->name('account');
    Route::get('change-language', 'AccountController@changeLanguage')->name('changeLanguage');
    Route::post('languageUpdate', "AccountController@languageUpdate")->name('userLanguageUpdate');
    Route::post('mylanguagechange', "AccountController@mylanguagechange")->name('mylanguagechange');
    Route::get('change-password', 'AccountController@changePassword')->name('changePassword');

    Route::post('changePasswordUser', 'AccountController@changePasswordUser')->name('changePasswordUser');

    Route::get('myprofile', 'AccountController@myProfile')->name('myProfile');
    Route::get('my-contact-information', 'AccountController@myContactInformation')->name('myContactInformation');
    Route::post('my-contact-information', "AccountController@updateContactInformation")->name('user.update');
    Route::get('my-bank-cards', 'AccountController@myBankCards')->name('myBankCards');
    Route::get('modify-bank/{id}', 'AccountController@modifyBanks')->name('modifyBanks');
    Route::get('modify-Card/{id}', 'AccountController@modifyCards')->name('modifyCards');
    Route::post('bank-update', 'AccountController@modifyBanksUpdate')->name('modifyBanksUpdate');
    Route::post('card-update', 'AccountController@modifyCardsUpdate')->name('modifyCardsUpdate');
    Route::get('pay-outstanding-balance', 'AccountController@payMyOutstandingBalance')->name('payMyOutstandingBalance');
    Route::post("pay-outstanding-balance", "AccountController@payOutstandingPayment")->name('payMyOutstandingBalance.post');
    Route::get('new-membership', 'AccountController@newMembership')->name('newMembership');
    Route::get('upgrade-membership', 'AccountController@upgradeMembership')->name('upgradeMembership');
    Route::get('upgragemembershipsubmit/card/{membership_id}/{card_id}', 'AccountController@upgragemembershipsubmit')->name('upgragemembershipsubmit');
    Route::get('upgragemembershipsubmit/account/{membership_id}/{account_id}', 'AccountController@upgragemembershipsubmitbank')->name('upgragemembershipsubmitbank');

    Route::get('referral-code', 'AccountController@referralCode')->name('referralCode');
    Route::get('new-membership', 'AccountController@newMembership')->name('newMembership');
    Route::get('new-membership-step-two/{id}', 'AccountController@newMembershipSteptwo')->name('newMembershipSteptwo');
    Route::post('new-membership-step-two/{id}', 'AccountController@newMembershipSteptwosubmit')->name('newMembershipSteptwosave');
    Route::get('new-membership-final', 'AccountController@newMembershipFinal')->name('newMembershipFinal');
    Route::post('new-membership-final', 'AccountController@newMembershipFinalSave')->name('newMembershipFinalsave');
    Route::get('renewMembership/{membershipsId}', 'AccountController@renewMembership')->name('renewMembership');
});

Route::get('/reload-captcha', 'Admin\Auth\AuthenticatedSessionController@reloadCaptcha');

// Admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->middleware('guest:admin')->group(function () {
        Route::get('login', 'AuthenticatedSessionController@create')->name('login');
        Route::post('login', 'AuthenticatedSessionController@store')->name('adminlogin');
        Route::get('forgot-password', 'PasswordResetLinkController@create')->name('password.request');
        Route::post('forgot-password', 'PasswordResetLinkController@store')
            ->name('password.email');
    });
    Route::get('/reload-captcha', 'Auth\AuthenticatedSessionController@reloadCaptcha');
    Route::middleware('admin')->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('configuration', 'AdminController@configuration')->name('configuration');
        Route::post('configuration', 'AdminController@configurationStore')->name('configuration');
        Route::get('settings', 'AdminController@settings')->name('settings');
        Route::post('settings', 'AdminController@settingsStore')->name('settings');

        Route::get('cmslistView', 'AdminController@cmslistView')->name('cmslistView');
        Route::get('cmsView', 'AdminController@cmsView')->name('cmsView');
        Route::get('cmsView/{id}', 'AdminController@cmsView')->name('editcms');
        Route::post('cmsViewPost', 'AdminController@cmsViewPost')->name('cmsViewPost');
        Route::post('cmsViewPost/{id}', 'AdminController@cmsViewPost')->name('cmsViewPost');
        Route::get('cmsdelete/{id}', 'AdminController@cmsdelete')->name('cmsdelete');

        Route::get('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');
        Route::get('account', 'AdminController@account')->name('account');
        Route::post('account', 'AdminController@accountpost')->name('adminpostaccount');
        Route::get('accountpassword', 'AdminController@accountpassword')->name('accountpassword');
        Route::post('accountpassword', 'AdminController@accountpasswordpost')->name('accountpasswordpost');
        Route::get('user/{type}', 'AdminController@userlist')->name('userlist');
        Route::get('useredit/{id}', 'AdminController@useredit')->name('useredit');
        Route::post('usereditpost/{id}', 'AdminController@usereditpost')->name('usereditpost');
        Route::get('userview/{id}', 'AdminController@userview')->name('userview');
    });
});

Route::get('/test', function () {
    $message = array(
        'message' => trans('auth.expired'),
        'message_type' => 'danger',
    );
    return redirect()->route('login')->with($message);
});


Route::get('/categoryplan/{category_id}', [HomeController::class, 'categoryplan'])->name('categoryplan');

Route::get('/{short_code?}', [HomeController::class, 'index'])->name('homepage');

