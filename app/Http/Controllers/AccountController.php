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
    public function account()
    {
        $data = array();

        $data['title'] = 'My Account';
        $client = APICall("Clients", 'get', "{}");
        if (!$client) {
            return redirect()->route('login')->with('email', "Your login token has been expired");
        }
        $client = json_decode($client)->data;


        $franchises = APICall("Franchises", "get","{}");
        $data['franchises'] = json_decode($franchises);
        $clients = APICall("Clients", "get","{}");
        $data['clients'] = json_decode($clients);

      

        foreach($data['franchises']->data as $franchise){
            if($franchise->name ==  $data['clients']->data->franchise_name){
            $franchise_id = $franchise->id;
            Session::put('franchise_id',$franchise_id);
          }
        }
dd( Session::get('franchise_id',$franchise_id));

        $membership = APICall('Memberships/client?display_language_id=' . $client->language_id, "get", "{}");
        $membership = json_decode($membership);
        if ($membership->data == null) {
            $membership = "";
        }

        //getting cards

        $response = APICall('PaymentMethods/cards', "get", "{}");
        $cards = json_decode($response);

        if (!$cards->error && $cards->data) {
            $data["cards"] = $cards->data;
        } else {
            $data['cards'] = null;
        }

        //gettting bank accounts;
        $response = APICall('PaymentMethods/accounts', "get", "{}");
        $bank = json_decode($response);

        if (!$bank->error && $bank->data) {
            $data["banks"] = $bank->data;
        } else {

            $data['banks'] = null;
        }

        $languages = APICall('Options/languages', "get", "{}");
        $languages = json_decode($languages);
        return view('front.account', compact('data', 'client', 'languages', 'membership'));
    }

    public function changeLanguage()
    {
        $data = array();
        $data['title'] = 'Change Language';
        $client = APICall("Clients",'get',"{}");
        if(!$client){
            return redirect()->route('login')->with('email', "Your login token has been expired");

        }

        $client = json_decode($client)->data;
        $language = APICall('Options/languages', "get", "{}");
        $data['language'] = json_decode($language);

        return view('front.changelanguage', compact('data'));
    }

    public function mylanguagechange(Request $request)
    {
        $data = array();
        $data['title'] = 'Change Language';
        $client = APICall("Clients",'get',"{}");
        if(!$client){
            return redirect()->route('login')->with('email', "Your login token has been expired");

        }

        $client = json_decode($client)->data;
        $language_id = (int)$request->display;
        // $carddata['iso_code'] = $request->type_id;
        // $carddata['display'] = $request->type_id;

        $language = APICall('Clients/language?language_id=' . $language_id, "put", "{}");
        $data['language'] = json_decode($language);


        $response = array(
            'message' => 'Language Changed succesfully',
        );

        return redirect(route("changeLanguage"))->with($response);
    }


    public function languageUpdate(Request $request)
    {
        try {
            //code...
            $language_id = (int)$request->language_id;

            APICall('Clients/language?language_id=' . $language_id, "put", "{}");
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withErrors(["error" => $th->getMessage()]);
        }
    }
    public function changePassword()
    {
        $data = array();
        $data['title'] = 'Change Password';
        $client = APICall("Clients",'get',"{}");
        if(!$client){
            return redirect()->route('login')->with('email', "Your login token has been expired");

        }

        $client = json_decode($client)->data;
        return view('front.changepassword', compact('data'));
    }

    public function changePasswordUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'new_password' => 'required|string',
            'con_password' => 'required|string|same:new_password',
        ]);
        if ($validator->fails()) {
            return back()->with('errors', $validator->messages()->all());
        }
        $data = array();
        $data['oldPassword'] = $request->old_password;
        $data['newPassword'] = $request->new_password;
        $clientIP = request()->ip();
        $data['from_ip'] = $clientIP;
        $new_password = APICall("Users/new_password", "post", json_encode($data), 'client_app');
        $data = json_decode($new_password);

        if ($data->error != null) {
            $response = array(
                'message' => 'wrong input',
                'message_type' => 'danger'
            );
            return redirect()->back()->with($response)->withInput();
        } else {
            return redirect()->back()->with('error', 'password not change');
        }

        $response = array(
            'message' => 'password Changed succesfully',
        );
        return redirect()->back()->with($response);
    }

    public function myProfile()
    {
        $data = array();
        $data['title'] = 'My Profile';
        $client = APICall("Clients", 'get', "{}");
        if (!$client) {
            return redirect()->route('login')->with('email', "Your login token has been expired");
        }

        $client = json_decode($client)->data;

        $membership = APICall('Memberships/client?display_language_id=' . $client->language_id, "get", "{}");
        $membership = json_decode($membership);
        if (!$membership->error && $membership->data) {
            $membership = $membership;
        } else {
            $membership = "";
        }
        // dd($membership);
        $payments = APICall('Payments/schedualed/client', "get", "{}");
        $payments = json_decode($payments);
        if (!empty($payments->data)) {
            $payments = $payments->data;
        } else {
            $payments = "";
        }
        $response = APICall('PaymentMethods/cards', "get", "{}");
        $cards = json_decode($response);

        if (!$cards->error && $cards->data) {
            $data["cards"] = $cards->data;
        } else {
            $data['cards'] = null;
        }

        //gettting bank accounts;
        $response = APICall('PaymentMethods/accounts', "get", "{}");
        $bank = json_decode($response);

        if (!$bank->error && $bank->data) {
            $data["banks"] = $bank->data;
        } else {

            $data['banks'] = null;
        }
        $languages = APICall('Options/languages', "get", "{}");
        $languages = json_decode($languages);
        return view('front.myprofile', compact('data', 'client', 'payments', 'languages', 'membership'));
    }

    public function myContactInformation()
    {
        $data = array();
        $data['title'] = 'My Contact Information';
        $client = APICall("Clients", "get", "{}");
        if ($client == "unauthorised") {
            return redirect()->route('login')->with('user', "Your login token has been expired");
        }

        $client = json_decode($client)->data;
        $province = APICall('Options/ProvincesAndStates', "get", "{}");
        if ($province == "unauthorised") {
            return redirect()->route('login')->with('user', "Your login token has been expired");
        }
        $province = json_decode($province);
        // dd($client);
        return view('front.mycontactinformation', compact('data', 'client', 'province'));
    }
    public function updateContactInformation(Request $request)
    {
        try {
            //code...

            $validator = Validator::make($request->all(), [
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'is_male' => 'required',
                "civic_number" => 'required|string',
                "street" => 'required|string',
                "appartment" => 'required|string',
                "city" => 'required|string',
                'postal_code' => 'required|string',
                "province_id" => "required|string",
                "phone" => "required|string",
                "cellphone" => "required|string",
                "emergency_phone" => "required|string",
                "emergency_contact" => "required|string",


            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();;
            }

            $franchises = APICall('Franchises', "get", "{}");

            $franchises = json_decode($franchises);
            $franchise_id = 0;
            foreach ($franchises->data as $fr) {

                if ($fr->name == $request->franchise_name) {
                    $franchise_id = $fr->id;
                }
            }
            $clients = APICall("Clients", "get", "{}");

            $clients = json_decode($clients)->data;
            $address = [
                "civic_number" => $request->civic_number,
                "street" => $request->street,
                "appartment" => $request->appartment,
                "city" => $request->city,
                "postal_code" => $request->postal_code,
                "province_id" => $request->province_id,

            ];
            $data = [
                "firstname" => $request->firstname,
                "lastname" => $request->lastname,
                "is_male" => $request->is_male,
                "phone" => $request->phone,
                "cellphone" => $request->cellphone,
                "emergency_phone" => $request->emergency_phone,
                "emergency_contact" => $request->emergency_contact,
                "adress" => $address,
                "driver_license" => $clients->driver_license ? $clients->driver_license :  "",
                "occupation" => $clients->nativeRef_number ? $clients->nativeRef_number :  "",
                "nativeRef_number" => $clients->nativeRef_number ? $clients->nativeRef_number :  "",
            ];

            $response = APICall("Clients/" . $franchise_id, "put", json_encode($data));

            $response = json_decode($response);
            if (!$response->error) {
                return redirect()->route('myContactInformation')->with('success', "Contact information updated successfully");
            } else {
                return redirect()->route('myContactInformation')->with('failed', "Contact information updated failed");
            }
        } catch (\Throwable $th) {

            return redirect()->route('myContactInformation')->with('failed', $th->getMessage());
        }
    }



    public function payMyOutstandingBalance()
    {
        $data = array();
        $data['title'] = 'Pay My Outstanding Balance';
        $response =  APICall('Payments/schedualed/client', "get", "{}");
        if ($response == "") {
            return redirect()->route('login')->withErrors(["user" => "Session Expired. Please login again"]);
        }
        $payments = json_decode($response);
        if ($payments->error == null) {
            $data["payments"] = $payments->data;

            $data["outstandingAmount"] = 0;
            foreach ((array)$data["payments"] as $v2) {
                if (!$v2->is_paid) {
                    $data["outstandingAmount"] += (float)$v2->amount;
                }
            };
        } else {
            $data["payments"] = null;
        }
        $banks = APICall("PaymentMethods/accounts", "GET", "{}");
        $banks = json_decode($banks);
        if ($banks->error == null) {
            $data["banks"] = $banks->data;
            $data["client_id"] = $data["banks"][0]->client_id;
        } else {
            $data["banks"] = null;
        }
        $cards = APICall("PaymentMethods/cards", "GET", "{}");
        $cards = json_decode($cards);
        if ($cards->error == null) {
            $data["cards"] = $cards->data;
            $data["client_id"] = $data["cards"][0]->client_id;
        } else {
            $data["cards"] = null;
        }
        return view('front.paymyoutstandingbalance', compact('data'));
    }

    public function payOutstandinfPayment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "payment_method_id" => "required",
            "totalAmount" => "required|min:1",
            "payment_checkbox" => "required"
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {

            //credit card payment
            if ($request->payment_type == "credit_card") {
                $paymentIds = explode(",", $request->payment_ids);
                dd($paymentIds);
                $response = APICall("Payments?credit_card_id=" . $request->payment_method_id . "&amount=" . $request->totalAmount, "POST", json_encode($paymentIds), "client_app");
                $response = json_decode($response);

                if ($response->error == null) {
                    return redirect()->route('payMyOutstandingBalance')->with("success", "Payment Successfull");
                } else {
                    return redirect()->route('payMyOutstandingBalance')->withErrors(["error" => $response->message]);
                }
            }
            //bank account payment
            else {

                $response = APICall("Payments/client/" . $request->client_id . "/amount/" . $request->totalAmount, "POST", "{}", "client_app");
                $response = json_decode($response);
                if ($response->error == null) {
                    return redirect()->route('payMyOutstandingBalance')->with("success", "Payment Successfull");
                } else {
                    return redirect()->route('payMyOutstandingBalance')->withErrors(["error" => $response->message]);
                }
            }
        }
    }

    public function newMembership()
    {
        $data = array();
        $data['title'] = trans('newMembership.memberships');
        $client = APICall("Clients",'get',"{}");
        if(!$client){
            return redirect()->route('login')->with('email', "Your login token has been expired");

        }

        $client = json_decode($client)->data;
        if (Session::has('franchise_id')) {
            Session::forget('franchise_id');
        }
        Session::put('franchise_id', 3);
        $franchise_id = 3;
        //franchise get all plan
        $all_plan = APICall("SubscriptionPlans/types?franchise_id=" . $franchise_id, "get", "{}");
        $data['all_plan'] = json_decode($all_plan);

        //franchise best four plan details
        foreach ($data['all_plan']->data as $item) {
            $data['all_plan_details'][] = json_decode(APICall("SubscriptionPlans/type/" . $item->id, "get", "{}"));
        }
        return view('front.newmembershipStepOne', compact('data'));
    }

    public function newMembershipSteptwo($id)
    {
        $lang_id = getLocale();
        $data = array();
        $data['title'] = trans('newMembership.memberships').' '.trans('newMembership.option');
        $client = APICall("Clients",'get',"{}");
        if(!$client){
            return redirect()->route('login')->with('email', "Your login token has been expired");

        }

        $client = json_decode($client)->data;
        //subscriptionplan type call
        $subscription_plan = APICall("SubscriptionPlans/type/" . $id . "?language_id=" . $lang_id, "get", "{}");
        $data['subscription_plan'] = json_decode($subscription_plan);

        return view('front.newMembershipStepTwo', compact('data'));
    }

    public function newMembershipSteptwosubmit(Request $request, $id)
    {
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

        $duration_installments_arr = explode("|", $request->installments);
        Session::put('installments_id', $duration_installments_arr[1]);
        Session::put('duration_id', $duration_installments_arr[0]);

        if (Session::has('subscription_plan_id')) {
            Session::forget('subscription_plan_id');
        }
        Session::put('subscription_plan_id', $id);

        return redirect()->route('newMembershipFinal');
    }

    public function newMembershipFinal()
    {

        $lang_id = getLocale();
        $data = array();
        $data['title'] = trans('paymentForm.payments');
        $client = APICall("Clients",'get',"{}");
        if(!$client){
            return redirect()->route('login')->with('email', "Your login token has been expired");

        }

        $client = json_decode($client)->data;
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

        $card =  APICall("PaymentMethods/accepted_cards", "get", "{}", 'client_app');
        $data['card_types'] = json_decode($card);

        return view('front.newmembershipStepFinal', compact('data'));
    }

    public function newMembershipFinalSave(Request $request)
    {

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
            $membershipdata['account_id'] = $request->old_acc;

            $membership_with_bnk_acc = APICall('Memberships/with-bank-account', "post", json_encode($membershipdata), "client_app");
            $data['membership_with_bnk_acc'] = json_decode($membership_with_bnk_acc);
            return redirect()->route('myProfile');
        } else {
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
            $membershipcarddata['card_id'] = $request->old_card; //request card -id

            $membership_with_credit_card = APICall('Memberships/with-credit-card', "post", json_encode($membershipcarddata), "client_app");
            $data['membership_with_credit_card'] = json_decode($membership_with_credit_card);

                if( $data['membership_with_credit_card']->error!=null){
                    $response = array(
                              'message' => $data['pay_method_accc']->error->message,
                              'message_type' => 'danger'
                            );
                            return redirect()->back()->with($response)->withInput();
                }
                $response = array(
                    'message' => 'payment completed succesfully',
                  );
                return redirect(route("myProfile"))->with($response);

        }
    }

    public function upgradeMembership()
    {
        $data = array();
        $data['title'] = 'Upgrade Membership';
        $client = APICall("Clients", 'get', "{}");
        if (!$client) {
            return redirect()->route('login')->with('email', "Your login token has been expired");
        }
        $client = json_decode($client)->data;
        $lang_id = getLocale();
        $data['title'] = trans('newMembership.memberships') . ' ' . trans('newMembership.option');
        $membership = APICall('Memberships/client?display_language_id=' . $client->language_id, "get", "{}");
        $data['membership'] = json_decode($membership);

        $franchise_id = 3;
        //franchise get all plan
        $all_plan = APICall("SubscriptionPlans/types?franchise_id=" . $franchise_id, "get", "{}");
        $data['all_plan'] = json_decode($all_plan);

        foreach ($data['all_plan']->data as $item) {
            $data['subscription_plan'][] = json_decode(APICall("SubscriptionPlans/type/" . $item->id, "get", "{}"));
        }


        // $subscription_plan = APICall("SubscriptionPlans/type/", "get","{}");
        // $data['subscription_plan'] = json_decode($subscription_plan);

        $pay_methods_card = APICall('PaymentMethods/cards', "get", "{}", 'client_app');
        $data['pay_methods_card'] = json_decode($pay_methods_card);

        return view('front.upgrademembership', compact('data'));
    }


    public function upgrademembershipsubmit(Request $request)
    {

        if ($request->radio_group_pay == "bank_acc") {

            $membershipdata = array();
            $membershipdata['subscription_plan_id'] = $request->subscription_plan_id;
            if (Session::has('duration_id')) {
                $membershipdata['duration_id'] = Session::get('duration_id');
            }
            if (Session::has('installments_id')) {
                $membershipdata['installment_id'] = Session::get('installments_id');
            }
            if (Session::has('add_on')) {
                $add_ons = Session::get('add_on');
                foreach ($add_ons as $ad_on_id) {
                    $membershipcarddata['lstOptions'][] = $ad_on_id;
                }
            }
            $membershipdata['code_promo'] = $request->code_promo;
            $membershipdata['account_id'] = $request->old_acc;

            $membership_with_bnk_acc = APICall('Memberships/with-bank-account', "post", json_encode($membershipdata), "client_app");
            $data['membership_with_bnk_acc'] = json_decode($membership_with_bnk_acc);
            return redirect()->route('myProfile');
        } else {
            $membershipcarddata = array();
            $membershipcarddata['subscription_plan_id'] = $request->subscription_plan_id;
            if (Session::has('duration_id')) {
                $membershipcarddata['duration_id'] = Session::get('duration_id');
            }
            if (Session::has('installments_id')) {
                $membershipcarddata['installment_id'] = Session::get('installments_id');
            }
            if (Session::has('add_on')) {
                $add_ons = Session::get('add_on');
                foreach ($add_ons as $ad_on_id) {
                    $membershipcarddata['lstOptions'][] = $ad_on_id;
                }
            }
            $membershipcarddata['code_promo'] = $request->code_promo;
            $membershipcarddata['processed_amount'] = $request->processed_amount;
            $membershipcarddata['card_id'] = $request->old_card;

            $membership_with_credit_card = APICall('Memberships/with-credit-card', "post", json_encode($membershipcarddata), "client_app");
            $data['membership_with_credit_card'] = json_decode($membership_with_credit_card);

            return redirect()->route('myProfile');
        }
    }


    public function referralCode()
    {
        $data = array();
        $data['title'] = 'My Referral Code';
        $client = APICall("Clients", 'get', "{}");
        if (!$client) {
            return redirect()->route('login')->with('email', "Your login token has been expired");
        }
        $client = json_decode($client)->data;
        $referral = APICall('Clients', "get", "{}", 'client_app');
        $data['referral'] = json_decode($referral);

        return view('front.referralcode', compact('data'));
    }

    public function myBankCards()
    {
        $data = array();
        $data['title'] = 'My Credit Card/Bank Account';
        $client = APICall("Clients",'get',"{}");
        if(!$client){
            return redirect()->route('login')->with('email', "Your login token has been expired");

        }

        $client = json_decode($client)->data;
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

        return view('front.mybankcards', compact('data'));
    }

    public function modifyBanks($id)
{
    $data = array();
    $data['title'] = 'Modify Bank Account';
    $client = APICall("Clients",'get',"{}");
        if(!$client){
            return redirect()->route('login')->with('email', "Your login token has been expired");

        }
        $client = json_decode($client)->data;

            
    $pay_methods_acc = APICall('PaymentMethods/accounts', "get", "{}", 'client_app');
        $data['pay_methods_acc'] = json_decode($pay_methods_acc);
        $data["bank"] = array_map(function ($bank) use ($id) {
            if ($id == $bank->id) {
                return $bank;
            }
        }, (array)$data['pay_methods_acc']->data);
        $data["bank"] = array_filter($data["bank"]);
        $data["bank"] = array_values($data["bank"]);
        return view('front.modifyBanks', compact('data'));
    }

    public function modifyBanksUpdate(Request $request)
    {

    $formdata = array();
    $formdata['transit'] = $request->transit_number;
    $formdata['institution'] = $request->institution;
    $formdata['account_number'] = $request->account_number;
    $formdata['owner_name'] = $request->owner_names;

    $response = APICall("PaymentMethods/account", "put", json_encode($formdata), 'client_app');
    $response = json_decode($response);

    $response = array(
        'message' => 'Bank updated succesfully',
      );

    return redirect(route('myBankCards'))->with($response);  
}
    public function modifyCards($id)
    {
        $data = array();
        $data['title'] = 'Modify Card Account';
        $pay_methods_accc = APICall('PaymentMethods/Cards', "get", "{}", 'client_app');
        $data['pay_methods_accc'] = json_decode($pay_methods_accc);

        $data["card"] = array_map(function ($card) use ($id) {
            if ($id == $card->id) {
                return $card;
            }
        }, (array)$data['pay_methods_accc']->data);
        $data["card"] = array_filter($data["card"]);
        $data["card"] = array_values($data["card"]);

        return view('front.modifyCards', compact('data'));
    }

    public function modifyCardsUpdate(Request $request)
    {

        $formdata = array();
        $formdata['number_card'] = $request->four_digits_number;
        $formdata['expire_month'] = $request->expiry_month;
        $formdata['expire_year'] = $request->expiry_year;
        $formdata['owner_name'] = $request->owner_name;
        $formdata['pan'] = $request->pan;

        $response = APICall("PaymentMethods/card", "put", json_encode($formdata), 'client_app');
        $response = json_decode($response);
        $response = array(
            'message' => 'Card modified succesfully',
        );

        return redirect(route('myBankCards'))->with($response);
    }
}
