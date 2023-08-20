<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\prescription;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Component\HttpFoundation\Session\Session;

class PrescreptionController extends Controller
{
    function addprescription(Request $req)
    {
        try{

            if($req->input('apno')!="" && $req->input('mid')!=""){

                $cnt=count($req->input('mid'));
                if($cnt==1){
                    for($i=0;$i<$cnt;$i++){
                        $pre=new prescription();
                        $pre->appoinments_apno=$req->input('apno');
                        $pre->medicines_medid=$req->input('mid')[$i];
                        $pre->morning=$req->input('mrng')[$i];
                        $pre->afternoon=$req->input('afrn')[$i];
                        $pre->evening=$req->input('evng')[$i];
                        $pre->night=$req->input('nght')[$i];
                        $pre->remarks=$req->input('remark')[$i];
                        $res=$pre->save();
                    }
                    if($res){
                        $req->session()->put('atrue', "Prescreption Added..!!");
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
                $flag='';
               for($i=0;$i<=$cnt-2;$i++)
               {
                    if($req->input('mid')[$i]==$req->input('mid')[$cnt-1])
                    {
                        $flag='false';
                        break;
                    }

               }

               if($flag!='false'){
                for($i=0;$i<=$cnt-1;$i++)
                {
                        $pre=new prescription();
                        $pre->appoinments_apno=$req->input('apno');
                        $pre->medicines_medid=$req->input('mid')[$i];
                        $pre->morning=$req->input('mrng')[$i];
                        $pre->afternoon=$req->input('afrn')[$i];
                        $pre->evening=$req->input('evng')[$i];
                        $pre->night=$req->input('nght')[$i];
                        $pre->remarks=$req->input('remark')[$i];
                        $res=$pre->save();
                }

                if($res){
                    $req->session()->put('atrue', "Prescreption Added..!!");
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
                        $req->session()->put('afalse', "Same Medicine You have Addded Two Times..!!");
                        return redirect('doctor/pendappoinments');

                    }
            }



            }
            else
            {
                $req->session()->put('afalse', "Fill Required Fields..!!");
                        return redirect('doctor/pendappoinments');
            }

        }
        catch(QueryException){
            $req->session()->put('afalse', "Same Medicine You have Addded Two Times..!!");
                return redirect('doctor/pendappoinments');
        }

    }

    function getpresdetails(Request $req)
    {
        if($req->post('apno')!=""){

            $pres=DB::table('prescriptions')->where('prescriptions.appoinments_apno','=',$req->post('apno'))->get()->count();
            return $pres;
        }
    }


    function getprescription($id){
        if($id!=""){
            $cnt=DB::table('prescriptions')->where('prescriptions.appoinments_apno','=',$id)->get()->count();

            if($cnt>=1){

                $pres=DB::table('prescriptions')->join('medicines','medicines.medicineid','=','prescriptions.medicines_medid')->where('prescriptions.appoinments_apno','=',$id)->get();

                return view('backend.updateprescription',['title'=>'update Presecription | ShreeHari','data'=>$pres]);

            }
            else
            {
                Session()->put('afalse', "You have not added precection for this appoinment..!!");
                return view('backend.404',['title'=>'Error | ShreeHari']);
            }
        }
        else
        {
            return redirect('doctor/pendappoinments');

        }
    }

    function updateprescription(Request $req)
    {
        try{

            if($req->input('apno')!="" && $req->input('mid')!="")
            {

                $cnt=count($req->input('mid'));
                if($cnt==1)
                {
                    $del=DB::table('prescriptions')->where('prescriptions.appoinments_apno','=',$req->input('apno'));
                    $resdel=$del->delete();
                    if($resdel){
                        for($i=0;$i<$cnt;$i++){
                            $pre=new prescription();
                            $pre->appoinments_apno=$req->input('apno');
                            $pre->medicines_medid=$req->input('mid')[$i];
                            $pre->morning=$req->input('mrng')[$i];
                            $pre->afternoon=$req->input('afrn')[$i];
                            $pre->evening=$req->input('evng')[$i];
                            $pre->night=$req->input('nght')[$i];
                            $pre->remarks=$req->input('remark')[$i];
                            $res=$pre->save();
                        }
                        if($res){
                            $req->session()->put('atrue', "Prescreption Updated..!!");
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
                        $req->session()->put('afalse', "Old prescription not exist..!!");
                            return redirect('doctor/pendappoinments');
                    }

            }
            else
            {
                $flag='';
               for($i=0;$i<=$cnt-2;$i++)
               {
                    if($req->input('mid')[$i]==$req->input('mid')[$cnt-1])
                    {
                        $flag='false';
                        break;
                    }

               }

               if($flag!='false')
               {

                $del=DB::table('prescriptions')->where('prescriptions.appoinments_apno','=',$req->input('apno'));
                $resdel=$del->delete();
                 if($resdel){

                    for($i=0;$i<=$cnt-1;$i++)
                    {
                            $pre=new prescription();
                            $pre->appoinments_apno=$req->input('apno');
                            $pre->medicines_medid=$req->input('mid')[$i];
                            $pre->morning=$req->input('mrng')[$i];
                            $pre->afternoon=$req->input('afrn')[$i];
                            $pre->evening=$req->input('evng')[$i];
                            $pre->night=$req->input('nght')[$i];
                            $pre->remarks=$req->input('remark')[$i];
                            $res=$pre->save();
                    }

                            if($res){
                                $req->session()->put('atrue', "Prescreption Updated..!!");
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
                    $req->session()->put('afalse', "Old prescreption doesn't exist..!!");
                    return redirect('doctor/pendappoinments');
                 }

               }
               else
                    {
                        $req->session()->put('afalse', "Same Medicine You have Addded Two Times..!!");
                        return redirect('doctor/pendappoinments');

                    }
            }



        }
        else
         {
                $req->session()->put('afalse', "Fill Required Fields..!!");
                        return redirect('doctor/pendappoinments');
        }
    }
    catch(QueryException)
    {
            $req->session()->put('afalse', "Same Medicine You have Addded Two Times..!!");
            // return (String)$e;
            return redirect('doctor/pendappoinments');

     }
  }
}
