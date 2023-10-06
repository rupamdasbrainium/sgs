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
        $data['title'] = trans('title_message.Manage_Offers');
        return view('admin.manageoffers', compact('data'));
    }

    public function manageEvents ()
    {
        $data = array();
        $data['data'] = array();
        $data['title'] = trans('title_message.Manage_Events');
        return view('admin.manageoffers', compact('data'));
    }

    public function chatMonitoring ()
    {
        $data = array();
        $data['data'] = array();
        $data['title'] = trans('title_message.Chat_Monitoring');
        return view('admin.manageoffers', compact('data'));
    }

    public function transactions ()
    {
        $data = array();
        $data['data'] = array();
        $data['title'] = trans('title_message.Transactions');
        return view('admin.manageoffers', compact('data'));
    }

    public function manageSubscribers ()
    {
        $data = array();
        $data['data'] = array();
        $data['title'] = trans('title_message.Manage_Subscribers');
        return view('admin.manageoffers', compact('data'));
    }

}
