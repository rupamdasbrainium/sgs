<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\AdminUser;
use App\Models\User;
use App\Models\Configuration;

class AdminController extends Controller
{
    public function dashboard () {
        return redirect()->route('admin.configuration');
    }

    public function configuration () {
        $user = Auth::guard('admin')->user();
        $data = array();
        $data['user'] = $user;
        $data['data'] = [ 'identifier' => '', 'password' => '', 'gaccountno' => '' ];
        $result = Configuration::where('type', 'configuration')->get();
        if (count($result) > 0) {
            $data['data'] = getConfigurationValue($result);
        }
        $data['title'] = 'Admin Configuration';
        return view('admin.configuration', compact('data'));
    }

    public function configurationStore (Request $request) {
        $user = Auth::guard('admin')->user();
        $request->validate([
            'identifier' => 'required',
        ]);

        $input_data = $request->all();
        unset($input_data['_token']);
        foreach ($input_data as $key => $value) {
            $row_data = [
                'name' => $key,
                'value' => $value,
                'type' => 'configuration',
            ];
            Configuration::updateOrCreate(
                ['name' => $key], $row_data
            );
        }

        $response = array(
            'message' => 'Configuration successfully updated',
            'message_type' => 'success'
        );
        return redirect()->back()->with($response);
    }

    public function settings () {
        $user = Auth::guard('admin')->user();
        $data = array();
        $data['data'] = [ 'banner_image' => asset('admin/images/adminbanner_add.png'), 'logo_image' => asset('admin/images/logo.png'), 'theme_color' => '#5ADFC2', 'primary_button_color' => '#1D1D1B', 'secondary_button_color' => '#FFB11A', 'text_button_color' => '#575757' ];
        $result = Configuration::where('type', 'settings')->get();
        if (count($result) > 0) {
            $data['data'] = getConfigurationValue($result);
            if (isset($data['data']['banner_image'])) {
                $data['data']['banner_image'] = asset('upload/banner/' . $data['data']['banner_image']);
            } else {
                $data['data']['banner_image'] = asset('admin/images/adminbanner_add.png');
            }
            if (isset($data['data']['logo_image'])) {
                $data['data']['logo_image'] = asset('upload/banner/' . $data['data']['logo_image']);
            } else {
                $data['data']['logo_image'] = asset('admin/images/logo.png');
            }
        }
        $data['user'] = $user;
        $data['title'] = 'Admin Settings';
        return view('admin.settings', compact('data'));
    }

    public function settingsStore (Request $request) {
        $user = Auth::guard('admin')->user();
        /*$request->validate([
            'identifier' => 'required',
        ]);*/

        $input_data = $request->all();
        unset($input_data['_token']);
        unset($input_data['banner_image']);
        unset($input_data['logo_image']);
        foreach ($input_data as $key => $value) {
            $row_data = [
                'name' => $key,
                'value' => $value,
                'type' => 'settings',
            ];
            Configuration::updateOrCreate(
                ['name' => $key], $row_data
            );
        }

        if ($request->hasFile('banner_image')) {
            $allowedfileExtension = ['jpeg','jpg','png', 'gif'];
            $file = $request->file('banner_image');
            $file_type = $file->extension();
            if (in_array($file_type,$allowedfileExtension)) {
                $filename = time() . rand(11, 9999) . '.' . $file_type;
                $file->move(public_path('upload/banner'), $filename);
                $row_data = [
                    'name' => 'banner_image',
                    'value' => $filename,
                    'type' => 'settings',
                ];
                Configuration::updateOrCreate(
                    ['name' => 'banner_image'], $row_data
                );
            }
        }

        if ($request->hasFile('logo_image')) {
            $allowedfileExtension = ['jpeg','jpg','png', 'gif'];
            $file = $request->file('logo_image');
            $file_type = $file->extension();
            if (in_array($file_type,$allowedfileExtension)) {
                $filename = time() . rand(11, 9999) . '.' . $file_type;
                $file->move(public_path('upload/banner'), $filename);
                $row_data = [
                    'name' => 'logo_image',
                    'value' => $filename,
                    'type' => 'settings',
                ];
                Configuration::updateOrCreate(
                    ['name' => 'logo_image'], $row_data
                );
            }
        }

        $response = array(
            'message' => 'Settings successfully updated',
            'message_type' => 'success'
        );
        return redirect()->back()->with($response);
    }

    public function account () {
        $user = Auth::guard('admin')->user();
        $data = array();
        $data['data'] = '';
        $data['user'] = $user;
        // $data['id'] = $id;
        $data['title'] = 'Admin Account';
        $data['form_caption'] = 'Account Information';
        return view('admin.account', compact('data'));
    }

    public function accountPassword () {
        $user = Auth::guard('admin')->user();
        $data = array();
        $data['data'] = '';
        $data['user'] = $user;
        // $data['id'] = $id;
        $data['title'] = 'Admin Password';
        $data['form_caption'] = 'Change Password';
        return view('admin.password', compact('data'));
    }

    public function accountPost (Request $request) {
        $user = Auth::guard('admin')->user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);
        $filename = '';
        $row_data = AdminUser::where('id', $user->id)->first();
        $row_data->name = $request['name'];
        $row_data->email = $request['email'];
        $row_data->phone = $request['phone'];
        $row_data->filename = $filename;
        $row_data->save();
        $response = array(
            'message' => 'Account successfully updated',
            'message_type' => 'success'
        );
        return redirect()->back()->with($response);
    }

    public function accountPasswordPost (Request $request) {
        $user = Auth::guard('admin')->user();
        $request->validate([
            'old_password' => 'required|min:6',
            'password' => 'required|min:6',
            'cpassword' => 'required|min:6|same:password',
        ]);
        $row_data = AdminUser::where('id', $user->id)->first();
        if (password_verify($request['old_password'], $row_data->password)) {
            $row_data->password = Hash::make($request['password']);
            $row_data->save();
            $response = array(
                'message' => 'Account password successfully updated',
                'message_type' => 'success'
            );
            return redirect()->back()->with($response);
        } else {
            $response = array(
                'message' => 'Old password does not match',
                'message_type' => 'danger'
            );
            return redirect()->back()->with($response);
        }
    }

    public function cmsList () {
        $user = Auth::guard('admin')->user();
        $result = Content::where('deleted', 0)->get();
        $data = array();
        $data['data'] = $result;
        $data['user'] = $user;
        // $data['id'] = $id;
        $data['title'] = 'Content Management';
        $data['form_caption'] = 'Content Management';
        return view('admin.cmslist', compact('data'));
    }

    public function cmsAdd ($id = '') {
        $user = Auth::guard('admin')->user();
        $data = array();
        $data['data'] = '';
        $data['user'] = $user;
        $data['id'] = $id;
        $data['title'] = 'CMS Add';
        $data['form_caption'] = 'Add Form';
        if (!empty($id)) {
            $result = Content::where('deleted', 0)->where('id', $id)->first();
            if (empty($result)) {
                $response = array(
                    'message' => 'Content not found',
                    'message_type' => 'danger'
                );
                return redirect()->action('Admin\AdminController@cmslist')->with($response);
            }
            $data['data'] = $result;
            $data['title'] = 'CMS Edit';
            $data['form_caption'] = 'Edit Form';
            return view('admin.cmsadd2', compact('data'));
        } else {
            return view('admin.cmsadd', compact('data'));
        }
    }

    public function cmsAddPost (Request $request, $id = '') {
        if (!empty($id)) {
            $request->validate([
                'title' => 'required|unique:contents,title,' . $id,
                'body' => 'required',
                'slug' => 'required',
                'status' => 'required',
            ]);

            $row_data = Content::where('deleted', 0)->where('id', $id)->first();
            if (!empty($row_data)) {
                $row_data->title = $request['title'];
                $row_data->body = $request['body'];
                $row_data->slug = $request['slug'];
                $row_data->status = $request['status'];
                $row_data->save();
                $response = array(
                    'message' => 'CMS successfully updated',
                    'message_type' => 'success'
                );
            } else {
                $response = array(
                    'message' => 'CMS unable updated',
                    'message_type' => 'danger'
                );
            }
        } else {
            $request->validate([
                'title' => 'required|unique:contents,title',
                'body' => 'required',
                'slug' => 'required',
                'status' => 'required',
            ]);

            $row_data = new Content();
            $row_data->title = $request['title'];
            $row_data->body = $request['body'];
            $row_data->slug = $request['slug'];
            $row_data->status = $request['status'];
            $row_data->save();
            $response = array(
                'message' => 'CMS successfully added',
                'message_type' => 'success'
            );
        }

        return redirect()->action('Admin\AdminController@cmslist')->with($response);
    }

    public function cmsDelete (Request $request, $id = '') {
        if (!empty($id)) {
            $row_data = Content::where('deleted', 0)->where('id', $id)->delete();
            if ($row_data) {
                $response = array(
                    'message' => 'CMS successfully deleted',
                    'message_type' => 'success'
                );
            } else {
                $response = array(
                    'message' => 'CMS unable to delete',
                    'message_type' => 'danger'
                );
            }
        } else {
            $response = array(
                'message' => 'CMS unable to delete',
                'message_type' => 'danger'
            );
        }

        return redirect()->action('Admin\AdminController@cmslist')->with($response);
    }

    public function userList ($type = '') {
        $user = Auth::guard('admin')->user();
        $result = User::where('type', $type)->get();
        $data = array();
        $data['data'] = $result;
        $data['user'] = $user;
        $data['add_user'] = false;
        // $data['id'] = $id;
        if ($type == 'seller') {
            $data['title'] = 'Sellers List';
            $data['add_user'] = true;
        } else {
            $data['title'] = 'Buyers List';
        }
        $data['form_caption'] = 'Edit Form';
        return view('admin.userlist', compact('data'));
    }

    public function userEdit ($id) {
        $user = Auth::guard('admin')->user();
        $data = array();
        $data['data'] = '';
        $data['user'] = $user;
        $data['id'] = $id;
        $result = User::where('id', $id)->first();
        if (empty($result)) {
            $response = array(
                'message' => 'User not found',
                'message_type' => 'danger'
            );
            $ref = basename($_SERVER['HTTP_REFERER']);
            return redirect()->action('Admin\AdminController@userlist', $ref)->with($response);
        }
        $data['data'] = $result;
        $data['title'] = 'User Edit';
        $data['form_caption'] = 'Edit Form';
        return view('admin.useredit', compact('data'));
    }

    public function userEditPost (Request $request, $id) {
        $user = Auth::guard('admin')->user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        $filename = '';
        $row_data = User::where('id', $id)->first();
        $row_data->name = $request['name'];
        $row_data->email = $request['email'];
        $row_data->status = $request['status'];
        // $row_data->filename = $filename;
        $row_data->save();
        $response = array(
            'message' => 'User successfully updated',
            'message_type' => 'success'
        );
        return redirect()->action('Admin\AdminController@userlist', $row_data->type)->with($response);
    }

    public function userView ($id) {
        $user = Auth::guard('admin')->user();
        $data = array();
        $data['data'] = '';
        $data['user'] = $user;
        $data['id'] = $id;
        $result = User::where('id', $id)->first();
        if (empty($result)) {
            $response = array(
                'message' => 'User not found',
                'message_type' => 'danger'
            );
            $ref = basename($_SERVER['HTTP_REFERER']);
            return redirect()->action('Admin\AdminController@userlist', $ref)->with($response);
        }
        $data['data'] = $result;
        $data['title'] = 'User View';
        $data['form_caption'] = 'Edit View';
        return view('admin.userview', compact('data'));
    }

}
