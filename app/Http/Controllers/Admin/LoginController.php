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
        return view('admin.login', compact('title','logo'));
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
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        // dd($data);
        if (Hash::check($request->password, $data->password)) {
           return redirect()->route('admin.dashboard','logo');
        }
        else{
           return redirect()->route('admin.login','logo');
        }
    }

    public function dashboard()
    {
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        return view('admin.dashboard','logo');
    }

    public function destroy()
    {

    }

    public function profile()
    {
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        return view('admin.profile','logo'); 
    }

    public function updatePassword()
    {
        return view('admin.password');
    }


}
