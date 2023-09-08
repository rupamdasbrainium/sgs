<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\About_us;
use App\Models\Contact_us;

class CMSController extends Controller
{
    //

    public function aboutus()
    {
        $data=DB::table('about_us')->get();
        return view('admin.aboutUs',['data' => $data]);
    }

    public function createaboutus()
    {
        return view('admin.aboutUsForm');
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
        return view('admin.editAboutUs',['data' => $data]);
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
        return view('admin.contactUs',['data' => $data]);
    }

    public function createcontactus()
    {
        return view('admin.contactUsForm');
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
        return view('admin.editContactUs',['data' => $data]);
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
