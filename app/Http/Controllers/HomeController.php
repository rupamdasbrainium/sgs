<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public function index ($short_code) {
        $lang_id = getLocale();
        // $short_code = 'CentreDemo';
        $data = array();
        $data['title'] = 'Home';
        //franchise call
        $franchises = APICall("Franchises", "get","{}");
        $data['franchises'] = json_decode($franchises);
        $data['short_code'] = $short_code;
        $franchise_id = '';
        
        //find franchise_id
        foreach($data['franchises']->data as $franchise){
            if($franchise->shortCode == $short_code){
            $franchise_id = $franchise->id;
            break;
          }
          
        }
        $response = array(
            'message' => 'Input path is wrong',
          );

        if(!$franchise_id){
            return redirect(route('login'))->with($response);
        }

        // foreach($data['franchises']->data as $franchise){
        //     //   if($franchise->id == $short_code){
        //         if($franchise->name == $franchise_id){//actual
        //         $franchise_id = $franchise->id;
        //         break;
        //       }

        // if (Session::has('franchise_id')) {
        //     Session::forget('franchise_id');
        // }
        // Session::put('franchise_id',$franchise_id );
        
        //franchise plan type
        $franchisesPlanType = APICall("SubscriptionPlans/types?franchise_id=".$franchise_id, "get","{}");
        $data['franchisesPlanType'] = json_decode($franchisesPlanType);

        //franchise best four plan
        $best_four_plan = APICall("SubscriptionPlans/franchises/".$franchise_id, "get","{}");
        $data['best_four_plan'] = json_decode($best_four_plan);

        // $data_plan = [];
        //franchise best four plan details
        $data_plan[$data['best_four_plan']->data->subscriptionPlan1] = json_decode(APICall("SubscriptionPlans/type/".$data['best_four_plan']->data->subscriptionPlan1."?language_id=".$lang_id, "get","{}"));

        $data_plan[$data['best_four_plan']->data->subscriptionPlan2] = json_decode(APICall("SubscriptionPlans/type/".$data['best_four_plan']->data->subscriptionPlan2."?language_id=".$lang_id, "get","{}"));

        $data_plan[$data['best_four_plan']->data->subscriptionPlan3] = json_decode(APICall("SubscriptionPlans/type/".$data['best_four_plan']->data->subscriptionPlan3."?language_id=".$lang_id, "get","{}"));

        $data_plan[$data['best_four_plan']->data->subscriptionPlan4] = json_decode(APICall("SubscriptionPlans/type/".$data['best_four_plan']->data->subscriptionPlan4."?language_id=".$lang_id, "get","{}"));

        $data['best_four_plan_details'] = $data_plan;
        $best_four_plan_details=$data_plan;
        // dd($best_four_plan_details);


        // $language = APICall("/Options/languages", "get","{}");
        // $data['language'] = json_decode($language);

        return view('front.home', compact('data','best_four_plan_details','franchise_id'));

    }

    public function login () {
        $data = array();
        $data['title'] = 'Login';
        return view('login', compact('data'));
    }

    public function forgotPassword () {
        $data = array();
        $data['title'] = 'Forgot Password';
        return view('forgotpassword', compact('data'));
    }

    public function dashboard () {
        return redirect()->route('account');
    }

    public function termsAndCondition () {
        $data = array();
        $data['title'] = 'Terms and Condition';
        return view('front.termsAndCondition', compact('data'));
    }
    public function privacyPolicy () {
        $data = array();
        $data['title'] = 'Privacy Policy';
        return view('front.privacyPolicy', compact('data'));
    }
    public function planType($id){
        // $franchisesPlanType = '{ "error": null, "isErrorConnString": false, "data": [ { "id": 6, "name_english": "10 passages adulte", "name_french": "10 passages adulte" }, { "id": 12, "name_english": "6 mois Adulte", "name_french": "12 mois reg" }, { "id": 18, "name_english": "3 mois Adulte", "name_french": "3 mois" }]}';
        $franchisesPlanType = APICall("SubscriptionPlans/types/".$id, "get","{}");
        $data = json_decode($franchisesPlanType);
        $html = '';
        $li = '';
        if(isset($data)){
            foreach($data->data as $value){
                $html .= "<option value='".$value->id."'>".$value->name_english."</option>";
                $li .= "<li rel='".$value->id."'>".$value->name_english."</li>";
            }
        }
        return [$html,$li];
    }

    public function planTypeDetails($id){
       
        $franchisesPlanDetails = APICall("SubscriptionPlans/type/".$id, "get","{}");
        $data = json_decode($franchisesPlanDetails);
        $html = '';
        if(isset($data)){
            foreach($data->data->prices_per_durations as $value){
                // dd($value);
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
                        $'.$value->price_initial.' <span>/ '.$value->duration_unit_display.'</span>
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
                            <li><span><i class="far fa-check"></i></span>Monthly limit of 1500 orders</li>
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
}
