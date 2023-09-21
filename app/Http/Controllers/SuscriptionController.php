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
        // $fromdata['emergency_contact'] = $request->emergency_contact;
        $fromdata['emergency_contact'] = 'rahul';//not found
        $fromdata['emergency_phone'] = $request->emergency_phone;
        $fromdata['date_of_birth'] = $request->date_of_birth;
        $fromdata['email'] = $request->email;
        // $fromdata['language_id'] = $request->language_id;
        $fromdata['language_id'] = 1;//nf
        $fromdata['user_name'] = $request->user_name;//nf//required
        $fromdata['password'] = $request->password;
        $fromdata['driver_license'] = $request->driver_license;//nf
        $fromdata['occupation'] = $request->occupation;//nf
        $fromdata['nativeRef_number'] = $request->nativeRef_number;///nf
        $fromdata['reference_id'] = $request->reference_id;
        $fromdata['sub_reference_id'] = $request->sub_reference_id;//nf
        $fromdata['reference_Code'] = $request->reference_Code;
        // $fromdata['franchise_id'] = $request->franchise_id;
        // dd($fromdata);
        // {
        //     "firstname": "string",
        //     "lastname": "string",
        //     "is_male": 0,
        //     "address_civic_number": "string",
        //     "address_street": "string",
        //     "address_appartment": "string",
        //     "address_city": "string",
        //     "address_postal_code": "string",
        //     "address_province_id": 0,
        //     "phone": "string",
        //     "cellphone": "string",
        //     "emergency_contact": "string",
        //     "emergency_phone": "string",
        //     "date_of_birth": "2023-09-20T14:05:21.187Z",
        //     "email": "string",
        //     "language_id": 0,
        //     "user_name": "string",
        //     "password": "string",
        //     "driver_license": "string",
        //     "occupation": "string",
        //     "nativeRef_number": "string",
        //     "reference_id": 0,
        //     "sub_reference_id": 0,
        //     "reference_Code": "string"
        //   }

        //clients save type call
        $clients = APICall("Clients?franchise_id=".$request->franchise_id, "POST",json_encode($fromdata));
        $data['clients'] = json_decode($clients);
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
      return $request->add_on;
      Session::push('add_on', $request->add_on);
    }
}
