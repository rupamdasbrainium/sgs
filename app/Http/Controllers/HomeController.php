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


class HomeController extends Controller
{

    private function getfranchiseId(){
        $franchiseId = 3;
        return $franchiseId;
    }    
    public function index($short_code=null)
    {
        $lang_id = getLocale();
        // $short_code = 'CentreDemo';
        $data = array();
        $data['title'] = trans('title_message.Home');

    //     $shareButtons1 = \Share::page(
    //         'https://makitweb.com/datatables-ajax-pagination-with-search-and-sort-in-laravel-8/'
    //   )
    //   ->facebook()
    //   ->twitter()
    //   ->linkedin()
    //   ->telegram()
    //   ->reddit();
        //franchise call
        $franchises = APICall("Franchises", "get", "{}");
        $data['franchises'] = json_decode($franchises);
        $data['short_code'] = $short_code;
        $franchise_id = '';
        
        //find franchise_id
        $short_code_flag = 0;
        foreach ($data['franchises']->data as $key => $franchise) {
            if(!$short_code){
                $franchise_id = $franchise->id;
                $short_code = $franchise->shortCode;
                $short_code_flag = 1;
                break;
            }
            if ($franchise->shortCode == $short_code) { //actual
                $franchise_id = $franchise->id;
                break;
            }
        }
        if(!$franchise_id){
            return redirect()->route('homepage');
        }
      Cookie::queue(Cookie::make('driver_route_id', $short_code, 60000));
      Cookie::get('driver_route_id');
        
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$this->getfranchiseId())->first();
        $banner = Configuration::where('name','banner_image')->where('franchise_id',$this->getfranchiseId())->first();
        $theme = Configuration::where('name','theme_color')->where('franchise_id',$this->getfranchiseId())->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',$this->getfranchiseId())->first();
        $title = Configuration::where('name','title')->where('franchise_id',$this->getfranchiseId())->first();
        $subtitle = Configuration::where('name','subtitle')->where('franchise_id',$this->getfranchiseId())->first();  
        $home_title = Configuration::where('name','home_title')->where('franchise_id',$this->getfranchiseId())->first();
        $home_magicplan = Configuration::where('name','home_magicplan')->where('franchise_id',$this->getfranchiseId())->first();
        $home_body = Configuration::where('name','home_body')->where('franchise_id',$this->getfranchiseId())->first();
        $admin_phone = Configuration::where('name','admin_phone')->where('franchise_id',$this->getfranchiseId())->first();
        $admin_address = Configuration::where('name','admin_address')->where('franchise_id',$this->getfranchiseId())->first();
        
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$this->getfranchiseId())->first();
        $banner = Configuration::where('name','banner_image')->where('franchise_id',$this->getfranchiseId())->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',$this->getfranchiseId())->first();
        
        $response = array(
            'message' => trans('title_message.Input_path_wrong'),
          );

        // if (!$franchise_id) {
        //     return redirect(route('login'),compact('logo','banner','button','theme'))->with($response);
        // }


        //franchise plan type
        $franchisesPlanType = APICall("SubscriptionPlans/types?franchise_id=" . $franchise_id, "get", "{}");
        $data['franchisesPlanType'] = json_decode($franchisesPlanType);

        //franchise best four plan
        $best_four_plan = APICall("SubscriptionPlans/franchises/" . $franchise_id, "get", "{}");
        $data['best_four_plan'] = json_decode($best_four_plan);

        // $data_plan = [];
        //franchise best four plan details
        if($data['best_four_plan']->data->subscriptionPlan1){
            $data_plan[0] = json_decode(APICall("SubscriptionPlans/type/" . $data['best_four_plan']->data->subscriptionPlan1 . "?language_id=" . $lang_id, "get", "{}"));
            $data['all_plan_data'][0] = '';
        }

        if($data['best_four_plan']->data->subscriptionPlan2){
            $data_plan[1] = json_decode(APICall("SubscriptionPlans/type/" . $data['best_four_plan']->data->subscriptionPlan2 . "?language_id=" . $lang_id, "get", "{}"));
            $data['all_plan_data'][1] = '';
        }

        if($data['best_four_plan']->data->subscriptionPlan3){
            $data_plan[2] = json_decode(APICall("SubscriptionPlans/type/" . $data['best_four_plan']->data->subscriptionPlan3 . "?language_id=" . $lang_id, "get", "{}"));
            $data['all_plan_data'][2] = '';
        }

        if($data['best_four_plan']->data->subscriptionPlan4){
            $data_plan[3] = json_decode(APICall("SubscriptionPlans/type/" . $data['best_four_plan']->data->subscriptionPlan4 . "?language_id=" . $lang_id, "get", "{}"));
            $data['all_plan_data'][3] = '';
        }

        $all_plan = APICall("SubscriptionPlans/types?franchise_id=" . $franchise_id, "get", "{}");
        $data['all_plan'] = json_decode($all_plan);

        //franchise best four plan details
        foreach ($data['all_plan']->data as $item) {
            $all_plan_data_arr['descr_english'] = $item->descr_english;
            $all_plan_data_arr['descr_french'] = $item->descr_french;
            $all_plan_data_arr['ageLimit_english'] = $item->ageLimit_english;
            $all_plan_data_arr['ageLimit_french'] = $item->ageLimit_french;

            if($item->id == $data['best_four_plan']->data->subscriptionPlan1){
                $data['all_plan_data'][0] = $all_plan_data_arr;
                continue;
            }
            if($item->id == $data['best_four_plan']->data->subscriptionPlan2){
                $data['all_plan_data'][1] = $all_plan_data_arr;
                continue;
            } 
            if($item->id == $data['best_four_plan']->data->subscriptionPlan3){
                $data['all_plan_data'][2] = $all_plan_data_arr;
                continue;
            } 
            if($item->id == $data['best_four_plan']->data->subscriptionPlan4) {
                $data['all_plan_data'][3] = $all_plan_data_arr;
                continue;
            }
            $data_plan[] = json_decode(APICall("SubscriptionPlans/type/" . $item->id . "?language_id=" . $lang_id, "get", "{}"));
            $data['all_plan_data'][] = $all_plan_data_arr;
        }
        $best_four_plan_details = $data_plan;
        $data['best_four_plan_details'] = $data_plan;
       
        return view('front.home', compact('data', 'best_four_plan_details', 'franchise_id','logo','banner','button','theme','title','subtitle','home_magicplan','home_body','home_title','admin_phone','admin_address','lang_id','short_code_flag'));
    }

    public function login()
    {
        $data = array();
        $data['title'] = trans('title_message.Login');
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$this->getfranchiseId())->first();
        $banner = Configuration::where('name','banner_image')->where('franchise_id',$this->getfranchiseId())->first();
        $theme = Configuration::where('name','theme_color')->where('franchise_id',$this->getfranchiseId())->first();
        $button = Configuration::where('name','primary_button_color')->first();
        $admin_phone = Configuration::where('name','admin_phone')->where('franchise_id',$this->getfranchiseId())->first();
        $admin_address = Configuration::where('name','admin_address')->where('franchise_id',$this->getfranchiseId())->first();
        return view('login', compact('data','logo','banner','button','theme','admin_address','admin_phone'));
    }

    public function forgotPassword()
    {
        $data = array();
        $data['title'] = trans('title_message.Forgot_Password');
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$this->getfranchiseId())->first();
        return view('forgotpassword', compact('data','logo'));
    }

    public function dashboard()
    {
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$this->getfranchiseId())->first();
        $banner = Configuration::where('name','banner_image')->where('franchise_id',$this->getfranchiseId())->first();
        return redirect()->route('account',compact('logo','banner'));
    }

    public function termsAndCondition()
    {
        $data = array();
        $data['title'] = trans('title_message.Terms_Condition');
        $terms = DB::table('contents')->where('franchise_id',$this->getfranchiseId())->where('slug','terms')->where('status',1)->first();
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$this->getfranchiseId())->first();
        $banner = Configuration::where('name','banner_image')->where('franchise_id',$this->getfranchiseId())->first();
        $admin_phone = Configuration::where('name','admin_phone')->where('franchise_id',$this->getfranchiseId())->first();
        $admin_address = Configuration::where('name','admin_address')->where('franchise_id',$this->getfranchiseId())->first();
        return view('front.termsAndCondition', compact('data','terms','logo','banner','admin_phone','admin_address'));
    }
    public function privacyPolicy()
    {
        $data = array();
        $data['title'] = trans('title_message.Privacy_Policy');
        $privacy = DB::table('contents')->where('franchise_id',$this->getfranchiseId())->where('slug','privacy')->where('status',1)->first();
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$this->getfranchiseId())->first();
        $banner = Configuration::where('name','banner_image')->where('franchise_id',$this->getfranchiseId())->first();
        $admin_phone = Configuration::where('name','admin_phone')->where('franchise_id',$this->getfranchiseId())->first();
        $admin_address = Configuration::where('name','admin_address')->where('franchise_id',$this->getfranchiseId())->first();
        return view('front.privacyPolicy', compact('data','privacy','logo','banner','admin_address','admin_phone'));
    }
    public function law25()
    {
        $data = [];
        $data["title"] = "Law 25";
        $logo = Configuration::where('name','logo_image')->where('franchise_id',$this->getfranchiseId())->first();
        $admin_phone = Configuration::where('name','admin_phone')->where('franchise_id',$this->getfranchiseId())->first();
        $admin_address = Configuration::where('name','admin_address')->where('franchise_id',$this->getfranchiseId())->first();
        return view('front.law25', compact('data','logo','admin_address','admin_phone'));
    }
    public function planType($id)
    {
        // $franchisesPlanType = '{ "error": null, "isErrorConnString": false, "data": [ { "id": 6, "name_english": "10 passages adulte", "name_french": "10 passages adulte" }, { "id": 12, "name_english": "6 mois Adulte", "name_french": "12 mois reg" }, { "id": 18, "name_english": "3 mois Adulte", "name_french": "3 mois" }]}';
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
        if(isset($data)){
            foreach($data->data->prices_per_durations as $value){
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

    public function testhk() {
        $client = APICall("Clients",'get','{}','client_app');
        if(!$client){
            return redirect()->route('login')->with('email', trans('title_message.login_token_expired'));

        }
    }


            //  public function socialshare(){
    
            //        // Share button 1
            //        $shareButtons1 = \Share::page(
            //              'https://makitweb.com/datatables-ajax-pagination-with-search-and-sort-in-laravel-8/'
            //        )
            //        ->facebook()
            //        ->twitter()
            //        ->linkedin()
            //        ->telegram()
            //        ->reddit();
                   

            //        // Load index view
            //        return view('front.home') ->with('shareButtons1',$shareButtons1 );
            //  }
    }

