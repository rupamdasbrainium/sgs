<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('front.suscriptionform', compact('data'));
    }

    public function suscriptionformsave(Request $request, $id){
        $data = array();
        $data['firstname'] = $request->firstname;
        $data['lastname'] = $request->lastname;
        $data['is_male'] = $request->is_male;
        $data['address_civic_number'] = $request->address_civic_number;
        $data['address_street'] = $request->address_street;
        $data['address_appartment'] = $request->address_appartment;
        $data['address_city'] = $request->address_city;
        $data['address_postal_code'] = $request->address_postal_code;
        $data['address_province_id'] = $request->address_province_id;
        $data['phone'] = $request->phone;
        $data['cellphone'] = $request->cellphone;
        $data['emergency_contact'] = $request->emergency_contact;
        $data['emergency_phone'] = $request->emergency_phone;
        $data['date_of_birth'] = $request->date_of_birth;
        $data['email'] = $request->email;
        $data['language_id'] = $request->language_id;
        $data['user_name'] = $request->user_name;
        $data['password'] = $request->password;
        $data['driver_license'] = $request->driver_license;
        $data['occupation'] = $request->occupation;
        $data['nativeRef_number'] = $request->nativeRef_number;
        $data['reference_id'] = $request->reference_id;
        $data['sub_reference_id'] = $request->sub_reference_id;
        $data['reference_Code'] = $request->reference_Code;

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

        //subscriptionplan type call
        $subscription_plan = APICall("SubscriptionPlans/type/".$id, "get","{}");
        $data['subscription_plan'] = json_decode($subscription_plan);

        //reference call
        $opts_references = APICall("Options/references?franchise_id=".$data['subscription_plan']->data->id_frinchise."&language_id=2", "get","{}");
        $data['opts_references'] = json_decode($opts_references);

        return view('front.suscriptionform', compact('data'));
    }
}
