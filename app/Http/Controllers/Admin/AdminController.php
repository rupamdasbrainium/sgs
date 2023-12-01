<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\AdminUser;
use App\Models\User;
use App\Models\Content;
use App\Models\Configuration;
use Illuminate\Support\Facades\Validator;

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
        $result = Configuration::where('user_id', $user->id)->where('type', 'configuration')->get();
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$user->franchise_id)->first();
        $theme = Configuration::where('name','theme_color')->where('franchise_id',$user->franchise_id)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', $user->franchise_id)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',$user->franchise_id)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', $user->franchise_id)->first();
        if (count($result) > 0) {
            $data['data'] = getConfigurationValue($result);
        }
        $data['title'] = trans('title_message.Admin_Configuration');
        return view('admin.configuration', compact('data','logo','theme','theme_color_hover', 'button','primary_button_color_hover'));
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
                'user_id' => $user->id,
            ];
            Configuration::updateOrCreate(
                ['name' => $key], $row_data
            );
        }

        $response = array(
            'message' => trans('title_message.Configuration_successfully_updated'),
            'message_type' => 'success'
        );
        return redirect()->back()->with($response);
    }

    public function cmsView ($id = '') {
        $user = Auth::guard('admin')->user();
        $data = array();
        $data['user'] = $user;
        $data['id'] = $id;
        $data['data'] = [ 'title_en' => '', 'title_fr' => '', 'body_en' => '', 'body_fr' => '', 'slug' => '', 'status' => '' ];
        
        $data['title'] = trans('title_message.Admin_CMS');
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$user->franchise_id)->first();
        $theme = Configuration::where('name','theme_color')->where('franchise_id',$user->franchise_id)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',$user->franchise_id)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        if (!empty($id)) {
            $result = Content::where('deleted', 0)->where('id', $id)->where('franchise_id',$user->franchise_id)->first();
            if (empty($result)) {
                $response = array(
                    'message' => trans('title_message.Content_not_found'),
                    'message_type' => 'danger'
                );
                return redirect()->action('Admin\AdminController@cmslistView')->with($response);
            }
            $data['data'] = $result;
            $data['title'] = trans('title_message.Content_not_found');
            $data['form_caption'] = trans('title_message.Edit_Form');
            return view('admin.editcms', compact('data','logo','theme','button','theme_color_hover','primary_button_color_hover'));
        } else {
            return view('admin.cmsadd', compact('data','logo','theme','theme_color_hover', 'button','primary_button_color_hover'));
        }
            
    }

    public function cmsViewPost(Request $request, $id = ''){
        if (!empty($id)) {
            $request->validate([
                'entitle' => 'required|unique:contents,title_en,' . $id,
                'frtitle' => 'required|unique:contents,title_fr,' . $id,
                'body_english' => 'required',
                'body_french' => 'required',
                // 'slug' => 'required',
                // 'status' => 'required',
            ]);
           
            $row_data = Content::where('deleted', 0)->where('id', $id)->first();
            if (!empty($row_data)) {
                $row_data->title_en = $request['entitle'];
                $row_data->title_fr = $request['frtitle'];
                $row_data->body_en = $request['body_english'];
                $row_data->body_fr = $request['body_french'];
                // $row_data->slug = $request['slug'];
                // $row_data->status = $request['status'];
                $row_data->save();
                $response = array(
                    'message' => trans('title_message.CMS_successfully_updated'),
                    'message_type' => 'success'
                );

            } else {
                $response = array(
                    'message' => trans('title_message.CMS_unable_updated'),
                    'message_type' => 'danger'
                );
            }
        } else {
            $request->validate([
                'entitle' => 'required|unique:contents,title_en,' . $id,
                'frtitle' => 'required|unique:contents,title_fr,' . $id,
                'body_english' => 'required',
                'body_french' => 'required',
                // 'slug' => 'required',
                // 'status' => 'required',
            ]);
            $row_data = new Content();
            $row_data->title_en = $request['entitle'];
            $row_data->title_fr = $request['frtitle'];
            $row_data->body_en = $request['body_english'];
            $row_data->body_fr = $request['body_french'];
            $row_data->slug = $request['slug'];
            $row_data->status = $request['status'];
            $row_data->admin_user_id = Auth::guard('admin')->user()->id;
            $row_data->save();
            $response = array(
                'message' => trans('title_message.CMS_successfully_added'),
                'message_type' => 'success'
            );
        }

        return redirect()->action('Admin\AdminController@cmslistView')->with($response);
    }

    public function cmslistView () {
        $user = Auth::guard('admin')->user();
        $result = Content::where('deleted', 0)->get();
        // $result = array();
        $data = array();
        $data['data'] = $result;
        $data['user'] = $user;
        $data['title'] = trans('title_message.Content_Management');
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$user->franchise_id)->first();
        $theme = Configuration::where('name','theme_color')->where('franchise_id',$user->franchise_id)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',$user->franchise_id)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $data['form_caption'] = trans('title_message.Content_Management');
        return view('admin.cmslistView', compact('data','logo','theme','theme_color_hover', 'button','primary_button_color_hover'));
    }


    public function settings () {
        $user = Auth::guard('admin')->user();
        $data = array();
        $data['data'] = [ 'banner_image' => asset('public/admin/images/adminbanner_add.png'), 'logo_image' => asset('public/admin/images/logo.png'), 'theme_color' => '#5ADFC2','theme_color_hover' => '#5ADFC2','secondary_theme_color_hover' => '#1D1D1B','primary_button_color_hover' => '#1D1D1B', 'primary_button_color' => '#1D1D1B', 'secondary_button_color' => '#FFB11A', 'text_button_color' => '#575757' ];
        $result = Configuration::where('user_id', $user->id)->where('type', 'settings')->get();
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$user->franchise_id)->first();
        $theme = Configuration::where('name','theme_color')->where('franchise_id',$user->franchise_id)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id',$user->franchise_id)->first();
        $secondary_theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id',$user->franchise_id)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',$user->franchise_id)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id',$user->franchise_id)->first();
        $title = Configuration::where('name','title')->where('franchise_id',3)->first();
        $subtitle = Configuration::where('name','subtitle')->where('franchise_id',3)->first();
        $home_title = Configuration::where('name','home_title')->where('franchise_id',3)->first();
        $home_magicplan = Configuration::where('name','home_magicplan')->where('franchise_id',3)->first();
        $home_body = Configuration::where('name','home_body')->where('franchise_id',3)->first();
        $admin_phone = Configuration::where('name','admin_phone')->where('franchise_id',3)->first();
        $admin_address = Configuration::where('name','admin_address')->where('franchise_id',3)->first();
        $video = Configuration::where('name','video')->where('franchise_id',3)->first();
        $title_fr = Configuration::where('name','title_fr')->where('franchise_id',3)->first();
        $subtitle_fr = Configuration::where('name','subtitle_fr')->where('franchise_id',3)->first();
        $home_title_fr = Configuration::where('name','home_title_fr')->where('franchise_id',3)->first();
        $home_magicplan_fr = Configuration::where('name','home_magicplan_fr')->where('franchise_id',3)->first();
        $home_body_fr = Configuration::where('name','home_body_fr')->where('franchise_id',3)->first();
        if (count($result) > 0) {
            $data['data'] = getConfigurationValue($result);
            if (isset($data['data']['banner_image'])) {
                $data['data']['banner_image'] = asset('public/upload/banner/' . $data['data']['banner_image']);
            } else {
                $data['data']['banner_image'] = asset('public/admin/images/adminbanner_add.png');
            }
            if (isset($data['data']['logo_image'])) {
                $data['data']['logo_image'] = asset('public/upload/banner/' . $data['data']['logo_image']);
            } else {
                $data['data']['logo_image'] = asset('public/admin/images/logo.png');
            }
        }
        $data['user'] = $user;
        $data['title'] = trans('title_message.Admin_Settings');
        return view('admin.settings', compact('data','logo','theme','theme_color_hover', 'button','primary_button_color_hover', 'title','subtitle','home_title','home_magicplan','home_body','admin_address','admin_phone','video','title_fr','subtitle_fr','home_title_fr','home_magicplan_fr','home_body_fr','secondary_theme_color_hover'));
    }


    public function settingsStore (Request $request) {
        $user = Auth::guard('admin')->user();
            $validator = Validator::make($request->all(), [
                'logo_image'=>'mimes:jpg,png,jpeg,gif'
              ]);
              if ($validator->fails()) {
                return back()->withErrors($validator);
            }else{
        $input_data = $request->all();
       
        unset($input_data['_token']);
        unset($input_data['banner_image']);
        unset($input_data['logo_image']);
        foreach ($input_data as $key => $value) {
            $row_data = [
                'name' => $key,
                'value' => $value,
                'type' => 'settings',
                'user_id' => $user->id,
            ];
            Configuration::updateOrCreate(
                ['name' => $key], $row_data
            );
           
        }
    }

        if ($request->hasFile('banner_image')) {
            $validator = Validator::make($request->all(), [
                'banner_image'=>'mimes:jpg,png,jpeg,gif'
              ]);
              if ($validator->fails()) {
                return back()->withErrors($validator);
            }else{
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
                    'user_id' => $user->id,
                ];
                Configuration::updateOrCreate(
                    ['name' => 'banner_image'], $row_data
                );
            }
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
                    'user_id' => $user->id,
                ];
                Configuration::updateOrCreate(
                    ['name' => 'logo_image'], $row_data
                );   

            }
        }
        // $input_data = Configuration::where('franchise_id',3)->get();
        $input_data = new Configuration();
        $input_data->name = $request->title;
        $input_data->name = $request->title_fr;
        $input_data->name = $request->subtitle;
        $input_data->name = $request->subtitle_fr;
        $input_data->name = $request->home_title;
        $input_data->name = $request->home_title_fr;
        $input_data->name = $request->home_magicplan;
        $input_data->name = $request->home_magicplan_fr;
        $input_data->name = $request->home_body;
        $input_data->name = $request->home_body_fr;
        $input_data->name = $request->admin_phone;
        $input_data->name = $request->admin_address;
        // return view('header',compact('row_data'));
        $response = array(
            'message' => trans('title_message.Settings_successfully_updated'),
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
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$user->franchise_id)->first();
        $theme = Configuration::where('name','theme_color')->where('franchise_id',$user->franchise_id)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',$user->franchise_id)->first();
        $data['title'] = trans('title_message.Admin_Account');
        $data['form_caption'] = trans('title_message.Account_Information');
        return view('admin.account', compact('data','logo','theme','theme_color_hover', 'button'));
    }

    public function accountPassword () {
        $user = Auth::guard('admin')->user();
        $data = array();
        $data['data'] = '';
        $data['user'] = $user;
        // $data['id'] = $id;
        $data['title'] = trans('title_message.Admin_Password');
        $data['form_caption'] = trans('title_message.Change_Password');
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
            'message' => trans('title_message.Account_successfully_updated'),
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
                'message' => trans('title_message.Account_password_successfully_updated'),
                'message_type' => 'success'
            );
            return redirect()->back()->with($response);
        } else {
            $response = array(
                'message' => trans('title_message.Old_password_does_not_match'),
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
        $data['title'] = trans('title_message.Content_Management');
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$user->franchise_id)->first();
        $theme = Configuration::where('name','theme_color')->where('franchise_id',$user->franchise_id)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',$user->franchise_id)->first();
        $data['form_caption'] = trans('title_message.Content_Management');
        return view('admin.cmslist', compact('data','logo','theme','theme_color_hover', 'button'));
    }

    public function cmsAdd ($id = '') {
        $user = Auth::guard('admin')->user();
        $data = array();
        $data['data'] = '';
        $data['user'] = $user;
        $data['id'] = $id;
        $data['title'] = trans('title_message.CMS_Add');
        $data['form_caption'] = trans('title_message.Add_Form');
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$user->franchise_id)->first();
        $theme = Configuration::where('name','theme_color')->where('franchise_id',$user->franchise_id)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',$user->franchise_id)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        if (!empty($id)) {
            $result = Content::where('deleted', 0)->where('id', $id)->first();
            if (empty($result)) {
                $response = array(
                    'message' => trans('title_message.Content_not_found'),
                    'message_type' => 'danger'
                );
                return redirect()->action('Admin\AdminController@cmslist')->with($response);
            }
            $data['data'] = $result;
            $data['title'] = 'CMS Edit';
            $data['form_caption'] = 'Edit Form';
           
            return view('admin.cmsadd2', compact('data','logo','theme','theme_color_hover', 'button','primary_button_color_hover'));
        } else {
            return view('admin.cmsadd', compact('data','logo','theme','theme_color_hover', 'button','primary_button_color_hover'));
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
                    'message' => trans('title_message.CMS_successfully_updated'),
                    'message_type' => 'success'
                );
            } else {
                $response = array(
                    'message' => trans('title_message.CMS_unable_updated'),
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
                'message' => trans('title_message.CMS_successfully_added'),
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
                    'message' => trans('title_message.CMS_deleted'),
                    'message_type' => 'success'
                );
            } else {
                $response = array(
                    'message' => trans('title_message.CMS_unable_to_delete'),
                    'message_type' => 'danger'
                );
            }
        } else {
            $response = array(
                'message' => trans('title_message.CMS_unable_to_delete'),
                'message_type' => 'danger'
            );
        }
        return redirect()->action('Admin\AdminController@cmslistView')->with($response);
    }

    public function userList ($type = '') {
        $user = Auth::guard('admin')->user();
        $result = User::where('type', $type)->get();
        $data = array();
        $data['data'] = $result;
        $data['user'] = $user;
        $data['add_user'] = false;
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$user->franchise_id)->first();
        $theme = Configuration::where('name','theme_color')->where('franchise_id',$user->franchise_id)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',$user->franchise_id)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        if ($type == 'seller') {
            $data['title'] = trans('title_message.Sellers_List');
            $data['add_user'] = true;
        } else {
            $data['title'] = trans('title_message.Buyers_List');
        }
        $data['form_caption'] = trans('title_message.Edit_Form');
        return view('admin.userlist', compact('data','logo','theme','theme_color_hover', 'button','primary_button_color_hover'));
    }

    public function userEdit ($id) {
        $user = Auth::guard('admin')->user();
        $data = array();
        $data['data'] = '';
        $data['user'] = $user;
        $data['id'] = $id;
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$user->franchise_id)->first();
        $theme = Configuration::where('name','theme_color')->where('franchise_id',$user->franchise_id)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',$user->franchise_id)->first();
        $result = User::where('id', $id)->first();
        if (empty($result)) {
            $response = array(
                'message' => trans('title_message.User_not_found'),
                'message_type' => 'danger'
            );
            $ref = basename($_SERVER['HTTP_REFERER']);
            return redirect()->action('Admin\AdminController@userlist', $ref,compact('logo','theme','button','theme_color_hover'))->with($response);
        }
        $data['data'] = $result;
        $data['title'] = trans('title_message.User_Edit');
        $data['form_caption'] = trans('title_message.Edit_Form');
        return view('admin.useredit', compact('data','logo','theme','theme_color_hover'));
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
        $row_data->save();
        $response = array(
            'message' => trans('title_message.User_successfully_updated'),
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
                'message' => trans('title_message.User_not_found'),
                'message_type' => 'danger'
            );
            $ref = basename($_SERVER['HTTP_REFERER']);
            return redirect()->action('Admin\AdminController@userlist', $ref)->with($response);
        }
        $data['data'] = $result;
        $data['title'] = trans('title_message.User_View');
        $data['form_caption'] = trans('title_message.Edit_View');
        return view('admin.userview', compact('data'));
    }

}
