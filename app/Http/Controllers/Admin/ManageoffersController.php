<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\About_us;

class ManageoffersController extends Controller
{
    public function manageOffers ()
    {
        $data = array();
        $data['data'] = array();
        $data['title'] = 'Manage Offers';
        return view('admin.manageoffers', compact('data'));
    }

    public function manageEvents ()
    {
        $data = array();
        $data['data'] = array();
        $data['title'] = 'Manage Events';
        return view('admin.manageoffers', compact('data'));
    }

    public function chatMonitoring ()
    {
        $data = array();
        $data['data'] = array();
        $data['title'] = 'Chat Monitoring';
        return view('admin.manageoffers', compact('data'));
    }

    public function transactions ()
    {
        $data = array();
        $data['data'] = array();
        $data['title'] = 'Transactions';
        return view('admin.manageoffers', compact('data'));
    }

    public function manageSubscribers ()
    {
        $data = array();
        $data['data'] = array();
        $data['title'] = 'Manage Subscribers';
        return view('admin.manageoffers', compact('data'));
    }

}
