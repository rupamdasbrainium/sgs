<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index () {
        $data = array();
        $data['title'] = 'Home';
        return view('front.home', compact('data'));
    }

    public function login () {
        $data = array();
        $data['title'] = 'Login';
        return view('login', compact('data'));
    }
    public function forgotPassword () {
        $data = array();
        $data['title'] = 'Forgot Password';
        return view('forgotpassword', compact('data'));
    }
}
