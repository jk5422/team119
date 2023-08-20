<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\appoinment;
use App\Models\patient;
use App\Models\doctor;
use App\Models\clinic;
use App\Models\service;
use App\Models\payment;
use App\Models\prescription;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class AppoinmentsController extends Controller
{
    function showpatient($id){
        if ($id == session('pid')) {
        $user=patient::find($id);
        $dctr=doctor::all();
        return view('frontend.appoinment',['data'=>$user,'doctor'=>$dctr,'title'=>'Appoinment | ShreeHari']);
        }
        else
        {
            return redirect('/dashboard');
        }
    }

    function checkfordate(Request $req){
        if($req->post('pid')!="" && $req->post('date')!="")
        {
            $cnt=appoinment::where('patients_pid','=',$req->post('pid'))->where('apdate','=',$req->post('date'))->count();

            if($cnt>=1)
            {
                return 'false';
            }
            else
            {
                return 'true';
            }
        }
    }

    function checkforslot(Request $req)
    {
        if($req->post('date')!="")
        {
            $cnt=appoinment::where('apdate','=',$req->post('date'))->count();

            if($cnt>=3)
            {
                return 'false';
            }
            else
            {
                return 'true';
            }
        }
    }

    function makeappoinment(Request $req){
        if($req->input('apdate')!="" && $req->input('aptime')!="" && $req->input('apdctr')!="" && $req->input('apclnc')!="" && $req->input('apsrvc')!="" && $req->input('pid')!=""){

            $cnt=appoinment::where('patients_pid','=',$req->input('pid'))->where('apdate','=',$req->input('apdate'))->count();

            if($cnt>=1)
            {
                $req->session()->put('apflse', "You Can Not Make Two Appoinments For Same Day..!!");
                return redirect(Route('appview',$req->input('pid')));
            }
            else
            {

                $scnt=appoinment::where('apdate','=',$req->input('apdate'))->count();

                if($scnt>=3)
                {
                    $req->session()->put('apflse', "Slot Is Full For choosen Datetime slot..!!");
                   return redirect(Route('appview',$req->input('pid')));
                }
                else
                {
                    $tz = 'Asia/Kolkata';
                    date_default_timezone_set($tz);
                    $date = date('d-m-y h:iA');
                    $res1=substr($date,14,15);
                    $oldtime=$req->input('aptime');
                    $res2=substr($oldtime,5,2);
                    $bh=(int) substr($oldtime,0,2);
                    $ch=(int) substr($date,9,2);
                    $ndate = date('d-m-Y');
                    $bdate=date('d-m-Y',strtotime($req->input('apdate')));


                    if($ndate==$bdate)
                    {
                        if($res2=='AM' && $res1=='PM')
                        {
                            $req->session()->put('apflse', "You can not book appoinment for time already passed..!!");
                             return redirect(Route('appview',$req->input('pid')));
                        }
                        elseif($res2=='PM' && $res1=='AM')
                        {
                            $app=new appoinment();
                            $app->apdate=$req->input('apdate');
                            $app->aptimeslot=$req->input('aptime');
                            $app->doctors_did=$req->input('apdctr');
                            $app->clinics_cid=$req->input('apclnc');
                            $app->services_sid=$req->input('apsrvc');
                            $app->patients_pid=$req->input('pid');
                            $res=$app->save();
                            if($res){
                                $ap=appoinment::orderBy('apno', 'DESC')->first();
                                $pay=new payment();
                                $pay->paymentid=$req->input('payid');
                                $pay->paymode=$req->input('payment');
                                $pay->appt_pid=$ap->patients_pid;
                                $pay->app_apno=$ap->apno;
                                $done=$pay->save();

                                if($done){
                                    $req->session()->put('aptrue', "your appoinment made successfully..!!");
                                    return redirect(Route('appoinments',$req->input('pid')));
                                }
                                else
                                {
                                    $req->session()->put('apflse', "Something Went Wrong in payment..!!");
                                    return redirect(Route('appview',$req->input('pid')));
                                }

                            }
                            else
                            {
                                $req->session()->put('apflse', "Something Went Wrong..!!");
                            return redirect(Route('appview',$req->input('pid')));
                            }
                        }
                        else
                        {
                            if($bh>$ch)
                            {
                                $app=new appoinment();
                                $app->apdate=$req->input('apdate');
                                $app->aptimeslot=$req->input('aptime');
                                $app->doctors_did=$req->input('apdctr');
                                $app->clinics_cid=$req->input('apclnc');
                                $app->services_sid=$req->input('apsrvc');
                                $app->patients_pid=$req->input('pid');
                                $res=$app->save();
                                if($res){
                                    $ap=appoinment::orderBy('apno', 'DESC')->first();
                                    $pay=new payment();
                                    $pay->paymentid=$req->input('payid');
                                    $pay->paymode=$req->input('payment');
                                    $pay->appt_pid=$ap->patients_pid;
                                    $pay->app_apno=$ap->apno;
                                    $done=$pay->save();

                                    if($done){
                                        $req->session()->put('aptrue', "your appoinment made successfully..!!");
                                        return redirect(Route('appoinments',$req->input('pid')));
                                    }
                                    else
                                    {
                                        $req->session()->put('apflse', "Something Went Wrong in payment..!!");
                                        return redirect(Route('appview',$req->input('pid')));
                                    }

                                }
                                else
                                {
                                    $req->session()->put('apflse', "Something Went Wrong..!!");
                                return redirect(Route('appview',$req->input('pid')));
                                }
                            }
                            else
                            {
                                $req->session()->put('apflse', "You can not book appoinment for time already passed..!!");
                             return redirect(Route('appview',$req->input('pid')));
                            }
                        }

                    }
                    else
                    {
                        $app=new appoinment();
                        $app->apdate=$req->input('apdate');
                        $app->aptimeslot=$req->input('aptime');
                        $app->doctors_did=$req->input('apdctr');
                        $app->clinics_cid=$req->input('apclnc');
                        $app->services_sid=$req->input('apsrvc');
                        $app->patients_pid=$req->input('pid');
                        $res=$app->save();
                        if($res){
                            $ap=appoinment::orderBy('apno', 'DESC')->first();
                            $pay=new payment();
                            $pay->paymentid=$req->input('payid');
                            $pay->paymode=$req->input('payment');
                            $pay->appt_pid=$ap->patients_pid;
                            $pay->app_apno=$ap->apno;
                            $done=$pay->save();

                            if($done){
                                $req->session()->put('aptrue', "your appoinment made successfully..!!");
                                return redirect(Route('appoinments',$req->input('pid')));
                            }
                            else
                            {
                                $req->session()->put('apflse', "Something Went Wrong in payment..!!");
                                return redirect(Route('appview',$req->input('pid')));
                            }

                        }
                        else
                        {
                            $req->session()->put('apflse', "Failed to Book Appoinemnt..!!");
                        return redirect(Route('appview',$req->input('pid')));
                        }
                    }


                    }
           }
        }
        else
        {
            $req->session()->put('apflse', "please fill all required fields..!!");
            return redirect(Route('appview',$req->input('pid')));
        }
    }



    function checkforpasttime(Request $req)
    {
        if($req->post('date')!="" && $req->post('time')!="")
        {


        $tz = 'Asia/Kolkata';
        date_default_timezone_set($tz);
        $date = date('d-m-y h:iA');
        $res1=substr($date,14,15);
        $oldtime=$req->post('time');
        $res2=substr($oldtime,5,2);
        $bh=(int) substr($oldtime,0,2);
        $ch=(int) substr($date,9,2);
        $ndate = date('d-m-Y');
        $bdate=date('d-m-Y',strtotime($req->post('date')));


        if($ndate==$bdate)
        {
            if($res2=='AM' && $res1=='PM')
            {
                return 'false';
            }
            elseif($res2=='PM' && $res1=='AM')
            {
               return 'true';
            }
            else
            {
                if($bh>$ch)
                {
                   return 'true';
                }
                else
                {
                    return 'false';
                }
            }

        }
        else
        {
           return 'true';
        }
    }

  }



    function viewappoinments($id){

        if ($id == session('pid')) {
        $app=DB::table('appoinments')->join('patients','appoinments.patients_pid','=','patients.pid')->join('payments','appoinments.apno','=','payments.app_apno')->where('appoinments.patients_pid','=',$id)->get('*');


        // return $app;
        return view('frontend.allappoinments',array("result"=>$app,'title'=>'Allappoinment | ShreeHari'));
        }
        else
        {
            return redirect('dashboard');
        }
    }

    function updateappoinment(Request $req){
        if($req->input('apno')!="" && $req->input('uapdate')!="" && $req->input('uaptime')!="" && $req->input('pid')!=""){


                $tz = 'Asia/Kolkata';
                date_default_timezone_set($tz);
                $date = date('d-m-y h:iA');
                $res1=substr($date,14,15);
                $oldtime=$req->input('uaptime');
                $res2=substr($oldtime,5,2);
                $bh=(int) substr($oldtime,0,2);
                $ch=(int) substr($date,9,2);
                $ndate = date('d-m-Y');
                $bdate=date('d-m-Y',strtotime($req->input('uapdate')));


                if($ndate==$bdate)
                {
                    if($res2=='AM' && $res1=='PM')
                    {
                        $req->session()->put('apupfls', "You can not updare appoinment for time passed..!");
                              return redirect(Route('appoinments',$req->input('pid')));
                    }
                    elseif($res2=='PM' && $res1=='AM')
                    {
                        $app=appoinment::find($req->input('apno'));
                        $app->apdate=$req->input('uapdate');
                        $app->aptimeslot=$req->input('uaptime');
                        $res=$app->save();

                        if($res){
                           $req->session()->put('apupdt', "your appoinment updated successfully..!!");
                           return redirect(Route('appoinments',$req->input('pid')));

                        }
                        else
                        {
                           $req->session()->put('apupfls', "Server Error..!!");
                          return redirect(Route('appoinments',$req->input('pid')));
                        }
                    }
                    else
                    {
                        if($bh>$ch)
                        {
                            $app=appoinment::find($req->input('apno'));
                            $app->apdate=$req->input('uapdate');
                            $app->aptimeslot=$req->input('uaptime');
                            $res=$app->save();

                            if($res){
                               $req->session()->put('apupdt', "your appoinment updated successfully..!!");
                               return redirect(Route('appoinments',$req->input('pid')));

                            }
                            else
                            {
                               $req->session()->put('apupfls', "Server Error..!!");
                              return redirect(Route('appoinments',$req->input('pid')));
                            }
                        }
                        else
                        {
                            $req->session()->put('apupfls', "You can not updare appoinment for time passed..!");
                              return redirect(Route('appoinments',$req->input('pid')));
                        }
                    }

                }
                else
                {
                    $app=appoinment::find($req->input('apno'));
                    $app->apdate=$req->input('uapdate');
                    $app->aptimeslot=$req->input('uaptime');
                    $res=$app->save();

                    if($res){
                       $req->session()->put('apupdt', "your appoinment updated successfully..!!");
                       return redirect(Route('appoinments',$req->input('pid')));

                    }
                    else
                    {
                       $req->session()->put('apupfls', "Server Error..!!");
                      return redirect(Route('appoinments',$req->input('pid')));
                    }
                }


        }
        else
        {
            $req->session()->put('apupfls', "please fill all required fields..!!");
            return redirect(Route('appoinments',$req->input('pid')));
        }


    }

    function upadminappoinment(Request $req){
        if($req->input('apno')!="" && $req->input('uapdate')!="" && $req->input('uaptime')!="" ){


            $tz = 'Asia/Kolkata';
            date_default_timezone_set($tz);
            $date = date('d-m-y h:iA');
            $res1=substr($date,14,15);
            $oldtime=$req->post('time');
            $res2=substr($oldtime,5,2);
            $bh=(int) substr($oldtime,0,2);
            $ch=(int) substr($date,9,2);
            $ndate = date('d-m-Y');
            $bdate=date('d-m-Y',strtotime($req->post('date')));


                if($ndate==$bdate)
                {
                    if($res2=='AM' && $res1=='PM')
                    {
                        $req->session()->put('apupfls', "Time Is Passed..!!");
                        return redirect('doctor/pendappoinments');
                    }
                    elseif($res2=='PM' && $res1=='AM')
                    {
                        $app=appoinment::find($req->input('apno'));
                        $app->apdate=$req->input('uapdate');
                        $app->aptimeslot=$req->input('uaptime');
                        $res=$app->save();

                        if($res){
                           $req->session()->put('apupdt', "your appoinment updated successfully..!!");
                           return redirect('doctor/pendappoinments');
                        }
                        else
                        {
                           $req->session()->put('apupfls', "Server Error..!!");
                           return redirect('doctor/pendappoinments');

                        }
                    }
                    else
                    {
                        if($bh>$ch)
                        {
                            $app=appoinment::find($req->input('apno'));
                            $app->apdate=$req->input('uapdate');
                            $app->aptimeslot=$req->input('uaptime');
                            $res=$app->save();

                            if($res){
                               $req->session()->put('apupdt', "your appoinment updated successfully..!!");
                               return redirect('doctor/pendappoinments');
                            }
                            else
                            {
                               $req->session()->put('apupfls', "Server Error..!!");
                               return redirect('doctor/pendappoinments');

                            }
                        }
                        else
                        {
                            $req->session()->put('apupfls', "Time Is Passed..!!");
                            return redirect('doctor/pendappoinments');
                        }
                    }

                }
                else
                {
                    $app=appoinment::find($req->input('apno'));
                    $app->apdate=$req->input('uapdate');
                    $app->aptimeslot=$req->input('uaptime');
                    $res=$app->save();

                    if($res){
                       $req->session()->put('apupdt', "your appoinment updated successfully..!!");
                       return redirect('doctor/pendappoinments');
                    }
                    else
                    {
                       $req->session()->put('apupfls', "Server Error..!!");
                       return redirect('doctor/pendappoinments');

                    }
                }


        }
        else
        {
            $req->session()->put('apupfls', "please fill all required fields..!!");
            return redirect('doctor/pendappoinments');

        }


    }

    function allappoinments(){
        $app=DB::table('appoinments')->join('patients','appoinments.patients_pid','=','patients.pid')->join('payments','payments.app_apno','=','appoinments.apno')->join('clinics','clinics.cid','=','appoinments.clinics_cid')->where('appoinments.apstatus','=','1')->orwhere('appoinments.apstatus','=','2')->orwhere('appoinments.apstatus','=','0')->get();
        return view('backend.allappoinments',['title'=>'All Appoinments | ShreeHari','data'=>$app]);
    }

    function pendingappoinments(){
        $app=DB::table('appoinments')->join('patients','appoinments.patients_pid','=','patients.pid')->join('payments','payments.app_apno','=','appoinments.apno')->join('doctors','doctors.did','=','appoinments.doctors_did')->where('appoinments.apstatus','=',null)->get();

        return view('backend.pendingappoinments',['title'=>'Pending Appoinements | ShreeHari','data'=>$app]);
    }


    function updateappstatus(Request $req){
        if($req->input('upapno')!=""){

            if($req->input('upast')=='1'){

                $cnt=DB::table('prescriptions')->where('prescriptions.appoinments_apno','=',$req->input('upapno'))->get()->count();

                if($cnt>=1)
                {
                    $app=appoinment::find($req->input('upapno'));
                    $app->apstatus=$req->input('upast');
                    $res=$app->save();
                    if($res){
                        $req->session()->put('atrue', "Appoinment Confirmed..!!");
                    return redirect('doctor/allappoinments');
                    }
                    else
                    {
                        $req->session()->put('afalse', "Server Error..!!");
                    return redirect('doctor/pendappoinments');
                    }
                }
                else
                {
                    $req->session()->put('afalse', "You have not added prescription for this particular appoinment please first add after change status..!!");
                    return redirect('doctor/pendappoinments');
                }


            }
            elseif($req->input('upast')=='0'){
                $app=appoinment::find($req->input('upapno'));
                $app->apstatus=$req->input('upast');
                $res=$app->save();
                if($res){
                    $req->session()->put('atrue', "Appoinment Cancelled..!!");
                return redirect('doctor/allappoinments');
                }
                else
                {
                    $req->session()->put('afalse', "Server Error..!!");
                return redirect('doctor/pendappoinments');
                }
            }
            elseif($req->input('upast')==''){
                $app=appoinment::find($req->input('upapno'));
                $app->apstatus=$req->input('upast');
                $res=$app->save();
                if($res){
                    $req->session()->put('atrue', "Appoinment Updated..!!");
                return redirect('doctor/pendappoinments');
                }
                else
                {
                    $req->session()->put('afalse', "Server Error..!!");
                return redirect('doctor/pendappoinments');
                }
            }
            else
            {
                $req->session()->put('afalse', "Error in appoinment id..!!");
                return redirect('doctor/pendappoinments');
            }
        }
        else
        {
            $req->session()->put('afalse', "Required filed is missing..!!");
                    return redirect('doctor/pendappoinments');
        }
    }

    function patientappcancel(Request $req)
    {
        if($req->input('upapno')!="" && $req->input('pid')!=""){

            if($req->input('upast')=='2'){

                $cnt=DB::table('appoinments')->where('appoinments.apno','=',$req->input('upapno'))->get()->count();

                if($cnt>=1)
                {
                    $app=appoinment::find($req->input('upapno'));
                    $app->apstatus=$req->input('upast');
                    $res=$app->save();

                    if($res)
                    {
                        $req->session()->put('aptrue', "Cancellation Request Sended..!!");
                                return redirect(Route('appoinments',$req->input('pid')));
                    }
                    else
                    {
                        $req->session()->put('apflse', "Server Error..!!");
                        return redirect(Route('appview',$req->input('pid')));
                    }
                }
                else
                {
                    $req->session()->put('apflse', "Apppoinment Deatils Not found..!!");
            return redirect(Route('appview',$req->input('pid')));
                }
            }
            else
            {
                $req->session()->put('apflse', "Failed to send cancellation Request..!!");
            return redirect(Route('appview',$req->input('pid')));
            }
        }
        else
        {
            $req->session()->put('apflse', "Something Went Wrong..!!");
            return redirect(Route('appview',$req->input('pid')));
        }

    }


}
