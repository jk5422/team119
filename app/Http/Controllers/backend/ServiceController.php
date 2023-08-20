<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\service;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class ServiceController extends Controller
{
    function allservices(){
        $ser=DB::table('services')->join('clinics','services.clinics_cid','=','clinics.cid')->join('doctors','services.doctors_did','=','doctors.did')->get('*');

        return view('backend.allservices',['title'=>'All Services | ShreeHari','data'=>$ser]);
    }

    function getservices(){
        $ser=service::all();
        $result=json_decode($ser,true);
        $html='<option value="">#--Select Services--#</option>';

        foreach($result as $item){
            $html.='<option value="'.$item['sid'].'">'.$item['sname'].'</option>';
        }
        return $html;
    }

    function getservicelistdetail(Request $req){
        if($req->post('sid')!=""){
            $ser=DB::table('services')->join('doctors','doctors.did','=','services.doctors_did')->join('clinics','clinics.cid','=','services.clinics_cid')->where('services.sid','=',$req->post('sid'))->get('*');

            return ['data'=>$ser];
        }
        else
        {
            return ['data'=>'#--Not Found--#'];
        }
    }

    function addservice(Request $req){
        if($req->input('sname')!="" && $req->input('sadddr')!="" && $req->input('sadclnc')!=""){

            $cnt=DB::table('services')->where('sname','LIKE',$req->input('sname'))->where('doctors_did','=',$req->input('sadddr'))->get('*')->count();

            if($cnt>=1){

                $req->session()->put('sfalse', "Service Details Already Exist..!!");
                return redirect('doctor/allservices');
            }
            else
            {
                $ser=new service();
                $ser->sname=$req->input('sname');
                $ser->doctors_did=$req->input('sadddr');
                $ser->clinics_cid=$req->input('sadclnc');
                $res=$ser->save();

                if($res){
                    $req->session()->put('strue', "New Service Added..!!");
                    return redirect('doctor/allservices');
                }
                else
                {
                    $req->session()->put('sfalse', "Server Error..!!");
                    return redirect('doctor/allservices');
                }
            }
        }
        else
        {
            $req->session()->put('sfalse', "fill Required Fields..!!");
                return redirect('doctor/allservices');
        }
    }

    function serviceupdate(Request $req)
    {
        if($req->input('usid')!="" && $req->input('usrnm')!="" && $req->input('usrdr')!="" && $req->input('usrcl')!=""){

                $ser=service::find($req->input('usid'));
                $ser->sname=$req->input('usrnm');
                $ser->doctors_did=$req->input('usrdr');
                $ser->clinics_cid=$req->input('usrcl');
                $res=$ser->save();

                if($res){
                    $req->session()->put('strue', "Service Details Updated..!!");
                    return redirect('doctor/allservices');
                }
                else
                {
                    $req->session()->put('sfalse', "Server Error..!!");
                    return redirect('doctor/allservices');
                }

        }
        else
        {
            $req->session()->put('sfalse', "fill Required Fields..!!");
            return redirect('doctor/allservices');
        }
    }

    function delservice(Request $req)
    {
        if($req->input('dsrid')!="")
        {
            try{
                    $ser=service::find($req->input('dsrid'));
                $res=$ser->delete();

                if($res){
                    $req->session()->put('strue', "Service Deleted..!!");
                        return redirect('doctor/allservices');
                }
                else
                {
                    $req->session()->put('sfalse', "Server Error..!!");
                    return redirect('doctor/allservices');
                }
            }
            catch(QueryException)
            {
                $req->session()->put('sfalse', "Particular Services and his other reference entries exits you can not delete them..!!");
               return redirect('doctor/allservices');

            }

        }
        else
        {
            $req->session()->put('sfalse', "fill Required Fields..!!");
            return redirect('doctor/allservices');
        }
    }
}
