<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SuscriptionController extends Controller
{
    public function suscriptionForm ($id) {
        $data = array();
        $data['title'] = 'Suscriptionn Form';

        //subscriptionplan type call
        $subscription_plan = APICall("SubscriptionPlans/type/".$id, "get","{}");
        $data['subscription_plan'] = json_decode($subscription_plan);

        //reference call
        $opts_references = APICall("Options/references?franchise_id=".$data['subscription_plan']->data->id_frinchise."&language_id=2", "get","{}");
        $data['opts_references'] = json_decode($opts_references);

        //franchise call
        $franchises = APICall("Franchises", "get","{}");
        $decodefranchises = json_decode($franchises);

        //find franchise_id
        $franchise_data = '';
        foreach($decodefranchises->data as $franchise){
          if($franchise->id == $data['subscription_plan']->data->id_frinchise){
            $franchise_data = $franchise;
            break;
          }
        }
        $data['franchise'] = $franchise_data;

        //Provinces call
        $Provinces = APICall("Options/ProvincesAndStates", "get","{}");
        $data['provinces'] = json_decode($Provinces);

        return view('front.suscriptionform', compact('data'));
    }

    public function suscriptionformsave(Request $request, $id){
        $fromdata = array();
        // $data[]
        $fromdata['firstname'] = $request->firstname;
        $fromdata['lastname'] = $request->lastname;
        $fromdata['is_male'] = $request->is_male;
        $fromdata['address_civic_number'] = $request->address_civic_number;
        $fromdata['address_street'] = $request->address_street;
        $fromdata['address_appartment'] = $request->address_appartment;
        $fromdata['address_city'] = $request->address_city;
        $fromdata['address_postal_code'] = $request->address_postal_code;
        $fromdata['address_province_id'] = $request->address_province_id;
        $fromdata['phone'] = $request->phone;
        $fromdata['cellphone'] = $request->cellphone;
        $fromdata['emergency_contact'] = $request->emergency_contact;
        // $fromdata['emergency_contact'] = 'rahul';//not found
        $fromdata['emergency_phone'] = $request->emergency_phone;
        $fromdata['date_of_birth'] = $request->date_of_birth;
        $fromdata['email'] = $request->email;
        // $fromdata['language_id'] = $request->language_id;
        $fromdata['language_id'] = 2;//nf
        $fromdata['user_name'] = $request->user_name;//nf//required
        $fromdata['password'] = $request->password;
        $fromdata['driver_license'] = $request->driver_license;//nf
        $fromdata['occupation'] = $request->occupation;//nf
        $fromdata['nativeRef_number'] = $request->nativeRef_number;///nf
        $fromdata['reference_id'] = $request->reference_id;
        $fromdata['sub_reference_id'] = $request->sub_reference_id;//nf
        $fromdata['reference_Code'] = $request->reference_Code;



        //clients save type call
        $clients = APICall("Clients?franchise_id=".$request->franchise_id, "POST",json_encode($fromdata));
        $data['clients'] = json_decode($clients);

        if($data['clients']->error==null){
          if (Session::has('installments_id')) {
            Session::forget('installments_id');
          }
          if (Session::has('duration_id')) {
            Session::forget('duration_id');
          }
          if (Session::has('token')) {
            Session::forget('token');
          }
          if (Session::has('subscription_plan_id')) {
            Session::forget('subscription_plan_id');
          }
          if (Session::has('franchise_id')) {
            Session::forget('franchise_id');
          }
          if (Session::has('reference_Code')) {
            Session::forget('reference_Code');
          }
          $duration_installments_arr = explode("|",$request->installments);
          Session::put('installments_id', $duration_installments_arr[1]);
          Session::put('duration_id', $duration_installments_arr[0]);
          Session::put('token', $data['clients']->data->token);
          Session::put('subscription_plan_id', $id);
          Session::put('franchise_id', $request->franchise_id);
          Session::put('reference_Code', $request->reference_Code);
          return redirect()->route('payment');
        } else {
          return redirect()->back()->with('error', $data['clients']);
        }
        
        // dd($data['clients']);
        return $data['clients'];

    }

    public function new_membership($id){
      $data = array();
        $data['title'] = 'Memberships';

        //subscriptionplan type call
        $subscription_plan = APICall("SubscriptionPlans/type/".$id, "get","{}");
        $data['subscription_plan'] = json_decode($subscription_plan);

        //franchise call
        $franchises = APICall("Franchises", "get","{}");
        $decodefranchises = json_decode($franchises);

        //find franchise_id
        $franchise_data = '';
        foreach($decodefranchises->data as $franchise){
          if($franchise->id == $data['subscription_plan']->data->id_frinchise){
            $franchise_data = $franchise;
            break;
          }
        }
        $data['franchise'] = $franchise_data;
        return view('front.newMembership', compact('data'));
    }

    function new_membership_save(Request $request, $id){
      // return $request->add_on;
      if (Session::has('add_on')) {
        Session::forget('add_on');
      }
      Session::push('add_on', $request->add_on);
      return redirect()->route('suscriptionform', ['id' => $id]);
    }
}
