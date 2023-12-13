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
use App\Models\{
    Configuration,Content
    };

class AccountController extends Controller
{
    public function account()
    {
        $data = array();

        $data['title'] = trans('title_message.My_Account');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();
        $client = APICall("Clients", 'get', "{}" ,"client_app");
        if (!$client) {
            return redirect()->route('login')->withErrors(['user', trans('auth.expired')]);
        }
        $client = json_decode($client)->data;


        $franchises = APICall("Franchises", "get", "{}","client_app");
        $data['franchises'] = json_decode($franchises);
        $clients = APICall("Clients", "get", "{}","client_app");
        $data['clients'] = json_decode($clients);
        Session::put('language_id', $data['clients']->data->language_id);


        foreach ($data['franchises']->data as $franchise) {
            if ($franchise->name ==  $data['clients']->data->franchise_name) {
                $franchise_id = $franchise->id;
                Session::put('franchise_id', $franchise_id);
            }
        }

        $membership = APICall('Memberships/client?display_language_id=' . $client->language_id, "get", "{}","client_app");
        $membership = json_decode($membership);
        if ($membership->data == null) {
            $membership = "";
        }

        //getting cards

        $response = APICall('PaymentMethods/cards', "get", "{}","client_app");
        $cards = json_decode($response);

        if (!$cards->error && $cards->data) {
            $data["cards"] = $cards->data;
        } else {
            $data['cards'] = null;
        }

        //gettting bank accounts;
        $response = APICall('PaymentMethods/accounts', "get", "{}","client_app");
        $bank = json_decode($response);

        if (!$bank->error && $bank->data) {
            $data["banks"] = $bank->data;
        } else {

            $data['banks'] = null;
        }

        $languages = APICall('Options/languages', "get", "{}","client_app");
        $languages = json_decode($languages);
        return view('front.account', compact('data', 'client', 'languages', 'membership', 'logo', 'theme','theme_color_hover', 'button', 'admin_phone', 'admin_address'));
    }

    public function changeLanguage()
    {
        $data = array();
        $data['title'] = trans('title_message.Change_Language');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();
        $client = APICall("Clients", 'get', "{}","client_app");

        if (!$client) {
            $message = array(
                'message' => trans('auth.expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }

        $client = json_decode($client)->data;
        $language = APICall('Options/languages', "get", "{}","client_app");
        $data['language'] = json_decode($language);

        return view('front.changelanguage', compact('data', 'client', 'logo', 'theme','theme_color_hover', 'button','primary_button_color_hover', 'admin_phone', 'admin_address'));
    }

    public function mylanguagechange(Request $request)
    {
        $data = array();
        $data['title'] = trans('title_message.Change_Language');
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }

        $client = json_decode($client)->data;
        $language_id = (int)$request->display;

        $language = APICall('Clients/language?language_id=' . $language_id, "put", "{}", 'client_app');
        $data['language'] = json_decode($language);
        Session::put('language_id', $language_id);

        if ($language_id == 2) {
            $locale = 'en';
        } else {
            $locale = 'fr';
        }
        $message = array(
            'message' => trans('title_message.Language_Changed_succesfully'),
            'message_type' => 'success',
            'message_raw' => 'title_message.Language_Changed_succesfully',
        );

        return redirect('language/' . $locale)->with($message);
    }

    public function languageUpdate(Request $request)
    {
        try {
            $language_id = (int)$request->language_id;

            APICall('Clients/language?language_id=' . $language_id, "put", "{}", 'client_app');
            Session::put('language_id', $language_id);
            if ($language_id == 2) {
                $locale = 'en';
            } else {
                $locale = 'fr';
            }
            $message = array(
                'message' => trans('title_message.Language_Changed_succesfully'),
                'message_type' => 'success',
                'message_raw' => 'title_message.Language_Changed_succesfully',
            );
            return redirect('language/' . $locale)->with($message);
        } catch (\Throwable $th) {
            return back()->withErrors(["error" => $th->getMessage()]);
        }
    }
    public function changePassword()
    {
        $data = array();
        $data['title'] = trans('title_message.Change_Password');
        $client = APICall("Clients", 'get', "{}" ,"client_app");
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }

        $client = json_decode($client)->data;
        return view('front.changepassword', compact('data', 'logo', 'theme','theme_color_hover', 'button','primary_button_color_hover', 'admin_phone', 'admin_address'));
    }

    public function changePasswordUser(Request $request)
    {

      
        $client = APICall("Clients", 'get', "{}" ,"client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }

            $request->validate([
                'old_password' => 'required|string',
                'new_password' => 'required|string| min:8',
                'confirm_password' => 'required|string|same:new_password',
            ]);
            

        $data = array();
        $data['oldPassword'] = $request->old_password;
        $data['newPassword'] = $request->new_password;
        $clientIP = request()->ip();
        $data['from_ip'] = $clientIP;
        $new_password = APICall("Users/new_password", "post", json_encode($data), 'client_app');
        $data = json_decode($new_password);

        if ($data->data == false) {      
            $response = array(
                'message' => trans('title_message.Password_not_change'),
                'message_type' => 'danger'
            );
            return redirect()->back()->with($response);
        } else {
            $response = array(
                'message' => trans('title_message.Password_Changed_succesfully'),
                'message_type' => 'success',
            );
            return redirect()->back()->with($response);
        }
    }

    public function myProfile()
    {
        $data = array();
        $data['title'] = trans('myProfile.My_Profile');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();
        $client = APICall("Clients", 'get', "{}", "client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }
        $client = json_decode($client)->data;

        
        $franchises = APICall("Franchises", "get", "{}","client_app");
        $data['franchises'] = json_decode($franchises);
        Session::put('language_id', $client->language_id);


        foreach ($data['franchises']->data as $franchise) {
            if ($franchise->name ==  $client->franchise_name) {
                $franchise_id = $franchise->id;
                Session::put('franchise_id', $franchise_id);
            }
        }

        $membership = APICall('Memberships/client?display_language_id=' . $client->language_id, "get", "{}", "client_app");
        $membership = json_decode($membership);
        $payments = APICall('Payments/schedualed/client', "get", "{}", "client_app");
        $payments = json_decode($payments);
        if (!empty($payments->data)) {
            $payments = collect($payments->data);
            $sorted = $payments->sortBy('paymentDate');
            $payments = $sorted->values()->all();
        } else {
            $payments = "";
        }
        $response = APICall('PaymentMethods/cards', "get", "{}", "client_app");
        $cards = json_decode($response);

        if (!$cards->error && $cards->data) {
            $data["cards"] = $cards->data;
        } else {
            $data['cards'] = null;
        }

        //gettting bank accounts;
        $response = APICall('PaymentMethods/accounts', "get", "{}", "client_app");
        $bank = json_decode($response);

        if (!$bank->error && $bank->data) {
            $data["banks"] = $bank->data;
        } else {

            $data['banks'] = null;
        }
        $languages = APICall('Options/languages', "get", "{}", "client_app");
        $languages = json_decode($languages);
        return view('front.myprofile', compact('data', 'client', 'payments', 'languages', 'membership', 'logo', 'theme','theme_color_hover', 'button','primary_button_color_hover', 'admin_phone', 'admin_address'));
    }

    public function myContactInformation()
    {
        $lang_id = getLocale();
        $data = array();
        $data['title'] = trans('title_message.My_Contact_Information');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();
        $client = APICall("Clients", "get", "{}","client_app");
        if ($client == "unauthorised" || !$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login', compact('logo'))->with($message);
        }

        $client = json_decode($client)->data;
        $province = APICall('Options/ProvincesAndStates', "get", "{}","client_app");
        if ($province == "unauthorised") {
            return redirect()->route('login')->with('user', trans('title_message.login_token_expired'));
        }
        $province = json_decode($province);
        return view('front.mycontactinformation', compact('data', 'client', 'province', 'logo', 'theme','theme_color_hover', 'button','primary_button_color_hover', 'admin_phone', 'admin_address'));
    }
    public function updateContactInformation(Request $request)
    {
        try {
            //code...

            $validator = Validator::make($request->all(), [
                'firstname' => 'required|string',
                'email' => 'required|string',
                'lastname' => 'required|string',
                'is_male' => 'required',
                "civic_number" => 'required|string',
                "street" => 'required|string',
                "email" => 'required|string|email',
                "city" => 'required|string',
                'postal_code' => 'required|string|min:7|max:7',
                "province_id" => "required|string",
                "phone" => "required|string",
                "cellphone" => "required|string",
                "emergency_phone" => "required|string",
                "emergency_contact" => "required|string",


            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }

            $client = APICall("Clients", 'get', "{}","client_app");
            if (!$client) {
                $message = array(
                    'message' => trans('title_message.login_token_expired'),
                    'message_type' => 'error',
                );
                return redirect()->route('login')->with($message);
            }

            $franchises = APICall('Franchises', "get", "{}","client_app");

            $franchises = json_decode($franchises);
            $franchise_id = 0;
            foreach ($franchises->data as $fr) {

                if ($fr->name == $request->franchise_name) {
                    $franchise_id = $fr->id;
                }
            }
            $clients = APICall("Clients", "get", "{}","client_app");

            $clients = json_decode($clients)->data;
            $address = [
                "civic_number" => $request->civic_number,
                "street" => $request->street,
                "appartment" => $request->appartment??"",
                "city" => $request->city,
                "postal_code" => $request->postal_code,
                "province_id" => $request->province_id,
               
            ];
            
            $data = [
                "firstname" => $request->firstname,
                "email" => $request->email,
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
            $response = APICall("Clients/" . $franchise_id, "put", json_encode($data),"client_app");
           

            if (!$response->error) {

                $message = array(
                    'message' => trans('title_message.Contact_information_updated_successfully'),
                    'message_type' => 'success',
                );
                return redirect()->route('myContactInformation')->with($message);
            } else {
                $message = array(
                    'message' => trans('title_message.Contact_information_updated_failed'),
                    'message_type' => 'danger',
                );
                return redirect()->route('myContactInformation')->with($message);
            }
        } catch (\Throwable $th) {

            return redirect()->route('myContactInformation')->with('failed', $th->getMessage());
        }
    }
    public function changemail_view()
    {
        $data = array();
        $data['title'] = trans('title_message.My_Contact_Information');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();

        $client = APICall("Clients", "get", "{}","client_app");
        $client = json_decode($client)->data;

         return view('front.changemail', compact('data', 'client','logo', 'theme','theme_color_hover', 'button','primary_button_color_hover','admin_phone','admin_address'));
    }
    public function changemail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'oldEmail' => 'required|string',
            'newEmail' => 'required|string',
           

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }
        $oldEmail = $request->oldEmail;
        $newEmail = $request->newEmail;

        $response = APICall("Clients/email?oldEmail=" . $oldEmail. "&newEmail=" . $newEmail,  "put", "{}", "client_app");
        $response = json_decode($response);
        if ( $response->error == null) {
            $response = array(
                'message' => trans('title_message.email_change'),
                'message_type' => 'success'
            );
            return redirect(route('myContactInformation'))->with($response);
        } else {
            $response = array(
                'message' =>  $response->error->message,
                'message_type' => 'danger'
            );
            return redirect()->back()->with($response);
        }

    }


    public function payMyOutstandingBalance()
    {
        $data = array();
        $data['title'] = trans('title_message.Pay_My_Outstanding_Balance');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();

        $response =  APICall('Payments/schedualed/client', "get", "{}","client_app");
        if ($response == "") {
            $message = array(
                'message' => trans('title_message.Session_Expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }
        $payments = json_decode($response);
        if ($payments->error == null) {
            $data["payments"] = collect($payments->data);
            $sorted = $data["payments"]->sortBy('paymentDate');
            $data["payments"] = $sorted->values()->all();

            $data["outstandingAmount"] = 0;
            foreach ((array)$data["payments"] as $v2) {
                if (!$v2->is_paid) {
                    $data["outstandingAmount"] += (float)$v2->amount;
                }
            };
        } else {
            $data["payments"] = null;
        }
        $banks = APICall("PaymentMethods/accounts", "GET", "{}","client_app");
        $banks = json_decode($banks);
        if ($banks->error == null) {
            $data["banks"] = $banks->data;
            if (isset($data["banks"]) && count($data["banks"])) {
                $data["client_id"] = $data["banks"][0]->client_id;
            } else {
                $data["client_id"] = '';
            }
        } else {
            $data["banks"] = null;
        }
        $cards = APICall("PaymentMethods/cards", "GET", "{}","client_app");
        $cards = json_decode($cards);
        if ($cards->error == null) {
            $data["cards"] = $cards->data;
            if (isset($data["cards"]) && count($data["cards"])) {
                $data["client_id"] = $data["cards"][0]->client_id;
            } else {
                $data["client_id"] = '';
            }
        } else {
            $data["cards"] = null;
        }
        $card =  APICall("PaymentMethods/accepted_cards", "get", "{}", 'client_app');
        $data['card_types'] = json_decode($card);
        $total_balance =  APICall("Payments/balance", "get", "{}", 'client_app');
        $data['total_balance'] = json_decode( $total_balance);
        return view('front.paymyoutstandingbalance', compact('data', 'logo', 'theme','theme_color_hover', 'button','primary_button_color_hover', 'admin_phone', 'admin_address'));
    }

    public function payOutstandingPayment(Request $request)
    {
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }

        if ($request->new_key == 0) {
            $validator = Validator::make($request->all(), [
                "totalAmount" => "required|min:1",
                "payment_checkbox" => "required"
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {

                //credit card payment
                if ($request->payment_type == "credit_card") {

                    $paymentIds = "[" . $request->payment_method_card . "]";
                    $url = "Payments?credit_card_id=" . $request->payment_method_card . "&amount=" . $request->totalAmount;
                    $responses = APICall($url, "post", $paymentIds, "client_app");
                    $responses = json_decode($responses);
                    if ($responses->error != null) {
                        $response = array(
                            'message' => $responses->error->message,
                            'message_type' => 'danger'
                        );
                        return redirect()->back()->with($response);
                    } else {
                        $response = array(
                            'message' => trans('title_message.Payment_Successfull'),
                            'message_type' => 'success',
                        );
                        return redirect()->back()->with($response);
                    }

                }
                //bank account payment
                else {

                    $response = APICall("Payments/client/" . $request->client_id . "/amount/" . $request->totalAmount, "POST", "{}", "client_app");
                    $response = json_decode($response);
                    if ($response->error == null && $response->data) {
                        $responses = array(
                            'message' => trans('title_message.Payment_Successfull'),
                            'message_type' => 'success',
                        );
                        return redirect()->route('payMyOutstandingBalance')->with($responses);
                    } else {
                        $responses = array(
                            'message' => $response->error->message,
                            'message_type' => 'danger'
                        );
                        return redirect()->route('payMyOutstandingBalance')->with($responses);
                    }
                }
            }
        }else{
            if ($request->payment_type == "bank_account") {
                $validator = Validator::make($request->all(), [
                    "transit_number" => "required|min:3|max:5",
                    "institution" => "required|min:3",
                    "account_number" => "required|min:5|max:12",
                    "owner_names" => "required",

                ]);
                if ($validator->fails()) {
                    return redirect(route('payMyOutstandingBalance',["type" => "new_bank"]))->withErrors($validator)->withInput();
                } else {
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
                if ($data['pay_methode_acc']->error != null) {
                    $response = array(
                        'message' => $data['pay_methode_acc']->error->message,
                        'message_type' => 'danger'
                    );
                    return redirect()->back()->with($response)->withInput();
                }
                $response = array(
                    'messages' => trans('title_message.Bank_added_succesfully'),
                    'message_type' => 'success',
                );
                return redirect(route("payMyOutstandingBalance", ["type" => "bank", 'acc_id' => $data['pay_methode_acc']->data->id]))->with($response);
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
                return redirect(route('payMyOutstandingBalance',["type" => "new_card"]))->withErrors($validator)->withInput();
            } else {
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
                        'message' => $data['pay_methods_account']->error->message,
                        'message_type' => 'danger'
                    );
                    return redirect(route('payMyOutstandingBalance'))->with($response)->withInput();
                }
                $response = array(
                    'messages' => trans('title_message.Credit_card_added_succesfully'),
                    'message_type' => 'success',
                );
                return redirect(route("payMyOutstandingBalance", ["type" => "card", 'acc_id' => $data['pay_methods_account']->data->id]))->with($response);
            }
        }
    }
    }

    public function newMembership()
    {
        $data = array();
        $data['title'] = trans('newMembership.memberships');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $secondary_theme_color_hover = Configuration::where('name','secondary_theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }

        $client = json_decode($client)->data;
        if (Session::has('franchise_id')) {
            Session::forget('franchise_id');
        }

        //franchise call
        $franchises = APICall("Franchises", "get", "{}","client_app");
        $data['franchises'] = json_decode($franchises);
        $franchise_id = '';

        //find franchise_id
        foreach ($data['franchises']->data as $key => $franchise) {
            if ($franchise->name == $client->franchise_name) { //actual
                $franchise_id = $franchise->id;
                break;
            }
        }
        Session::put('franchise_id', $franchise_id);

        $lang_id = $client->language_id;
        //franchise get all plan
        $all_plan = APICall("SubscriptionPlans/types?franchise_id=" . $franchise_id. "&language_id=" . $lang_id, "get", "{}","client_app");
        $data['all_plan'] = json_decode($all_plan);

        //franchise best four plan details
        foreach ($data['all_plan']->data as $item) {
            $data['all_plan_details'][] = $item;
        }

        return view('front.newmembershipStepOne', compact('data', 'logo', 'theme','theme_color_hover', 'button', 'primary_button_color_hover', 'admin_phone', 'admin_address', 'lang_id','theme_color_hover','secondary_theme_color_hover'));
    }

    public function newMembershipSteptwo($id)
    {
        $data = array();
        $data['title'] = trans('newMembership.memberships') . ' ' . trans('newMembership.option');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }

        $client = json_decode($client)->data;
        $lang_id = $client->language_id;
        //subscriptionplan type call
        $subscription_plan = APICall("SubscriptionPlans/type/" . $id . "?language_id=" . $lang_id, "get", "{}","client_app");
        $data['subscription_plan'] = json_decode($subscription_plan);

        return view('front.newMembershipStepTwo', compact('data', 'logo', 'theme','theme_color_hover', 'button','primary_button_color_hover', 'admin_phone', 'admin_address'));
    }

    public function newMembershipSteptwosubmit(Request $request, $id)
    {
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }

        if (Session::has('duration_id')) {
            Session::forget('duration_id');
        }
        if (Session::has('installments_id')) {
            Session::forget('installments_id');
        }

        $duration_installments_arr = explode("|", $request->installments);
        Session::put('installments_id', $duration_installments_arr[1]);
        Session::put('duration_id', $duration_installments_arr[0]);

        if (Session::has('subscription_plan_id')) {
            Session::forget('subscription_plan_id');
        }

        Session::put('subscription_plan_id', $id);

        if (Session::has('add_on')) {
            Session::forget('add_on');
        }
        if (Session::has('addonname')) {
            Session::forget('addonname');
        }
        if (!isset($request->add_on)) {
            return redirect()->route('newMembershipFinal', ['id' => $id]);
        }
        
        foreach($request->add_on as $value){
            $arrvalue = explode("|",$value);
            $addon[]=$arrvalue[0];
            $addonname[]=$arrvalue[1];
             }
             Session::put('add_on', $addon);
             Session::put('addonname', $addonname);

        return redirect()->route('newMembershipFinal');
    }

    public function newMembershipFinal()
    {
        $data = array();
        $data['title'] = trans('paymentForm.payments');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();
        $client = APICall("Clients", 'get', "{}", "client_app");
        
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
            
        }

        $client = json_decode($client)->data;
        $lang_id = $client->language_id;
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

        return view('front.newmembershipStepFinal', compact('data', 'logo', 'theme','theme_color_hover', 'button','primary_button_color_hover', 'admin_phone', 'admin_address'));
    }

    public function newMembershipFinalSave(Request $request)
    {
        if ($request->new_key == 0) {
            $lang_id = Session::get('language_id');
            if ($request->radio_group_pay == "bank") {
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

                $membership_with_bnk_acc = APICall('Memberships/with-bank-account?display_language_id=' . $lang_id, "post", json_encode($membershipdata), "client_app");
                $data['membership_with_bnk_acc'] = json_decode($membership_with_bnk_acc);
                if ($data['membership_with_bnk_acc']!= null && $data['membership_with_bnk_acc']->error != null) {
                    $response = array(
                        'message' => $data['membership_with_bnk_acc']->error->message,
                        'message_type' => 'danger'
                    );
                    return redirect()->back()->with($response)->withInput();
                }

                Session::put('display_language_id', $lang_id);
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
                $membershipcarddata['card_id'] = $request->old_card;

                $membership_with_credit_card = APICall('Memberships/with-credit-card?display_language_id=' . $lang_id, "post", json_encode($membershipcarddata), "client_app");
                $data['membership_with_credit_card'] = json_decode($membership_with_credit_card);

                if ($data['membership_with_credit_card']->error != null) {
                    $response = array(
                        'message' => $data['membership_with_credit_card']->error->message,
                        'message_type' => 'danger'
                    );
                    return redirect()->back()->with($response)->withInput();
                }
                $response = array(
                    'message' => trans('title_message.Payment_completed_succesfully'),
                    'message_type' => 'success',
                );
                return redirect(route("myProfile"))->with($response);
            }
        } else {

            if ($request->radio_group_pay == "bank") {
                $validator = Validator::make($request->all(), [
                    "transit_number" => "required|min:3|max:5",
                    "institution" => "required|min:3",
                    "account_number" => "required|min:5|max:12",
                    "owner_names" => "required",

                ]);
                if ($validator->fails()) {
                    
                    return back()->withErrors($validator)->withInput();
                } else {
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
                    if ($data['pay_methode_acc']->error != null) {
                        $response = array(
                            'message' => $data['pay_methode_acc']->error->message,
                            'message_type' => 'danger'
                        );
                        return redirect()->back()->with($response)->withInput();
                    }
                    $response = array(
                        'messages' => trans('title_message.Bank_added_succesfully'),
                        'message_type' => 'success',
                    );
                    return redirect(route("newMembershipFinal", ["type" => "bank", 'acc_id' => $data['pay_methode_acc']->data->id]))->with($response);
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
                } else {
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
                            'message' => $data['pay_methods_account']->error->message,
                            'message_type' => 'danger'
                        );
                        return redirect()->back()->with($response)->withInput();
                    }
                    $response = array(
                        'messages' => trans('title_message.Credit_card_added_succesfully'),
                        'message_type' => 'success',
                    );
                    return redirect(route("newMembershipFinal", ["type" => "card", 'acc_id' => $data['pay_methods_account']->data->id]))->with($response);
                }
            }
        }
    }

    public function referralCode()
    {
        $data = array();
        $data['title'] = trans('title_message.Referral_Code');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();
        $referral_amount = Content::where('slug','referral')->where('franchise_id',3)->first();
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }
        $client = json_decode($client)->data;
        $referral = APICall('Clients', "get", "{}", 'client_app');
        $data['referral'] = json_decode($referral);

        return view('front.referralcode', compact('data', 'logo', 'theme','theme_color_hover', 'button','primary_button_color_hover', 'admin_phone', 'admin_address','referral_amount'));
    }

    public function myBankCards()
    {
        $data = array();
        $data['title'] = trans('title_message.Credit_Card_Bank_Account');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
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

        return view('front.mybankcards', compact('data', 'logo', 'theme','theme_color_hover', 'button','primary_button_color_hover', 'admin_phone', 'admin_address'));
    }

    public function modifyBanks($id)
    {
        $data = array();
        $data['title'] = trans('title_message.Modify_Bank_Account');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
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
        return view('front.modifyBanks', compact('data', 'logo', 'theme','theme_color_hover', 'button','primary_button_color_hover', 'admin_phone', 'admin_address'));
    }

    public function modifyBanksUpdate(Request $request)
    {
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }

        $validator = Validator::make($request->all(), [
            "transit_number" => "required|min:3|max:5",
            "institution" => "required|min:3",
            "account_number" => "required|min:5|max:12",
            "owner_names" => "required",

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $formdata = array();
            $formdata['id'] = $request->bank_id;
            $formdata['transit'] = $request->transit_number;
            $formdata['institution'] = $request->institution;
            $formdata['account_number'] = $request->account_number;
            $formdata['owner_name'] = $request->owner_names;
            if (Session::has('franchise_id')) {
                $carddata['franchise_id'] = Session::get('franchise_id');

                $response = APICall("PaymentMethods/account", "put", json_encode($formdata), 'client_app');
                $response = json_decode($response);
                
            }
            if($response->error)
{
    $response = array(
        'message' => $response->error->message,
        'message_type' => 'error',
    );
    return redirect()->back()->with($response);
}
else{
            $response = array(
                'message' => trans('title_message.Bank_updated_succesfully'),
                'message_type' => 'success',
            );

            return redirect(route('myBankCards'))->with($response);
        }
    }
    }
    public function modifyCards($id)
    {
        $data = array();
        $data['title'] = trans('title_message.Modify_Card_Account');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();
        $pay_methods_accc = APICall('PaymentMethods/Cards', "get", "{}", 'client_app');
        $data['pay_methods_accc'] = json_decode($pay_methods_accc);
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }
        $client = json_decode($client)->data;

        $card =  APICall("PaymentMethods/accepted_cards", "get", "{}", 'client_app');
        $data['card_types'] = json_decode($card);

        $data["card"] = array_map(function ($card) use ($id) {
            if ($id == $card->id) {
                return $card;
            }
        }, (array)$data['pay_methods_accc']->data);
        $data["card"] = array_filter($data["card"]);
        $data["card"] = array_values($data["card"]);

        return view('front.modifyCards', compact('data', 'logo', 'theme','theme_color_hover', 'button','primary_button_color_hover', 'admin_phone', 'admin_address'));
    }

    public function modifyCardsUpdate(Request $request)
    {
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }

        $validator = Validator::make($request->all(), [
            "pan" => "required|min:15|max:16",      
            "expiry_month" => "required|min:1|max:12|numeric",
            "owner_name" => "required",
            "expiry_year" => "required|integer|min:2023|numeric"
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $formdata = array();
            $formdata['creditID'] = $request->credit_id;
            $formdata['owner_name'] = $request->owner_name;
            $formdata['number_card'] = $request->pan;
            $formdata['expire_year'] = $request->expiry_year;
            $formdata['expire_month'] = $request->expiry_month;
    
         
            $response = APICall("PaymentMethods/card", "put", json_encode($formdata), 'client_app');
            $response = json_decode($response);

if($response->error)
{
    $response = array(
        'message' => $response->error->message,
        'message_type' => 'error',
    );
    return redirect()->back()->with($response);
}
else{
            $response = array(
                'message' => trans('title_message.Card_modified_succesfully'),
                'message_type' => 'success',
            );

            return redirect(route('myBankCards'))->with($response);
        }
    }
    }

    public function renewMembership(Request $req, $membershipId)
    {
        
        if(request()->bank){
            // return 'bank';
            $lang_id = Session::get('language_id');
            $uri = "Memberships/" . $membershipId . "/account/" . $req->bank . "?display_language_id=" . $lang_id;
            $membership_with_bank = APICall($uri, "put", "{}", 'client_app');
            $data['membership_with_bank'] = json_decode($membership_with_bank);

            if ($data['membership_with_bank']->error != null) {
                $response = array(
                    'message' => $data['membership_with_bank']->error->message,
                    'message_type' => 'danger'
                );
                return redirect()->back()->with($response)->withInput();
            }
            $response = array(
                'message' => trans('title_message.membership_upgraded_succesfully'),
                'message_type' => 'success',
            );
            return redirect()->back()->with($response);
        }
        else{
            // return 'card';
            $lang_id = Session::get('language_id');
            $uri = "Memberships/" . $membershipId . "/card/" . $req->card . "?display_language_id=" . $lang_id;
            $membership_with_credit_card = APICall($uri, "put", "{}", 'client_app');
            $data['membership_with_credit_card'] = json_decode($membership_with_credit_card);

            if ($data['membership_with_credit_card']->error != null) {
                $response = array(
                    'message' => $data['membership_with_credit_card']->error->message,
                    'message_type' => 'danger'
                );
                return redirect()->back()->with($response)->withInput();
            }
            $response = array(
                'message' => trans('title_message.membership_upgraded_succesfully'),
                'message_type' => 'success',
            );
            return redirect()->back()->with($response);
        }
        
    }

    // public function renewMembershipbank($membershipId,$bank_id)
    // {
    //     $lang_id = Session::get('language_id');
    //     $uri = "Memberships/" . $membershipId . "/account/" . $bank_id . "?display_language_id=" . $lang_id;
    //     $membership_with_bank = APICall($uri, "put", "{}", 'client_app');
    //     $data['membership_with_bank'] = json_decode($membership_with_bank);

    //     if ($data['membership_with_bank']->error != null) {
    //         $response = array(
    //             'message' => $data['membership_with_bank']->error->message,
    //             'message_type' => 'danger'
    //         );
    //         return redirect()->back()->with($response)->withInput();
    //     }
    //     $response = array(
    //         'message' => trans('title_message.membership_upgraded_succesfully'),
    //         'message_type' => 'success',
    //     );
    //     return redirect()->back()->with($response);
    // }

    public function upgradeMembership()
    {
        $data = array();
        $data['title'] = trans('title_message.Upgrade_Membership');
        $logo = Configuration::where('name', 'logo_image')->where('franchise_id', 3)->first();
        $theme = Configuration::where('name', 'theme_color')->where('franchise_id', 3)->first();
        $theme_color_hover = Configuration::where('name','theme_color_hover')->where('franchise_id', 3)->first();
        $button = Configuration::where('name', 'primary_button_color')->where('franchise_id', 3)->first();
        $primary_button_color_hover = Configuration::where('name','primary_button_color_hover')->where('franchise_id', 3)->first();
        $admin_phone = Configuration::where('name', 'admin_phone')->where('franchise_id', 3)->first();
        $admin_address = Configuration::where('name', 'admin_address')->where('franchise_id', 3)->first();
        $client = APICall("Clients", 'get', "{}", "client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }
        $client = json_decode($client)->data;
        $lang_id = getLocale();
        $data['title'] = trans('newMembership.memberships') . ' ' . trans('newMembership.option');
        $membership = APICall('Memberships/client?display_language_id=' . $client->language_id, "get", "{}", "client_app");
        $data['membership'] = json_decode($membership);

        $franchise_id = 3;
        //franchise get all plan
        $all_plan = APICall("SubscriptionPlans/types?franchise_id=" . $franchise_id, "get", "{}","client_app");
        $data['all_plan'] = json_decode($all_plan);

        foreach ($data['all_plan']->data as $item) {
            $data['subscription_plan'][] = json_decode(APICall("SubscriptionPlans/type/" . $item->id . "?language_id=" . $client->language_id, "get", "{}","client_app"));
        }
        
        $pay_methods_card = APICall('PaymentMethods/cards', "get", "{}", 'client_app');
        $data['pay_methods_card'] = json_decode($pay_methods_card);

        $pay_methods_bank = APICall('PaymentMethods/accounts', "get", "{}", 'client_app');
        $data['pay_methods_bank'] = json_decode($pay_methods_bank);

        return view('front.upgrademembership', compact('data', 'logo', 'theme','theme_color_hover', 'button','primary_button_color_hover', 'admin_phone', 'admin_address'));
    }

    public function upgragemembershipsubmit(Request $request, $membershipId, $card_id)
    {
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }

        $lang_id = Session::get('language_id');
        $uri = "Memberships/" . $membershipId . "/card/" . $card_id . "?display_language_id=" . $lang_id;
        $membership_with_credit_card = APICall($uri, "put", "{}", 'client_app');
        $data['membership_with_credit_card'] = json_decode($membership_with_credit_card);

        if ($data['membership_with_credit_card']->error != null) {
            $response = array(
                'message' => $data['membership_with_credit_card']->error->message,
                'message_type' => 'danger'
            );
            return redirect()->back()->with($response)->withInput();
        }
        $response = array(
            'message' => trans('title_message.membership_upgraded_succesfully'),
            'message_type' => 'success',
        );
        return redirect(route("myProfile"))->with($response);
    }

    public function upgragemembershipsubmitbank(Request $request, $membershipId, $bank_id)
    {
        $client = APICall("Clients", 'get', "{}","client_app");
        if (!$client) {
            $message = array(
                'message' => trans('title_message.login_token_expired'),
                'message_type' => 'error',
            );
            return redirect()->route('login')->with($message);
        }

        $lang_id = Session::get('language_id');
        $uri = "Memberships/" . $membershipId . "/account/" . $bank_id . "?display_language_id=" . $lang_id;
        $membership_with_bank = APICall($uri, "put", "{}", 'client_app');
        $data['membership_with_bank'] = json_decode($membership_with_bank);

        if ($data['membership_with_bank']->error != null) {
            $response = array(
                'message' => $data['membership_with_bank']->error->message,
                'message_type' => 'danger'
            );
            return redirect()->back()->with($response)->withInput();
        }
        $response = array(
            'message' => trans('title_message.membership_upgraded_succesfully'),
            'message_type' => 'success',
        );
        return redirect(route("myProfile"))->with($response);
    }

    public function newmembershippaymentSave(Request $request)
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
                    'message' => $data['pay_methode_acc']->error->message,
                    'message_type' => 'danger'
                );
                return redirect()->back()->with($response)->withInput();
            }else{
            $response = array(
                'message' => trans('title_message.Bank_added_succesfully'),
                'message_type' => 'success',
            );
            return redirect(route("newMembershipFinal"))->with($response);
        }
        } else {
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
                    'message' => $data['pay_methods_account']->error->message,
                    'message_type' => 'danger'
                );
                return redirect()->back()->with($response)->withInput();
            }else{
            $response = array(
                'message' => trans('title_message.Credit_card_added_succesfully'),
                'message_type' => 'success',
            );
            return redirect(route("newMembershipFinal"))->with($response);
        }
    }
}
}
