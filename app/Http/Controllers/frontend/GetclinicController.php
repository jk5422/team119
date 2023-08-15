<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\clinic;
use Illuminate\Database\QueryException;

class GetclinicController extends Controller
{
    //
    function clinics(Request $res){
        if($res->post('did')!=""){


        $cnt= DB::table('doctors')->join('clinics','doctors.clinics_cid','=','clinics.cid')->where('doctors.did','=',$res->post('did'))->distinct()->get('*')->count();

        if($cnt>=1){
            $data= DB::table('doctors')->join('clinics','doctors.clinics_cid','=','clinics.cid')->where('doctors.did','=',$res->post('did'))->distinct()->get('*');
            $result=json_decode($data,true);

            $html='<option value="">#--Select Clinic--#</option>';
            foreach($result as $list){
                $html.='<option value="'.$list['cid'].'">'.$list['cname'].'</option>';
            }
            return $html;
        }
        else
        {
            $html='<option value="">#--Not Found--#</option>';
            return $html;
        }
    }
    else
    {
             $html='<option value="">#--Not Found--#</option>';
            return $html;
    }

    }

    function services(Request $res){
        if($res->post('did')!=""){


        $cnt= DB::table('doctors')->join('services','doctors.did','=','services.doctors_did')->where('did','=',$res->post('did'))->get('*')->count();

        if($cnt>=1){
            $data= DB::table('doctors')->join('services','doctors.did','=','services.doctors_did')->where('did','=',$res->post('did'))->get('*');

            $result=json_decode($data,true);

            $html='';
            foreach($result as $list){
                $html.='<option value="'.$list['sid'].'">'.$list['sname'].'</option>';
            }
            return $html;
        }
        else
        {
            $html='<option value="">#--Not Found--#</option>';
            return $html;
        }
    }
    else
        {
            $html='<option value="">#--Not Found--#</option>';
            return $html;
        }


    }

    function allclinics(){
        $data=clinic::all();

        return view('backend.allclinics',['title'=>'All Clinics | ShreeHari','data'=>$data]);
    }

    function addclinic(Request $req){
        if($req->input('cname')!="" && $req->input('cmobile')!="" && $req->input('cemail')!="" && $req->input('caddress')!=""){

            $cnt=DB::table('clinics')->where('cname','LIKE',$req->input('cname'))->orwhere('cmobile','=',$req->input('cmobile'))->orwhere('cemail','LIKe',$req->input('cemail'))->count();

            if($cnt >=1){
                $req->session()->put('cfalse', "Clinic Details Already Exist..!!");
            return redirect('doctor/allclinics');
            }
            else
            {
                $clinic=new clinic();
                $clinic->cname=$req->input('cname');
                $clinic->cmobile=$req->input('cmobile');
                $clinic->cemail=$req->input('cemail');
                $clinic->caddress=$req->input('caddress');
                $res=$clinic->save();

                if($res){
                    $req->session()->put('ctrue', "New Clinic Added..!!");
                    return redirect('doctor/allclinics');
                }
                else
                {
                    $req->session()->put('cfalse', "Server Error..!!");
                    return redirect('doctor/allclinics');
                }

            }
        }
        else
        {
            $req->session()->put('cfalse', "Please fill all required details..!!");
            return redirect('doctor/allclinics');
        }
    }


    function clinicdetails(Request $req){
        if($req->post('cid')!="")
        {
            $clinic=clinic::find($req->post('cid'));
            return ['data'=>$clinic];
        }
        else
        {
            return ['data'=>'#--Not Found--#'];

        }
    }


    function updateclinic(Request $req){
        if($req->input('cid')!="" && $req->input('cname')!="" && $req->input('cmobile')!="" && $req->input('cemail')!="" && $req->input('caddress')!="")
        {
            $clinic=clinic::find($req->input('cid'));
            $clinic->cname=$req->input('cname');
            $clinic->cmobile=$req->input('cmobile');
            $clinic->cemail=$req->input('cemail');
            $clinic->caddress=$req->input('caddress');
            $res=$clinic->save();
            if($res){
                $req->session()->put('ctrue', "Clinic Details Updated..!!");
                return redirect('doctor/allclinics');
            }
            else
            {
                $req->session()->put('cfalse', "Server Error..!!");
                return redirect('doctor/allclinics');
            }
        }
        else
        {
            $req->session()->put('cfalse', "Please fill all required details..!!");
            return redirect('doctor/allclinics');
        }
    }

    function deleteclinic(Request $req){
        if($req->input('cid')!=""){
            try{
                $clinic=clinic::find($req->input('cid'));
                $res=$clinic->delete();
                if($res){
                    $req->session()->put('ctrue', "Clinic Deleted..!!");
                            return redirect('doctor/allclinics');
                }

            }
            catch(QueryException){
                $req->session()->put('cfalse', "Particular Clinics and his other reference entries exits you can not delete them..!!");
               return redirect('doctor/allclinics');
            }
        }
        else
        {
            $req->session()->put('cfalse', "Please fill all required details..!!");
            return redirect('doctor/allclinics');
        }
    }
}
