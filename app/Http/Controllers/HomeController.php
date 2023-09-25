<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index ($short_code) {
        $short_code = 'CentreDemo';
        $data = array();
        $data['title'] = 'Home';
        //franchise call
        $franchises = APICall("Franchises", "get","{}");
        $data['franchises'] = json_decode($franchises);
        $data['short_code'] = $short_code;

        //find franchise_id
        foreach($data['franchises']->data as $franchise){
        //   if($franchise->id == $short_code){
            if($franchise->shortCode == $short_code){//actual
            $franchise_id = $franchise->id;
            break;
          }
        }

        //franchise plan type
        $franchisesPlanType = APICall("SubscriptionPlans/types?franchise_id=".$franchise_id, "get","{}");
        $data['franchisesPlanType'] = json_decode($franchisesPlanType);

        //franchise best four plan
        $best_four_plan = APICall("SubscriptionPlans/franchises/".$franchise_id, "get","{}");
        $data['best_four_plan'] = json_decode($best_four_plan);

        // $data_plan = [];
        //franchise best four plan details
        $data_plan[$data['best_four_plan']->data->subscriptionPlan1] = json_decode(APICall("SubscriptionPlans/type/".$data['best_four_plan']->data->subscriptionPlan1, "get","{}"));

        $data_plan[$data['best_four_plan']->data->subscriptionPlan2] = json_decode(APICall("SubscriptionPlans/type/".$data['best_four_plan']->data->subscriptionPlan2, "get","{}"));

        $data_plan[$data['best_four_plan']->data->subscriptionPlan3] = json_decode(APICall("SubscriptionPlans/type/".$data['best_four_plan']->data->subscriptionPlan3, "get","{}"));

        $data_plan[$data['best_four_plan']->data->subscriptionPlan4] = json_decode(APICall("SubscriptionPlans/type/".$data['best_four_plan']->data->subscriptionPlan4, "get","{}"));

        $data['best_four_plan_details'] = $data_plan;
        $best_four_plan_details=$data_plan;
        // dd($best_four_plan_details);

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
        // $franchisesPlanDetails = '{
        //     "error": null,
        //     "isErrorConnString": false,
        //     "data": {
        //       "id": 12,
        //       "name": "12 mois reg",
        //       "age_min": 0,
        //       "age_max": 120,
        //       "id_category": 2,
        //       "id_frinchise": 3,
        //       "prices_per_durations": [
        //         {
        //           "duration_id": 5,
        //           "duration_unit_id": 0,
        //           "duration_unit_display": "mois",
        //           "frequency": 12,
        //           "price_initial": 9.57,
        //           "price_recurant": 39.99,
        //           "installments": [
        //             {
        //               "id": 160,
        //               "number_of_payments": 6
        //             }
        //           ]
        //         }
        //       ],
        //       "options": [
        //         {
        //           "id": 5,
        //           "name": "Nouvelle/remplacement de carte d",
        //           "quantity": 1,
        //           "deliverable_quantity": 1,
        //           "price": 20,
        //           "is_initial": true
        //         },
        //         {
        //           "id": 7,
        //           "name": "12 seance d",
        //           "quantity": 1,
        //           "deliverable_quantity": 0,
        //           "price": 200,
        //           "is_initial": true
        //         },
        //         {
        //           "id": 8,
        //           "name": "24 séance d",
        //           "quantity": 1,
        //           "deliverable_quantity": 0,
        //           "price": 350,
        //           "is_initial": true
        //         },
        //         {
        //           "id": 9,
        //           "name": "Le package de 12 shake ",
        //           "quantity": 1,
        //           "deliverable_quantity": 12,
        //           "price": 12.55,
        //           "is_initial": true
        //         },
        //         {
        //           "id": 11,
        //           "name": "Gourde a l",
        //           "quantity": 1,
        //           "deliverable_quantity": 1,
        //           "price": 0,
        //           "is_initial": true
        //         },
        //         {
        //           "id": 13,
        //           "name": "Acces au cours de zumba",
        //           "quantity": 1,
        //           "deliverable_quantity": 1,
        //           "price": 7.5,
        //           "is_initial": true
        //         },
        //         {
        //           "id": 14,
        //           "name": "Accès au cours de spinning",
        //           "quantity": 1,
        //           "deliverable_quantity": 1,
        //           "price": 100,
        //           "is_initial": true
        //         },
        //         {
        //           "id": 15,
        //           "name": "Accès au cours de cardioboxe",
        //           "quantity": 1,
        //           "deliverable_quantity": 1,
        //           "price": 120,
        //           "is_initial": true
        //         },
        //         {
        //           "id": 16,
        //           "name": "Accès a tous les cours du centre 25$ par mois",
        //           "quantity": 1,
        //           "deliverable_quantity": 1,
        //           "price": 25,
        //           "is_initial": false
        //         },
        //         {
        //           "id": 17,
        //           "name": "block 50 minute",
        //           "quantity": 1,
        //           "deliverable_quantity": 50,
        //           "price": 10,
        //           "is_initial": true
        //         },
        //         {
        //           "id": 18,
        //           "name": "Yoga",
        //           "quantity": 1,
        //           "deliverable_quantity": 1,
        //           "price": 8.3,
        //           "is_initial": false
        //         },
        //         {
        //           "id": 19,
        //           "name": "Shake 5",
        //           "quantity": 1,
        //           "deliverable_quantity": 1,
        //           "price": 12.5,
        //           "is_initial": true
        //         },
        //         {
        //           "id": 20,
        //           "name": "Assurance annulation",
        //           "quantity": 1,
        //           "deliverable_quantity": 1,
        //           "price": 20,
        //           "is_initial": true
        //         },
        //         {
        //           "id": 21,
        //           "name": "tonus",
        //           "quantity": 1,
        //           "deliverable_quantity": 1,
        //           "price": 6.29,
        //           "is_initial": true
        //         }
        //       ],
        //       "inclusions": []
        //     }
        //   }';
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
