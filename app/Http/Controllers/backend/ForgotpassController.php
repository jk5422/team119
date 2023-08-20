<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\patient;
use App\Models\doctor;

class ForgotpassController extends Controller
{
    function forgetpage()
    {
        return view('frontend.forgot',['title'=>'Forgot Patient Password']);
    }

    function sendemail(Request $req)
    {
        if($req->input('fusername')!="")
        {
            $cnt=DB::table('patients')->where('patients.pemail','LIKE',$req->input('fusername'))->get()->count();

            if($cnt>=1)
            {
                function password_generate($chars)
                {
                $data = '1234567890';
                return substr(str_shuffle($data), 0, $chars);
                }

                $otp=password_generate(6);

                if(Session('potp')=="" && Session('pemail')==""){
                    $req->session()->put('potp',$otp);
                    $req->session()->put('pemail',$req->input('fusername'));
                }
                else
                {
                    Session()->forget('potp');
                    Session()->forget('pemail');

                    $req->session()->put('potp',$otp);
                    $req->session()->put('pemail',$req->input('fusername'));
                }


                $mail=mail($req->input('fusername'),'Forgot Patient Password For ShreeHari','Dear Patients your one time otp is '.$otp.'. Never share otp with anyone else.','From: koladiyajaimin@gmail.com');

                if($mail)
                {

                    $req->session()->put('otrue',"We have sended mail on your gmail :".$req->input('fusername'));
                    return view('frontend.otppage',['title'=>'OTP Verification','email'=>$req->input('fusername')]);
                }
                else
                {
                    $req->session()->put('efalse', "Error in sending mail..!!");
                    return redirect('/forgot');
                }


            }
            else
            {
                $req->session()->put('efalse', "Please Enter Email which is Registerd at that time of Create Account..!!");
               return redirect('/forgot');
            }
        }
        else
        {
            $req->session()->put('efalse', "Fill Required fields..!!");
            return redirect('/forgot');
        }
    }

    function getotp(Request $req)
    {
        if($req->post('otp')!="")
        {
            $sotp=Session()->get('potp');
            $notp=$req->post('otp');

            if($sotp==$notp)
            {
                Session()->forget('potp');
                Session()->forget('pemail');
                return 'true';
            }
            else
            {
                return 'false';
            }
        }
    }

    function resendemail(Request $req)
    {
        if($req->post('pemail')!=""){


        function password_generate($chars)
                {
                $data = '1234567890';
                return substr(str_shuffle($data), 0, $chars);
                }

                $otp=password_generate(6);

                if(Session('potp')=="" && Session('pemail')==""){
                    $req->session()->put('potp',$otp);
                    $req->session()->put('pemail',$req->post('pemail'));
                }
                else
                {
                    Session()->forget('potp');
                    Session()->forget('pemail');

                    $req->session()->put('potp',$otp);
                    $req->session()->put('pemail',$req->post('pemail'));
                }


                $mail=mail($req->post('pemail'),'Forgot Patient Password For ShreeHari','Dear Patients your one time otp is '.$otp.'. Never share otp with anyone else.','From: koladiyajaimin@gmail.com');

                if($mail)
                {
                    return 'true';
                }
                else
                {
                    return 'false';

                }
        }
    }


    function setnewcredentials(Request $req)
    {
        if($req->post('info')!=""){

            $arr=explode(',',$req->post('info'));
            // return $arr[2];

            $patient=patient::where('patients.pemail','LIKE',$arr[2])->first();
            $patient->password = Crypt::encrypt($arr[0]);
            $res=$patient->save();

            if($res)
            {
                return 'true';
            }
            else
            {
                return 'false';
            }
        }
    }


    //******************** doctor forgot pass*****************//

    function drforgotindex()
    {
        return view('backend.forgot',['title'=>'Dr.Pass Forgot']);
    }

    function drsendemail(Request $req){
        if($req->input('demail')!="")
        {
            $cnt=DB::table('doctors')->where('doctors.demail','LIKE',$req->input('demail'))->get()->count();

            if($cnt>=1)
            {
                function password_generate($chars)
                {
                $data = '1234567890';
                return substr(str_shuffle($data), 0, $chars);
                }

                $otp=password_generate(6);

                if(Session('dotp')=="" && Session('demail')==""){
                    $req->session()->put('dotp',$otp);
                    $req->session()->put('demail',$req->input('demail'));
                }
                else
                {
                    Session()->forget('dotp');
                    Session()->forget('demail');

                    $req->session()->put('dotp',$otp);
                    $req->session()->put('demail',$req->input('demail'));
                }

                $mail=mail($req->input('demail'),'Forgot Doctor Password For ShreeHari','Dear Respected Doctors your one time otp is '.$otp.'. Never share otp with anyone else.','From: koladiyajaimin@gmail.com');

                if($mail)
                {

                    $req->session()->put('drtrue',"We have sended mail on your gmail :".$req->input('demail'));
                    return view('backend.otp',['title'=>'Doctor OTP Verification','demail'=>$req->input('demail')]);
                }
                else
                {
                    $req->session()->put('drfalse', "Error in sending mail..!!");
                    return redirect('/doctor/forgot');
                }


            }
            else
            {
                $req->session()->put('drfalse', "Please Enter Email which is Registerd at that time of Create Account..!!");
               return redirect('/doctor/forgot');
            }
        }
        else
        {
            $req->session()->put('drfalse', "Fill Required fields..!!");
            return redirect('/doctor/forgot');
        }
    }


    function drgetotp(Request $req)
    {
        if($req->post('otp')!="")
        {
            $sotp=Session()->get('dotp');
            $notp=$req->post('otp');

            if($sotp==$notp)
            {
                Session()->forget('dotp');
                Session()->forget('demail');
                return 'true';
            }
            else
            {
                return 'false';
            }

        }
    }

    function drresendemail(Request $req)
    {
        if($req->post('demail')!=""){


        function password_generate($chars)
                {
                $data = '1234567890';
                return substr(str_shuffle($data), 0, $chars);
                }

                $otp=password_generate(6);

                if(Session('dotp')=="" && Session('demail')==""){
                    $req->session()->put('dotp',$otp);
                    $req->session()->put('demail',$req->post('demail'));
                }
                else
                {
                    Session()->forget('dotp');
                    Session()->forget('demail');

                    $req->session()->put('dotp',$otp);
                    $req->session()->put('demail',$req->post('demail'));
                }


                $mail=mail($req->post('demail'),'Forgot Doctor Password For ShreeHari','Dear Respected Dotors your one time otp is '.$otp.'. Never share otp with anyone else.','From: koladiyajaimin@gmail.com');

                if($mail)
                {
                    return 'true';
                }
                else
                {
                    return 'false';

                }
        }
    }


    function drsetnewcredentials(Request $req)
    {
        if($req->post('info')!=""){

            $arr=explode(',',$req->post('info'));

            $doctor=doctor::where('doctors.demail','LIKE',$arr[2])->first();
            $doctor->dpassword = Crypt::encrypt($arr[0]);
            $res=$doctor->save();

            if($res)
            {
                return 'true';
            }
            else
            {
                return 'false';
            }
        }
    }
}
