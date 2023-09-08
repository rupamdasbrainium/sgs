<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $title = "Admin Login";
        return view('admin.login', compact('title'));
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
        return view('admin.dashboard');
    }

    public function destroy()
    {

    }

    public function profile()
    {
        return view('admin.profile'); 
    }

    public function updatePassword()
    {
        return view('admin.password');
    }


}
