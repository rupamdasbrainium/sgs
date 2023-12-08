<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Models\Configuration;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function payment()
    {
        $lang_id = getLocale();
        $data = array();
        $data['title'] = trans('title_message.Subscription_Form');
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        $button = Configuration::where('name','primary_button_color')->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name','admin_phone')->where('franchise_id',3)->first();
        $admin_address = Configuration::where('name','admin_address')->where('franchise_id',3)->first();

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
        $uri .= "&date_begin=" . urlencode(Date("M Dd Y H:i:s") . " GMT");
        if (Session::has('franchise_id')) {
            $uri .= "&franchise_id=" . Session::get('franchise_id');
        }
        else{
            $message = array(
                'message' => trans('title_message.choose_plan_first'),
                'message_type' => 'danger',
              );
            return redirect()->route('homepage')->with($message);
        }
        if (Session::has('reference_Code')) {
            $uri .= "&reference_Code=" . Session::get('reference_Code');
        }
        if (Session::has('subscription_plan')) {
            $uri .= "&subscription_plan=" . Session::get('subscription_plan');
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
       
        $subscription_plan = APICall("SubscriptionPlans/type", "get", "{}");
        $data['subscription_plan'] = json_decode($subscription_plan);

        $card =  APICall("PaymentMethods/accepted_cards", "get", "{}", 'client_app');
        $data['card_types'] = json_decode($card);

        return view('front.paymentform', compact('data','logo','button','admin_phone','admin_address','primary_button_color_hover'));
    }

    public function paymentSave(Request $request)
    {
        if(Session::has('language_id')){
            $lang_id = Session::get('language_id');
        }else{
            $lang_id = getLocale();
        }
        if ($request->radio_group_pay == "bank_acc") {
        $validator = Validator::make($request->all(), [
            "transit_number" => "required|min:3|max:5",
            "institution" => "required|min:3",
            "account_number" => "required|min:5|max:12",
            "owner_names" => "required",
          
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }else{
            
        
            $formdata = array();
            $formdata['transit_number'] = $request->transit_number;
            $formdata['institution'] = $request->institution;
            $formdata['account_number'] = $request->account_number;
            $formdata['owner_name'] = $request->owner_names;
            $formdata['franchise_id'] = Session::get('franchise_id');
            $pay_methode_acc = APICall('PaymentMethods/account', "post", json_encode($formdata), 'client_app');
            $data['pay_methode_acc'] = json_decode($pay_methode_acc);
        
            if ($data['pay_methode_acc']->error != null) {
                $response = array(
                    'message' => $data['pay_methode_acc']->error->message,
                    'message_type' => 'danger'
                );
                return redirect()->back()->with($response)->withInput();
            }

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
            $membershipdata['account_id'] =  $data['pay_methode_acc']->data->id;
            

            $membership_with_bnk_acc = APICall('Memberships/with-bank-account?display_language_id=' . $lang_id, "post", json_encode($membershipdata), "client_app");
            $data['membership_with_bnk_acc'] = json_decode($membership_with_bnk_acc);
            
            if ($data['membership_with_bnk_acc']!= null && $data['membership_with_bnk_acc']->error != null) {
                $response = array(
                    'message' => $data['membership_with_bnk_acc']->error->message,
                    'message_type' => 'danger'
                );
                return redirect()->back()->with($response)->withInput();
            }

            $data["title"] = trans('title_message.My_Account'); 
            $response = array(
                'message' => trans('title_message.Payment_Successfull'),
                'message_type' => 'success',
              );
            
            return redirect()->route("myProfile")->with($response);
            } 
        } else {
            $validator = Validator::make($request->all(), [
                "four_digits_number" => "required|min:3|max:4",
                "pan" => "required|min:15|max:16",
                "expiry_month" => "required|min:1|max:2",
                "owner_name" => "required",
                "expiry_year" => "required|integer|min:2023|numeric"
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator);
            }else{
                if(Session::has('language_id')){
                    $lang_id = Session::get('language_id');
                        }else{
                            $lang_id = getLocale();
                        }
                $lang_id = Session::get('language_id');
            $carddata = array();
            $carddata['four_digits_number'] = $request->four_digits_number;
            $carddata['expire_year'] = $request->expiry_year;
            $carddata['expire_month'] = $request->expiry_month;
            $carddata['owner_name'] = $request->owner_name;
            $carddata['type_id'] = $request->type_id;
            $carddata['pan'] = $request->pan;
            if (Session::has('franchise_id')) {
                $carddata['franchise_id'] = Session::get('franchise_id');
                $pay_method_accc = APICall('PaymentMethods/card', "post", json_encode($carddata), 'client_app');
                $data['pay_method_accc'] = json_decode($pay_method_accc);

                if ($data['pay_method_accc']->error != null) {
                    $response = array(
                        'message' => $data['pay_method_accc']->error->message,
                        'message_type' => 'danger'
                    );
                    return redirect()->back()->with($response)->withInput();
                }


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
                $membershipcarddata['card_id'] = $data['pay_method_accc']->data->id;

                $membership_with_credit_card = APICall('Memberships/with-credit-card?display_language_id=' . $lang_id, "post", json_encode($membershipcarddata), "client_app");
                $data['membership_with_credit_card'] = json_decode($membership_with_credit_card);

                if ($data['membership_with_credit_card']!= null && $data['membership_with_credit_card']->error != null) {
                    $response = array(
                        'message' => $data['membership_with_credit_card']->error->message,
                        'message_type' => 'danger'
                    );
                    return redirect()->back()->with($response)->withInput();
                }
            }
            $response = array(
                'message' => trans('title_message.Payment_completed_succesfully'),
                'message_type' => 'success',
              );
            return redirect()->route("myProfile")->with($response);
        }
        }
    }


    public function addPayment()
    {
        $data = array();
        $data['title'] = trans('title_message.Add_Acoount');
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        $theme = Configuration::where('name','theme_color')->where('franchise_id',3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name','primary_button_color')->where('franchise_id',3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name','admin_phone')->where('franchise_id',3)->first();
        $admin_address = Configuration::where('name','admin_address')->where('franchise_id',3)->first();
        $client = APICall("Clients",'get',"{}",'client_app');
        if(!$client){
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);

        }

        $client = json_decode($client)->data;
        $uri = "Memberships/price-details?";
        $uri .=  "&display_language_id=" . getLocale();

        $membership_details = APICall($uri, "get", "{}", 'client_app');
        $data['membership_details'] = json_decode($membership_details);
        $card =  APICall("PaymentMethods/accepted_cards", "get", "{}", 'client_app');
        $data['card_types'] = json_decode($card);

        return view('front.addPayment', compact('data','logo','theme','theme_color_hover', 'button','primary_button_color_hover', 'admin_phone','admin_address'));
    }

    public function paymentaddSave(Request $request)
    {
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }
        
        if ($request->radio_group_pay == "bank_acc") {
            $validator = Validator::make($request->all(), [
                "transit_number" => "required|min:3|max:5",
                "institution" => "required|min:3",
                "account_number" => "required|min:5|max:12",
                "owner_names" => "required",
              
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }else{
            $formdata = array();
            $formdata['transit_number'] = $request->transit_number;
            $formdata['institution'] = $request->institution;
            $formdata['account_number'] = $request->account_number;
            $formdata['owner_name'] = $request->owner_names;


            if (Session::has('franchise_id')) {
                $formdata['franchise_id'] = Session::get('franchise_id');


            $pay_methode_acc = APICall('PaymentMethods/account', "post", json_encode($formdata), 'client_app');
            $data['pay_methode_acc'] = json_decode($pay_methode_acc); 
                } 
                if ( $data['pay_methode_acc']->error != null) {
                    $response = array(
                        'message' =>  $data['pay_methode_acc']->error->message,
                        'message_type' => 'danger'
                    );
                    return redirect()->back()->with($response)->withInput();
                }else{
              $response = array(
                'message' => trans('title_message.Bank_added_succesfully'),
                'message_type' => 'success',
              );
              return redirect(route("myBankCards"))->with($response);
            }
        }
        } else {
            $validator = Validator::make($request->all(), [
                "four_digits_number" => "required|min:3|max:4",
                "pan" => "required|min:15|max:16",
                "expiry_month" => "required|min:1|max:12|numeric",
                "owner_name" => "required",
                "expiry_year" => "required|integer|min:2023|numeric"
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }else{
                
            $carddata = array();

            $carddata['four_digits_number'] = $request->four_digits_number;
            $carddata['expire_year'] = $request->expiry_year;
            $carddata['expire_month'] = $request->expiry_month;
            $carddata['owner_name'] = $request->owner_name;
            $carddata['type_id'] = $request->type_id;
            $carddata['pan'] = $request->pan;
            if (Session::has('franchise_id')) {
                $carddata['franchise_id'] = Session::get('franchise_id');


                $pay_methods_account = APICall('PaymentMethods/card', "post", json_encode($carddata), 'client_app');
                $data['pay_methods_account'] = json_decode($pay_methods_account);                 
             }     
             if ($data['pay_methods_account']->error != null) {
                $response = array(
                    'message' =>  $data['pay_methods_account']->error->message,
                    'message_type' => 'danger'
                );
                return redirect()->back()->with($response)->withInput();
            }else{
                $response = array(
                  'message' => trans('title_message.Credit_card_added_succesfully'),
                  'message_type' => 'success',
                );
                return redirect(route("myBankCards"))->with($response);
        }
    }
}
}
}
