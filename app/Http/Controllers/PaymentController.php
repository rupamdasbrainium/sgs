<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payment () {
        $data = array();
        $data['title'] = 'Suscriptionn Form';
        return view('front.paymentform', compact('data'));
    }
}
