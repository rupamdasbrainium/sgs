<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Configuration;

class LoginController extends Controller
{
    public function index()
    {
        $title = trans('title_message.Admin_Login');
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        return view('admin.login', compact('title','logo','button','primary_button_color_hover'));
    }

    public function login(Request $request)
    {
        // dd($request);
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ]
        );

        $data= DB::table('admin_users')->where('name', $request->username)->first();
        // dd($data);
        if (Hash::check($request->password, $data->password)) {
           return redirect()->route('admin.dashboard');
        }
        else{
           return redirect()->route('admin.login');
        }
    }

    public function dashboard()
    {
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',3)->first();
        return view('admin.dashboard',compact('logo','button'));
    }

    public function destroy()
    {

    }

    public function profile()
    {
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',3)->first();
        return view('admin.profile',compact('logo','button')); 
    }

    public function updatePassword()
    {
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',3)->first();
        return view('admin.password',compact('logo','button'));
    }


}
