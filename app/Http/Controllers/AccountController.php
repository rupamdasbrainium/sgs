<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

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
        return view('front.account', compact('data','client'));
    }

    public function changeLanguage () {
        $data = array();
        $data['title'] = 'Change Language';
        return view('front.changelanguage', compact('data'));
    }

    public function changePassword () {
        $data = array();
        $data['title'] = 'Change Password';
        return view('front.changepassword', compact('data'));
    }

    public function myProfile () {
        $data = array();
        $data['title'] = 'My Profile';
        return view('front.myprofile', compact('data'));
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
                    return back()->with('errors', $validator->messages());
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
