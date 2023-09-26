<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class PaymentController extends Controller
{
    public function payment() {
        $data = array();
        $data['title'] = 'Suscriptionn Form';

        // return Date("Dd M Y H:i:s T");

        // //subscriptionplan type call
        // $subscription_plan = APICall("SubscriptionPlans/type/".$id, "get","{}");
        // $data['subscription_plan'] = json_decode($subscription_plan);

        // //franchise call
        // $franchises = APICall("Franchises", "get","{}");
        // $decodefranchises = json_decode($franchises);

        // //find franchise_id
        // $franchise_data = '';
        // foreach($decodefranchises->data as $franchise){
        //   if($franchise->id == $data['subscription_plan']->data->id_frinchise){
        //     $franchise_data = $franchise;
        //     break;
        //   }
        // }
        // $data['franchise'] = $franchise_data;
        // $token = '';
        // if (Session::has('duration_id')) {
        //     $token = Session::get('token');
        // }
        // https://sgsdev.softsgs.net/Memberships/price-details?subscription_plan_id=18&duration_id=5&installment_id=131&date_begin=Thu21%20Sep%202023%2011%3A34%3A23%20GMT&franchise_id=3&lstOptions=5&lstOptions=9&display_language_id=2

        $uri = "Memberships/price-details?";
        if (Session::has('subscription_plan_id')){
            $uri .= "subscription_plan_id=".Session::get('subscription_plan_id');
        }
        if (Session::has('duration_id')){
            $uri .= "&duration_id=".Session::get('duration_id');
        }
        // dd(Session::has('installments_id'));
        if (Session::has('installments_id')){
            $uri .= "&installment_id=".Session::get('installments_id');
        }
        // if (Session::has('installment_id')){
        //     $uri .= "&installment_id=".Session::get('installment_id');
        // }
        // $uri .= "&date_begin=".Date("Dd M Y H:i:s T");
        $uri .= "&date_begin=".urlencode(Date("M Dd Y H:i:s")." GMT");
        if (Session::has('franchise_id')){
            $uri .= "&franchise_id=".Session::get('franchise_id');
        }
        if (Session::has('reference_Code')){
            $uri .= "&reference_Code=".Session::get('reference_Code');
        }
        if (Session::has('add_on')){
            $add_ons = Session::get('add_on');
            foreach($add_ons as $ad_on_id){
                $uri .= "&lstOptions=".$ad_on_id;
            }
        }
        $uri .=  "&display_language_id=".getLocale();

        // if(Session::has('token')){
        //     $token = Session::get('token');
        // }

        $membership_details = APICall($uri, "get","{}", 'client_app');
        $data['membership_details'] = json_decode($membership_details);

        $subscription_plan = APICall("SubscriptionPlans/type", "get","{}");
        $data['subscription_plan'] = json_decode($subscription_plan);
        return view('front.paymentform', compact('data'));
    }

    public function paymentSave(Request $request) {

        $formdata = array();
        $formdata['transit_number'] = $request->transit_number;
        $formdata['institution'] = $request->institution;
        $formdata['account_number'] = $request->account_number;
        $formdata['owner_name'] = $request->owner_name;
        if (Session::has('franchise_id')){
            $formdata['franchise_id'] = Session::get('franchise_id');
        }

        // $pay_methode_acc = APICall('PaymentMethods/account', "post",json_encode($formdata));
        // $data['pay_methode_acc'] = json_decode($pay_methode_acc);

        // //PaymentMethods/accounts/client_id
        // $pay_methode_acc_client = APICall('PaymentMethods/accounts/', "get",json_encode($formdata));
        // $data['pay_methode_acc_client'] = json_decode($pay_methode_acc_client);

        // if(Session::has('token')){
        //     $token = Session::get('token');
        // }

        $pay_methode_acc = APICall('PaymentMethods/account', "post",json_encode($formdata), 'client_app');
        $data['pay_methode_acc'] = json_decode($pay_methode_acc);

        $get_methode_acc = APICall('PaymentMethods/accounts?clients='.$data['pay_methode_acc']->data->client_id, "get","{}", "client_app");
        $data['get_methode_acc'] = json_decode($get_methode_acc);


        //membership with bank account
        $membershipdata = array();
        $membershipdata['subscription_plan_id'] = $request->subscription_plan_id;
        if (Session::has('duration_id')){
            $membershipdata['duration_id'] = Session::get('duration_id');
        }
        if (Session::has('installment_id')){
            $membershipdata['installment_id'] = Session::get('installment_id');
        }

        $membershipdata['date_begin']  = $request->date_begin;


        if (Session::has('franchise_id')){
            $membershipdata['franchise_id'] = Session::get('franchise_id');
        }
        if (Session::has('add_on')){
            $add_ons = Session::get('add_on');
            foreach($add_ons as $ad_on_id){
                $membershipdata['lstOptions'][] = $ad_on_id;
            }
        }
        $membershipdata['code_promo'] = $request->code_promo;
        $membershipdata['account_id'] = $data['get_methode_acc']->data[0]->id;

        // {
        //     // "subscription_plan_id": 0,
        //     // "duration_id": 0,
        //     // "installment_id": 0,
        //     // "date_begin": "2023-09-21T11:39:08.178Z",
        //     // "franchise_id": 0,
        //     // "lstOptions": [
        //     //   0
        //     // ],
        //     // "code_promo": "string",
        //     "account_id": 0//nf
        //   }
     

        $membership_with_bnk_acc = APICall('Memberships/with-bank-account', "post",json_encode($membershipdata), "client_app");
        $data['membership_with_bnk_acc'] = json_decode($membership_with_bnk_acc);

        return $data;
    }
}
