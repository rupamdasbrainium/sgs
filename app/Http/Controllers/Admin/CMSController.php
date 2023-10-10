<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\About_us;
use App\Models\Contact_us;
use App\Models\Configuration;

class CMSController extends Controller
{
    //

    public function aboutus()
    {
        $data=DB::table('about_us')->get();
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        return view('admin.aboutUs',['data' => $data,'logo'=>$logo]);
    }

    public function createaboutus()
    {
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        return view('admin.aboutUsForm',compact('logo'));
    }

    public function storeaboutus(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required'
        ]);
        $aboutus_data= new About_us;
        $aboutus_data->title=$request->title;
        $aboutus_data->content=$request->content;
        $aboutus_data->save();
        
        return redirect(route('admin.about-us'));
    }

    public function editaboutus($id)
    {
        $data=DB::table('about_us')->where('id',$id)->first();
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        return view('admin.editAboutUs',['data' => $data,'logo'=>$logo]);
    }

    public function updateaboutus(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required'
        ]);
        $aboutus_data= About_us::find($id);
        $aboutus_data->title=$request->title;
        $aboutus_data->content=$request->content;
        $aboutus_data->save();
        
        return redirect(route('admin.about-us'));
    }
   
    public function deleteaboutus($id)
    {
        $aboutus_data= About_us::find($id);
        $aboutus_data->delete();

        return redirect(route('admin.about-us'));
    }

    public function contactus()
    {
        $data=DB::table('contact_us')->get();
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        return view('admin.contactUs',['data' => $data,'logo'=>$logo]);
    }

    public function createcontactus()
    {
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        return view('admin.contactUsForm',compact('logo'));
    }

    public function storecontactus(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'email'  => 'required|email',
            'comment'=> 'required'
        ]);
        $contactus_data= new Contact_us;
        $contactus_data->name=$request->name;
        $contactus_data->email=$request->email;
        $contactus_data->comment=$request->comment;
        $contactus_data->save();
        
        return redirect(route('admin.contact-us'));
    }

    public function editcontactus($id)
    {
        $data=DB::table('contact_us')->where('id',$id)->first();
        $logo = Configuration::where('name','logo_image')->where('franchise_id',3)->first();
        return view('admin.editContactUs',['data' => $data,$logo]);
    }

    public function updatecontactus(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required',
            'email'  => 'required|email',
            'comment'=> 'required'
        ]);
        $contactus_data= Contact_us::find($id);
        $contactus_data->name=$request->name;
        $contactus_data->email=$request->email;
        $contactus_data->comment=$request->comment;
        $contactus_data->save();
       
        return redirect(route('admin.contact-us'));
    }
   
    public function deletecontactus($id)
    {
        $contactus_data= Contact_us::find($id);
        $contactus_data->delete();

        return redirect(route('admin.contact-us'));
    }

}
