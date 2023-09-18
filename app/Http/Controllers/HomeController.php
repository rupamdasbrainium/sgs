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
        $franchises = APICall("Franchises", "get","{}");
        $data['franchises'] = json_decode($franchises);

        // $api = '{
        //     "error": null,
        //     "isErrorConnString": false,
        //     "data": [
        //       {
        //         "id": 3,
        //         "name": "Centre Démo",
        //         "phone": "(450) 348-9170",
        //         "email": "ismael@isma.ca",
        //         "address_civic_number": "246",
        //         "address_street": "Saint-Jacques",
        //         "address_appartment": "",
        //         "address_city": "Saint-Jean-sur-Richelieu",
        //         "address_postal_code": "J2W 2A3",
        //         "address_province_id": 6,
        //         "categoryHomePage": false
        //       }
        //     ]
        // }';
        // $data['franchises'] = json_decode($api);
        // dd($data);
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

    public function dashboard () {
        return redirect()->route('homepage');
    }
}
