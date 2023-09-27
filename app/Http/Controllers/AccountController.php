<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // return view('front.changepassword', compact('data'));
        return redirect()->back()->with('success','password change successfully');
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
        $data['title'] = 'New Membership';
        return view('front.newmembership', compact('data'));
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
