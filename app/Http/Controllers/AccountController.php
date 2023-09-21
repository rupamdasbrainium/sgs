<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function account () {
        $data = array();
        $data['title'] = 'My Account';
        return view('front.account', compact('data'));
    }

    public function changeLanguage () {
        $data = array();
        $data['title'] = 'Change Language';
        return view('front.changelanguage', compact('data'));
    }

    public function changePassword () {
        $data = array();
        $data['title'] = 'Change Password';
        return view('front.changepassword', compact('data'));
    }

    public function myProfile () {
        $data = array();
        $data['title'] = 'My Profile';
        return view('front.myprofile', compact('data'));
    }

    public function myContactInformation () {
        $data = array();
        $data['title'] = 'My Contact Information';
        return view('front.mycontactinformation', compact('data'));
    }

    public function myBankCards () {
        $data = array();
        $data['title'] = 'My Credit Card/Bank Account';
        return view('front.mybankcards', compact('data'));
    }

    public function payMyOutstandingBalance () {
        $data = array();
        $data['title'] = 'Pay My Outstanding Balance';
        return view('front.paymyoutstandingbalance', compact('data'));
    }
}
