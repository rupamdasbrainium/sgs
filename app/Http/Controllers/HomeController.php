<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jorenvh\Share\Share;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Configuration;
use PhpParser\Node\Stmt\Continue_;
use Illuminate\Support\Facades\Cookie;
use Validator;


class HomeController extends Controller
{

    private function getfranchiseId()
    {
        $franchiseId = 3;
        return $franchiseId;
    }
    public function index($short_code = null)
    {
        $lang_id = getLocale();
        $data = array();
        $data['title'] = trans('title_message.Home');

        //franchise call
        $franchises = APICall("Franchises", "get", "{}");
        $data['franchises'] = json_decode($franchises);
        $data['short_code'] = $short_code;
        $franchise_id = '';
        $categoryHomePage = '';

        //find franchise_id
        $short_code_flag = 0;
        foreach ($data['franchises']->data as $key => $franchise) {
            if (!$short_code) {
                $franchise_id = $franchise->id;
                $categoryHomePage = $franchise->categoryHomePage;
                $short_code = $franchise->shortCode;
                $short_code_flag = 1;
                $data['franchise_address'] = $franchise->address_civic_number . ' ' . $franchise->address_street . ' ' . $franchise->address_city;
                break;
            }
            if ($franchise->shortCode == $short_code) { //actual
                $franchise_id = $franchise->id;
                $data['franchise_address'] = $franchise->address_civic_number . ' ' . $franchise->address_street . ' ' . $franchise->address_city;
                break;
            }
        }
        if (!$franchise_id) {
            return redirect()->route('homepage');
        }
        Cookie::queue(Cookie::make('driver_route_id', $short_code, 60000));
        Cookie::get('driver_route_id');

        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', $this->getfranchiseId())->first();
        $banner = Configuration::where('name', 'banner_image')->where('franchise_id', $this->getfranchiseId())->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', $this->getfranchiseId())->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', $this->getfranchiseId())->first();
        $theme_color_hover = Configuration::where('name', 'theme_color_hover')->where('franchise_id', $this->getfranchiseId())->first();
        $title = Configuration::where('name', 'title')->where('franchise_id', $this->getfranchiseId())->first();
        $subtitle = Configuration::where('name', 'subtitle')->where('franchise_id', $this->getfranchiseId())->first();
        $home_title = Configuration::where('name', 'home_title')->where('franchise_id', $this->getfranchiseId())->first();
        $home_magicplan = Configuration::where('name', 'home_magicplan')->where('franchise_id', $this->getfranchiseId())->first();
        $home_body = Configuration::where('name', 'home_body')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', $this->getfranchiseId())->first();
        $video = Configuration::where('name', 'video')->where('franchise_id', $this->getfranchiseId())->first();
        $title_fr = Configuration::where('name', 'title_fr')->where('franchise_id', 3)->first();
        $subtitle_fr = Configuration::where('name', 'subtitle_fr')->where('franchise_id', 3)->first();
        $home_title_fr = Configuration::where('name', 'home_title_fr')->where('franchise_id', 3)->first();
        $home_magicplan_fr = Configuration::where('name', 'home_magicplan_fr')->where('franchise_id', 3)->first();
        $home_body_fr = Configuration::where('name', 'home_body_fr')->where('franchise_id', 3)->first();
        $response = array(
            'message' => trans('title_message.Input_path_wrong'),
            'message_type' => 'danger',
        );

        if ($categoryHomePage == false) {
            $franchisesPlanType = APICall("SubscriptionPlans/types?franchise_id=" . $franchise_id . "&language_id=" . $lang_id, "get", "{}");
            $data['all_plan'] = $data['franchisesPlanType'] = json_decode($franchisesPlanType);

            //franchise best four plan
            $best_four_plan = APICall("SubscriptionPlans/franchises/" . $franchise_id, "get", "{}");
            $data['best_four_plan'] = json_decode($best_four_plan);

            //franchise best four plan details
            foreach ($data['all_plan']->data as $item) {
                if ($item->id == $data['best_four_plan']->data->subscriptionPlan1) {
                    $data['all_plan_data'][0] = $item;
                    continue;
                }
                if ($item->id == $data['best_four_plan']->data->subscriptionPlan2) {
                    $data['all_plan_data'][1] = $item;
                    continue;
                }
                if ($item->id == $data['best_four_plan']->data->subscriptionPlan3) {
                    $data['all_plan_data'][2] = $item;
                    continue;
                }
                if ($item->id == $data['best_four_plan']->data->subscriptionPlan4) {
                    $data['all_plan_data'][3] = $item;
                    continue;
                }
                $data['all_plan_data'][] = $item;
            }
            $isShowDirectionMenu = true;
            return view('front.home', compact('isShowDirectionMenu','data', 'franchise_id', 'logo', 'banner', 'button', 'theme', 'title', 'subtitle', 'home_magicplan', 'home_body', 'home_title', 'admin_phone', 'admin_address', 'lang_id', 'short_code_flag', 'theme_color_hover', 'title_fr', 'subtitle_fr', 'home_title_fr', 'home_magicplan_fr', 'home_body_fr'));
        } else {
            $categoryType = APICall("Options/categories?franchise_id=" . $franchise_id . "&language_id=" . $lang_id, "get", "{}");
            $data['category'] = json_decode($categoryType)->data;
            return view('front.homeBasedOnCategory', compact('data', 'franchise_id', 'logo', 'banner', 'button', 'theme', 'title', 'subtitle', 'home_magicplan', 'home_body', 'home_title', 'admin_phone', 'admin_address', 'lang_id', 'short_code_flag', 'theme_color_hover', 'video', 'title_fr', 'subtitle_fr', 'home_title_fr', 'home_magicplan_fr', 'home_body_fr'));
        }
    }

    public function categoryplan($id)
    {
        $lang_id = getLocale();
        $data = array();
        $data['title'] = trans('title_message.Home');

        //franchise call
        $franchises = APICall("Franchises", "get", "{}");
        $data['franchises'] = json_decode($franchises);
        $franchise_id = '';

        //find franchise_id
        $short_code_flag = 0;

        foreach ($data['franchises']->data as $key => $franchise) {
            $franchise_id = $franchise->id;
        }
        if (!$franchise_id) {
            return redirect()->route('sechomepage');
        }


        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', $this->getfranchiseId())->first();
        $banner = Configuration::where('name', 'banner_image')->where('franchise_id', $this->getfranchiseId())->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', $this->getfranchiseId())->first();
        $theme_color_hover = Configuration::where('name', 'theme_color_hover')->where('franchise_id', $this->getfranchiseId())->first();
        $secondary_theme_color_hover = Configuration::where('name', 'secondary_theme_color_hover')->where('franchise_id', $this->getfranchiseId())->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', $this->getfranchiseId())->first();
        $primary_button_color_hover = Configuration::where('name', 'primary_button_color_hover')->where('franchise_id', $this->getfranchiseId())->first();
        $title = Configuration::where('name', 'title')->where('franchise_id', $this->getfranchiseId())->first();
        $subtitle = Configuration::where('name', 'subtitle')->where('franchise_id', $this->getfranchiseId())->first();
        $home_title = Configuration::where('name', 'home_title')->where('franchise_id', $this->getfranchiseId())->first();
        $home_magicplan = Configuration::where('name', 'home_magicplan')->where('franchise_id', $this->getfranchiseId())->first();
        $home_body = Configuration::where('name', 'home_body')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', $this->getfranchiseId())->first();

        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', $this->getfranchiseId())->first();
        $banner = Configuration::where('name', 'banner_image')->where('franchise_id', $this->getfranchiseId())->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', $this->getfranchiseId())->first();
        $title_fr = Configuration::where('name', 'title_fr')->where('franchise_id', 3)->first();
        $subtitle_fr = Configuration::where('name', 'subtitle_fr')->where('franchise_id', 3)->first();
        $home_title_fr = Configuration::where('name', 'home_title_fr')->where('franchise_id', 3)->first();
        $home_magicplan_fr = Configuration::where('name', 'home_magicplan_fr')->where('franchise_id', 3)->first();
        $home_body_fr = Configuration::where('name', 'home_body_fr')->where('franchise_id', 3)->first();

        $response = array(
            'message' => trans('title_message.Input_path_wrong'),
            'message_type' => 'danger',
        );
        
        $categoryPlan = APICall("SubscriptionPlans/types/byCategories/" . $id . "?franchise_id=" . $franchise_id . "&language_id=" . $lang_id, "get", "{}");
        $data['all_plan_data'] = json_decode($categoryPlan)->data;

        $category_name = request()->name;
        return view('front.categoryPlan', compact('data', 'franchise_id', 'logo', 'banner', 'button', 'primary_button_color_hover', 'theme', 'title', 'subtitle', 'home_magicplan', 'home_body', 'home_title', 'admin_phone', 'admin_address', 'lang_id', 'short_code_flag', 'theme_color_hover', 'secondary_theme_color_hover', 'category_name', 'title_fr', 'subtitle_fr', 'home_title_fr', 'home_magicplan_fr', 'home_body_fr'));
    }

    public function login()
    {
        if (session()->has('clientToken')) {
            return redirect()->back();
        }
        $data = array();
        $data['title'] = trans('title_message.Login');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', $this->getfranchiseId())->first();
        $banner = Configuration::where('name', 'banner_image')->where('franchise_id', $this->getfranchiseId())->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', $this->getfranchiseId())->first();
        $theme_color_hover = Configuration::where('name', 'theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->first();
        $primary_button_color_hover = Configuration::where('name', 'primary_button_color_hover')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', $this->getfranchiseId())->first();
        return view('login', compact('data', 'logo', 'banner', 'button', 'primary_button_color_hover', 'theme', 'theme_color_hover', 'admin_address', 'admin_phone'));
    }

    public function forgotPassword()
    {
        $data = array();
        $data['title'] = trans('title_message.Forgot_Password');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', $this->getfranchiseId())->first();
        $button = Configuration::where('name', 'primary_button_color')->first();
        $primary_button_color_hover = Configuration::where('name', 'primary_button_color_hover')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', $this->getfranchiseId())->first();
        return view('forgotpassword', compact('data', 'logo', 'admin_address', 'admin_phone', 'button', 'primary_button_color_hover'));
    }

    public function forgotPasswordMessage()
    {
        $data = array();
        $data['title'] = trans('title_message.Forgot_Password');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', $this->getfranchiseId())->first();
        $button = Configuration::where('name', 'primary_button_color')->first();
        $primary_button_color_hover = Configuration::where('name', 'primary_button_color_hover')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', $this->getfranchiseId())->first();
        return view('forgot_password_message', compact('data', 'logo', 'admin_address', 'admin_phone', 'button', 'primary_button_color_hover'));
    }

    public function forgotPasswordsendmail(Request $request)
    {
        $user_name = $request->user_name;
        $wait_response = "true";
        $forgotPassword = APICall('Users/lost_password?user_name=' . $user_name . '&wait_response=' . $wait_response, "post", "{}");
        $data['forgotPassword'] = json_decode($forgotPassword);

        if ($data['forgotPassword']->error == null) {
            $response = array(
                'message' => trans('title_message.code_message'),
                'message_type' => 'success'
            );
            return redirect(route('forgotPasswordMessage'))->with($response);
        } else {
            $response = array(
                'message' => $data['forgotPassword']->error->message,
                'message_type' => 'danger'
            );
            return redirect()->back()->with($response);
        }
    }
    public function new_password_from_code($code)
    {
        $data = array();
        $data['title'] = trans('title_message.Forgot_Password');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', $this->getfranchiseId())->first();
        $button = Configuration::where('name', 'primary_button_color')->first();
        $primary_button_color_hover = Configuration::where('name', 'primary_button_color_hover')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', $this->getfranchiseId())->first();
        return view('new_password_from_code', compact('data', 'logo', 'admin_address', 'admin_phone', 'button', 'primary_button_color_hover','code'));
    }

    public function update_password_from_mail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userName' => 'required|string',
            'tempCode' => 'required|string',
            'newPassword' => 'required|min:8',

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }
        $userName = $request->userName;
        $tempCode = $request->tempCode;
        $newPassword = $request->newPassword;

        $updatePassword = APICall("Users/new_password_from_code?userName=" . $userName . "&tempCode=" . $tempCode .  "&newPassword=" . $newPassword, "put", "{}");
        $data['updatePassword'] = json_decode($updatePassword);

        if ($data['updatePassword']->error == null) {
            $response = array(
                'message' => trans('title_message.code_message_update'),
                'message_type' => 'success'
            );
            return redirect()->route('login')->with($response);
        } else {
            $response = array(
                'message' => $data['updatePassword']->error->message,
                'message_type' => 'danger'
            );
            return redirect()->back()->with($response);
        }
    }

    public function dashboard()
    {
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', $this->getfranchiseId())->first();
        $banner = Configuration::where('name', 'banner_image')->where('franchise_id', $this->getfranchiseId())->first();
        $client = APICall("Clients", 'get', "{}", "client_app");
        $client = json_decode($client);
        session()->put('language_id', $client->data->language_id);

        if ($client->data->language_id == 2) {
            $locale = 'en';
        } else {
            $locale = 'fr';
        }
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->route('myProfile', compact('logo', 'banner'));
    }

    public function termsAndCondition()
    {
        $data = array();
        $data['title'] = trans('title_message.Terms_Condition');
        $terms = DB::table('contents')->where('franchise_id', $this->getfranchiseId())->where('slug', 'terms')->where('status', 1)->first();
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', $this->getfranchiseId())->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', $this->getfranchiseId())->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', $this->getfranchiseId())->first();
        $banner = Configuration::where('name', 'banner_image')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', $this->getfranchiseId())->first();
        return view('front.termsAndCondition', compact('data', 'terms', 'logo', 'banner', 'admin_phone', 'admin_address','theme','theme_color_hover'));
    }
    public function privacyPolicy()
    {
        $data = array();
        $data['title'] = trans('title_message.Privacy_Policy');
        $privacy = DB::table('contents')->where('franchise_id', $this->getfranchiseId())->where('slug', 'privacy')->where('status', 1)->first();
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', $this->getfranchiseId())->first();
        $banner = Configuration::where('name', 'banner_image')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', $this->getfranchiseId())->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', $this->getfranchiseId())->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', $this->getfranchiseId())->first();
        return view('front.privacyPolicy', compact('data', 'privacy', 'logo', 'banner', 'admin_address', 'admin_phone','theme','theme_color_hover'));
    }
    public function law25()
    {
        $data = [];
        $data["title"] = "Law 25";
        $law = DB::table('contents')->where('franchise_id', $this->getfranchiseId())->where('slug', 'law')->where('status', 1)->first();
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', $this->getfranchiseId())->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', $this->getfranchiseId())->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', $this->getfranchiseId())->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', $this->getfranchiseId())->first();
        return view('front.law25', compact('data', 'logo', 'law', 'admin_address', 'admin_phone','theme','theme_color_hover'));
    }
    public function planType($id)
    {
        $franchisesPlanType = APICall("SubscriptionPlans/types/" . $id, "get", "{}");
        $data = json_decode($franchisesPlanType);
        $html = '';
        $li = '';

        if (isset($data)) {
            foreach ($data->data as $value) {
                $html .= "<option value='" . $value->id . "'>" . $value->name_english . "</option>";
                $li .= "<li rel='" . $value->id . "'>" . $value->name_english . "</li>";
            }
        }
        return [$html, $li];
    }

    public function planTypeDetails($id)
    {

        $lang_id = getLocale();
        $franchisesPlanDetails = APICall("SubscriptionPlans/type/" . $id . "?language_id=" . $lang_id, "get", "{}");
        $data = json_decode($franchisesPlanDetails);
        $html = '';
        if (isset($data)) {
            foreach ($data->data->prices_per_durations as $value) {
                $html .= '<div class="prod_item">
                <div class="action_opt action_opt_title">

                    <div class="action_text">

                        <!-- Action 1
                        <div class="arrowdown">
                                <i class="far fa-chevron-down"></i>
                        </div> -->
                        <div class="selectcont ">
                            <div class="arrowdown2">
                                <i class="far fa-chevron-down"></i>
                            </div>
                            <select class="select_opt" >
                                <option value="Action1" selected>Action 1</option>
                                <option value="Action2" >Action 2</option>
                                <option value="Action3" >Action 3</option>
                                <option value="Action4" >Action 4</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="action_opt">
                    <div class="price_text">
                        $' . $value->price_initial . ' <span>/ ' . $value->duration_unit_display . '</span>
                    </div>
                    <p>per user/month,billed annually</p>
                </div>
                <div class="individual_opt">
                    <div class="individual_head">
                        For individual entrepreneurs
                    </div>
                    <div class="individual_des">
                        <ul>
                            <li><span><i class="far fa-check"></i></span>Monthly limit of 500 users</li>
                            <li><span><i class="far fa-check"></i></span>Monthly limit of 1500 orders</li>s
                            <li><span><i class="far fa-check"></i></span>Basic Financial Tools</li>
                            <li><span><i class="fal fa-times"></i></span>Email Support</li>
                            <li><span><i class="fal fa-times"></i></span>Email Support</li>
                            <li><span><i class="fal fa-times"></i></span>Email Support</li>
                        </ul>
                        <div class="subscribe_btn">
                            <a href="#" class="sub_btn">Subscribe</a>
                        </div>
                    </div>
                </div>
            </div>';
            }
        }
        return $html;
    }

    public function testhk()
    {
        $client = APICall("Clients", 'get', '{}', 'client_app');

        if (!$client) {
            return redirect()->route('login')->with('email', trans('title_message.login_token_expired'));
        }
    }
}
