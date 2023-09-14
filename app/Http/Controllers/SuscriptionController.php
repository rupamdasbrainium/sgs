<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuscriptionController extends Controller
{
    public function suscriptionForm () {
        $data = array();
        $data['title'] = 'Suscriptionn Form';
        return view('front.suscriptionform', compact('data'));
    }
}
