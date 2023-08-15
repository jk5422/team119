<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contact;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    function contact(Request $req){

        if($req->input('name')!="" && $req->input('mobile')!="" && $req->input('email')!="" && $req->input('subject')!="" && $req->input('message')!=""){

            $contact=new contact();
            $contact->name=$req->input('name');
            $contact->email=$req->input('email');
            $contact->mobile=$req->input('mobile');
            $contact->subject=$req->input('subject');
            $contact->message=$req->input('message');
            $res=$contact->save();
            if($res){
                $req->session()->put('ptcnttru',"Thank you for contact us we will shortly contact you..!!");
                return redirect('contact');
            }

        }
        else
        {
            $req->session()->put('ptcntfls',"please fill all required details..!!");
            return redirect('contact');
        }
    }

   function allcontactus(){
    $contact=DB::table('contactus')->orderBy('idcontact','desc')->get();
    return view('backend.contactus',['title'=>'ContactUs | ShreeHari','data'=>$contact]);
   }

   function getmsg(Request $req)
   {
    if($req->post('cid')!=""){
        $contact=DB::table('contactus')->where('contactus.idcontact','=',$req->post('cid'))->get();

       $msg='<span>'.$contact[0]->message.'</span>';
       return $msg;
    }
   }

   function delcid(Request $req){
    if($req->input('cnid')!=""){
        $contact=DB::table('contactus')->where('contactus.idcontact','=',$req->input('cnid'));

        $res=$contact->delete();

        if($res){
            $req->session()->put('cntrue', "Message Deleted..!!");
            return redirect('doctor/contactus');
        }
    }
    else
    {
        $req->session()->put('cnfalse', "Select Required ContactId..!!");
        return redirect('doctor/contactus');
    }
   }

   function getcnidall(){
    $contact = contact::all();
    $result = json_decode($contact, true);
    $html = '<option value="">#--- Select ContactId For Delete ---#</option>';
    foreach ($result as $list) {
        $html .= '
        <option value="' . $list['idcontact'] . '">'.$list['idcontact'].'</option>';
    }
    return $html;
   }
}
