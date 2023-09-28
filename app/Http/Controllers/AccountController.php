<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function account () {
        $data = array();

        $data['title'] = 'My Account';
        $client = APICall("Clients",'get',"{}");
        if(!$client){
            return redirect()->route('login')->with('email', "Your login token has been expired");

        }

        $client = json_decode($client)->data;

        $membership = APICall('Memberships/client?display_language_id='.$client->language_id,"get","{}");
        // dd($membership);
        // $payments = APICall('Payments/schedualed/client',"get","{}");

        // if(!empty($payments->data)){
        //     $payments = json_decode($payments);
        // }else{
        //     $payments = "";
        // }
        $languages = APICall('Options/languages',"get","{}");
        $languages = json_decode($languages);
        return view('front.account', compact('data','client','languages'));
    }

    public function changeLanguage () {
        $data = array();
        $data['title'] = 'Change Language';

        $language = APICall('Options/languages', "get", "{}", 'client_app');
        $data['language'] = json_decode($language);

        return view('front.changelanguage', compact('data'));
    }

    public function languageUpdate(Request $request){
        try {
            //code...
            $language_id = (int)$request->language_id;

            APICall('Clients/language?language_id='.$language_id,"put","{}");
            return redirect()->back();

        } catch (\Throwable $th) {
            //throw $th;
            return back()->withErrors(["error" => $th->getMessage()]);
        }
    }
    public function changePassword () {
        $data = array();
        $data['title'] = 'Change Password';
        return view('front.changepassword', compact('data'));
    }

    public function changePasswordUser (Request $request) {

        $validator = Validator::make($request->all(),[
            'old_password'=>'required|string',
            'new_password'=>'required|string',
            'con_password'=>'required|string|same:new_password',
        ]);
        if($validator->fails()){
            return back()->with('errors', $validator->messages());
        }
        $data = array();
        // $data['title'] = 'Change Password';
        $data['oldPassword'] = $request->old_password;
        $data['newPassword'] = $request->new_password;
        $clientIP = request()->ip();
        $data['from_ip'] = $clientIP;
        // dd($clientIP);

        $new_password = APICall("Users/new_password", "post", json_encode($data), 'client_app');
        $data = json_decode($new_password);
        // dd($data);
        return view('front.changepassword', compact('data'));
        // return redirect()->back()->with('success','password change successfully');
    }

    public function myProfile () {
        $data = array();
        $data['title'] = 'My Profile';
        $client = APICall("Clients",'get',"{}");
        if(!$client){
            return redirect()->route('login')->with('email', "Your login token has been expired");
        }

        $client = json_decode($client)->data;

        $membership = APICall('Memberships/client?display_language_id='.$client->language_id,"get","{}");
        // dd($membership);
        $payments = APICall('Payments/schedualed/client',"get","{}");
        $payments = json_decode($payments);
        if(!empty($payments->data)){
            $payments = $payments->data;
        }else{
            $payments = "";
        }
        $languages = APICall('Options/languages',"get","{}");
        $languages = json_decode($languages);
        return view('front.myprofile', compact('data', 'client','payments','languages'));
    }

    public function myContactInformation () {
        $data = array();
        $data['title'] = 'My Contact Information';
        $client = APICall("Clients", "get","{}");
        if($client == "unauthorised"){
            return redirect()->route('login')->with('user',"Your login token has been expired");
        }
        
        $client = json_decode($client)->data;
        $province = APICall('Options/ProvincesAndStates', "get", "{}");
        if($province == "unauthorised"){
            return redirect()->route('login')->with('user',"Your login token has been expired");
        }
        $province = json_decode($province);
        // dd($client);
        return view('front.mycontactinformation', compact('data','client','province'));
    }
    public function updateContactInformation(Request $request){
            try {
                //code...

                $validator = Validator::make($request->all(),[
                    'firstname'=>'required|string',
                    'lastname'=>'required|string',
                    'is_male'=>'required',
                    "civic_number"=>'required|string',
                    "street"=>'required|string',
                    "appartment"=>'required|string',
                    "city"=>'required|string',
                    'postal_code'=>'required|string',
                    "province_id" =>"required|string",
                    "phone"=>"required|string",
                    "cellphone" => "required|string",
                    "emergency_phone" => "required|string",
                    "emergency_contact" => "required|string",


                ]);
                if($validator->fails()){
                    return back()->withErrors($validator)
                    ->withInput();;
                }

                $franchises = APICall('Franchises',"get","{}");

                $franchises = json_decode($franchises);
                $franchise_id = 0;
                foreach($franchises->data as $fr){

                    if($fr->name == $request->franchise_name){
                        $franchise_id = $fr->id;
                    }
                }
                $clients = APICall("Clients","get","{}");

                $clients = json_decode($clients)->data;
                $address = [
                    "civic_number"=>$request->civic_number,
                    "street"=>$request->street,
                    "appartment" => $request->appartment,
                    "city" => $request->city,
                    "postal_code"=>$request->postal_code,
                    "province_id"=> $request->province_id,

                ];
                $data = [
                    "firstname"=>$request->firstname,
                    "lastname"=>$request->lastname,
                    "is_male"=>$request->is_male,
                    "phone"=>$request->phone,
                    "cellphone"=>$request->cellphone,
                    "emergency_phone"=>$request->emergency_phone,
                    "emergency_contact"=>$request->emergency_contact,
                    "adress"=>$address,
                    "driver_license" => $clients->driver_license ? $clients->driver_license :  "",
                    "occupation" => $clients->nativeRef_number ? $clients->nativeRef_number :  "",
                    "nativeRef_number" => $clients->nativeRef_number ? $clients->nativeRef_number :  "",
                ];

                $response = APICall("Clients/".$franchise_id, "put", json_encode($data));

                $response = json_decode($response);
                if(!$response->error){
                    return redirect()->route('myContactInformation')->with('success', "Contact information updated successfully");
                }else{
                    return redirect()->route('myContactInformation')->with('failed', "Contact information updated failed");
                }

            } catch (\Throwable $th) {
                dd($th);
               return redirect()->route('myContactInformation')->with('failed', $th->getMessage());
            }
    }

    public function myBankCards () {
        $data = array();
        $data['title'] = 'My Credit Card/Bank Account';

        $uri = "Memberships/price-details?";
        if (Session::has('owner_name')) {
            $uri .= "owner_name=" . Session::get('owner_name');
        }
        if (Session::has('duration_id')) {
            $uri .= "&duration_id=" . Session::get('duration_id');
        }
        if (Session::has('subscription_plan')) {
            $uri .= "&subscription_plan=" . Session::get('subscription_plan');
        }
        $uri .=  "&display_language_id=" . getLocale();

      
        $pay_methods_acc = APICall('PaymentMethods/accounts', "get", "{}", 'client_app');
        $data['pay_methods_acc'] = json_decode($pay_methods_acc);

        $pay_methods_accc = APICall('PaymentMethods/cards', "get", "{}", 'client_app');
        $data['pay_methods_accc'] = json_decode($pay_methods_accc);
        // dd( $data['pay_methods_accc']);

        return view('front.mybankcards', compact('data'));
    }

    public function payMyOutstandingBalance () {
        $data = array();
        $data['title'] = 'Pay My Outstanding Balance';
        return view('front.paymyoutstandingbalance', compact('data'));
    }

    public function newMembership () {
        $data = array();
        $data['title'] = trans('newMembership.memberships');

        //franchise best four plan
        // $best_four_plan = APICall("SubscriptionPlans/franchises/".$franchise_id, "get","{}");
        // $data['best_four_plan'] = json_decode($best_four_plan);
        $franchise_id =3;
        //franchise get all plan
        $all_plan = APICall("SubscriptionPlans/types?franchise_id=".$franchise_id, "get","{}");
        $data['all_plan'] = json_decode($all_plan);

        // $data_plan = [];
        //franchise best four plan details
        foreach($data['all_plan']->data as $item){
            $data['all_plan_details'][] = json_decode(APICall("SubscriptionPlans/type/".$item->id, "get","{}"));
        }
        // $data_plan[$data['best_four_plan']->data->subscriptionPlan1] = json_decode(APICall("SubscriptionPlans/type/".$data['best_four_plan']->data->subscriptionPlan1, "get","{}"));

        // $data_plan[$data['best_four_plan']->data->subscriptionPlan2] = json_decode(APICall("SubscriptionPlans/type/".$data['best_four_plan']->data->subscriptionPlan2, "get","{}"));

        // $data_plan[$data['best_four_plan']->data->subscriptionPlan3] = json_decode(APICall("SubscriptionPlans/type/".$data['best_four_plan']->data->subscriptionPlan3, "get","{}"));

        // $data_plan[$data['best_four_plan']->data->subscriptionPlan4] = json_decode(APICall("SubscriptionPlans/type/".$data['best_four_plan']->data->subscriptionPlan4, "get","{}"));

        // $data['best_four_plan_details'] = $data_plan;

        return view('front.newmembershipStepOne', compact('data'));
    }

    public function newMembershipSteptwo ($id) {
        $lang_id = getLocale();
        $data = array();
        $data['title'] = trans('newMembership.memberships').' '.trans('newMembership.option');

        //subscriptionplan type call
        $subscription_plan = APICall("SubscriptionPlans/type/".$id."?language_id=".$lang_id, "get","{}");
        $data['subscription_plan'] = json_decode($subscription_plan);

        return view('front.newmembershipStepTwo', compact('data'));
    }

    public function newMembershipSteptwosubmit (Request $request, $id) {
        // return $request->add_on;
        if (Session::has('add_on')) {
            Session::forget('add_on');
        }
        Session::put('add_on', $request->add_on);
        if (Session::has('installments_id')) {
            Session::forget('installments_id');
        }
        if (Session::has('duration_id')) {
            Session::forget('duration_id');
        }
        
        $duration_installments_arr = explode("|",$request->installments);
        Session::put('installments_id', $duration_installments_arr[1]);
        Session::put('duration_id', $duration_installments_arr[0]);

        if (Session::has('subscription_plan_id')) {
            Session::forget('subscription_plan_id');
        }
        Session::put('subscription_plan_id', $id);
        if (Session::has('franchise_id')) {
            Session::forget('franchise_id');
        }
        Session::put('franchise_id', $request->franchise_id); 
        
        return redirect()->route('newMembershipFinal');
    }

    public function newMembershipFinal () {

        $lang_id = getLocale();
        $data = array();
        $data['title'] = trans('paymentForm.payments');

        $uri = "Memberships/price-details?";
        if (Session::has('subscription_plan_id')) {
            $uri .= "subscription_plan_id=" . Session::get('subscription_plan_id');
        }
        if (Session::has('duration_id')) {
            $uri .= "&duration_id=" . Session::get('duration_id');
        }
        if (Session::has('installments_id')) {
            $uri .= "&installment_id=" . Session::get('installments_id');
        }
        
        // $uri .= "&date_begin=".Date("Dd M Y H:i:s T");
        $uri .= "&date_begin=" . urlencode(Date("M Dd Y H:i:s") . " GMT");
        if (Session::has('franchise_id')) {
            $uri .= "&franchise_id=" . Session::get('franchise_id');
        }
        if (Session::has('reference_Code')) {
            $uri .= "&reference_Code=" . Session::get('reference_Code');
        }
        
        if (Session::has('add_on')) {
            $add_ons = Session::get('add_on');
            foreach ($add_ons as $ad_on_id) {
                $uri .= "&lstOptions=" . $ad_on_id;
            }
        }
        $uri .=  "&display_language_id=" . $lang_id;

        $membership_details = APICall($uri, "get", "{}", 'client_app');
        $data['membership_details'] = json_decode($membership_details);

        $pay_methods_acc = APICall('PaymentMethods/accounts', "get", "{}", 'client_app');
        $data['pay_methods_acc'] = json_decode($pay_methods_acc);

        $pay_methods_card = APICall('PaymentMethods/cards', "get", "{}", 'client_app');
        $data['pay_methods_card'] = json_decode($pay_methods_card);

        
        return view('front.newmembershipStepFinal', compact('data'));
    }

    public function newMembershipFinalSave (Request $request) {

        if ($request->radio_group_pay == "bank_acc") {
            //membership with bank account
            $membershipdata = array();
            $membershipdata['subscription_plan_id'] = $request->subscription_plan_id;
            if (Session::has('duration_id')) {
                $membershipdata['duration_id'] = Session::get('duration_id');
            }
            if (Session::has('installments_id')) {
                $membershipdata['installment_id'] = Session::get('installments_id');
            }

            $membershipdata['date_begin']  = $request->date_begin;
            if (Session::has('franchise_id')) {
                $membershipdata['franchise_id'] = Session::get('franchise_id');
            }
            if (Session::has('add_on')) {
                $add_ons = Session::get('add_on');
                foreach ($add_ons as $ad_on_id) {
                    $membershipdata['lstOptions'][] = $ad_on_id;
                }
            }
            $membershipdata['code_promo'] = $request->code_promo;
            // $membershipdata['account_id'] = $data['get_methode_acc']->data[0]->id;
            $membershipdata['account_id'] = $request->old_acc;

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
            $membership_with_bnk_acc = APICall('Memberships/with-bank-account', "post", json_encode($membershipdata), "client_app");
            $data['membership_with_bnk_acc'] = json_decode($membership_with_bnk_acc);
            return redirect()->route('newMembership');
        }else{
            $membershipcarddata = array();
                $membershipcarddata['subscription_plan_id'] = $request->subscription_plan_id;
                if (Session::has('duration_id')) {
                    $membershipcarddata['duration_id'] = Session::get('duration_id');
                }
                if (Session::has('installments_id')) {
                    $membershipcarddata['installment_id'] = Session::get('installments_id');
                }
                $membershipcarddata['date_begin'] = $request->date_begin;
                if (Session::has('franchise_id')) {
                    $membershipcarddata['franchise_id'] = Session::get('franchise_id');
                }
                if (Session::has('add_on')) {
                    $add_ons = Session::get('add_on');
                    foreach ($add_ons as $ad_on_id) {
                        $membershipcarddata['lstOptions'][] = $ad_on_id;
                    }
                }
                $membershipcarddata['code_promo'] = $request->code_promo;
                $membershipcarddata['processed_amount'] = $request->processed_amount;
                // $membershipcarddata['card_id'] = $data['pay_method_accc']->data->id;//request card -id
                $membershipcarddata['card_id'] = $request->old_card;//request card -id

                $membership_with_credit_card = APICall('Memberships/with-credit-card', "post", json_encode($membershipcarddata), "client_app");
                $data['membership_with_credit_card'] = json_decode($membership_with_credit_card);
                // if($data['membership_with_credit_card']->error == null){

                // }
                return redirect()->route('newMembership');
        }
    }

    public function upgradeMembership () {
        $data = array();
        $data['title'] = 'Upgrade Membership';
        return view('front.upgrademembership', compact('data'));
    }

    public function referralCode () {
        $data = array();
        $data['title'] = 'My Referral Code';
        return view('front.referralcode', compact('data'));
    }


}
