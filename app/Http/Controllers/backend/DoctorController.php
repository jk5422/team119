<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clinic;
use App\Models\doctor;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class DoctorController extends Controller
{
    function allclinic()
    {
        $clinic = clinic::all();
        $result = json_decode($clinic, true);
        $html = '<option value="">#--- Select Associate Clinic ---#</option>';
        foreach ($result as $list) {
            $html .= '
            <option value="' . $list['cid'] . '">' . $list['cname'] . '</option>';
        }
        return $html;
    }

    function getassclinic(Request $req){
        if($req->post('did')!=""){


        $cnt=DB::table('doctors')->join('clinics','doctors.clinics_cid','=','clinics.cid')->where('doctors.did','=',$req->post('did'))->get('*')->count();

        if($cnt>=1){
        $clinic=DB::table('doctors')->join('clinics','doctors.clinics_cid','=','clinics.cid')->where('doctors.did','=',$req->post('did'))->get('*');

            $html='';
            $result = json_decode($clinic, true);
            foreach ($result as $list) {
                $html .= '
                <option value="' . $list['cid'] . '">' . $list['cname'] . '</option>';
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

    function adddoctor(Request $req)
    {
        if ($req->input('dname') != "" && $req->input('demail') != "" && $req->input('dmobile') != "" && $req->input('dpass') != "" && $req->input('dcpass') != "" && $req->input('dgen') != "" && $req->input('daddress') != "" && $req->input('dqual') != "" && $req->input('dclnc') != "") {

            if ($req->input('dpass') == $req->input('dcpass')) {

                $cnt = doctor::where('dname', 'LIKE', $req->input('dname'))->orwhere('dmobile', '=', $req->input('dmobile'))->orwhere('demail', 'LIKE', $req->input('demail'))->count();

                if ($cnt >= 1) {
                    $req->session()->put('dfalse', "Doctor is already Exist..!!");
                    return redirect('doctor/alldoctor');
                } else {
                    $doc = new doctor();
                    $doc->dname = $req->input('dname');
                    $doc->dgender = $req->input('dgen');
                    $doc->dmobile = $req->input('dmobile');
                    $doc->dpassword = Crypt::encrypt($req->input('dpass'));
                    $doc->demail = $req->input('demail');
                    $doc->dqualification = $req->input('dqual');
                    $doc->daddress = $req->input('daddress');
                    $doc->clinics_cid = $req->input('dclnc');
                    $res = $doc->save();

                    if ($res) {
                        $req->session()->put('dtrue', "New doctor added successfully..!!");
                        return redirect('doctor/alldoctor');
                    } else {
                        $req->session()->put('dfalse', "Server Error..!!");
                        return redirect('doctor/alldoctor');
                    }
                }
            } else {
                $req->session()->put('dfalse', "Password and Confirm Password Mismatch..!!");
                return redirect('doctor/alldoctor');
            }
        } else {
            $req->session()->put('dfalse', "Fill Required Fields..!!");
            return redirect('doctor/alldoctor');
        }
    }

    function logindoctor(Request $req)
    {
        try{
            if ($req->input('username') != "" && $req->input('password') != "")
        {
            $cnt = doctor::where('dmobile', '=', $req->input('username'))->orwhere('demail', 'LIKE', $req->input('username'))->count();

            if ($cnt < 1) {
                $req->session()->put('dlgfls', "Doctor Doesn't exist..!!");
                return redirect('doctor');
            } else {

                $user = doctor::where('dmobile', '=', $req->input('username'))->orwhere('demail', 'LIKE', $req->input('username'))->get();

                if (($user[0]->demail == $req->input('username') || $user[0]->dmobile == $req->input('username')) && Crypt::decrypt($user[0]->dpassword) == $req->input('password'))
                {
                    $req->session()->put('dname', $user[0]->dname);
                    $req->session()->put('did', $user[0]->did);
                    return redirect('doctor/dashboard');
                } else {
                    $req->session()->put('dlgfls', "Invalid Credentials..!!");
                    return redirect('doctor');
                }
            }
        } else {
            $req->session()->put('dlgfls', "Please fill all required details..!!");
            return redirect('doctor');
        }
        }
        catch(QueryException){
            $req->session()->put('dlgfls', "Server Is Shut Down..!!");
            return redirect('doctor');
        }

    }

    function alldoctor(){
        $doc=DB::table('doctors')->join('clinics','doctors.clinics_cid','=','clinics.cid')->distinct()->get('*');
        return view('backend.alldoctor',['title'=>'All Doctors | ShreeHari','data'=>$doc]);
    }

    function alldoc(){
        $clinic = doctor::all();
        $result = json_decode($clinic, true);
        $html = '<option value="">#--- Select Doctor ---#</option>';
        foreach ($result as $list) {
            $html .= '
            <option value="' . $list['did'] . '">' . $list['dname'] . '</option>';
        }
        return $html;
    }

    function docdetails(Request $req){
        if($req->post('did')!=""){
            $doc=DB::table('doctors')->join('clinics','doctors.clinics_cid','=','clinics.cid')->where('doctors.did','=',$req->post('did'))->get('*');
            // $data = json_decode($doc, true);
            return ['data'=>$doc];
        }
    }

    function updatedoctor(Request $req){
        if($req->input('did')!="" && $req->input('dname')!="" && $req->input('dmobile')!="" && $req->input('demail')!="" && $req->input('dqual')!="" && $req->input('dgen')!="" && $req->input('daddress')!="" && $req->input('dclinic')!=""){

            $doc=doctor::find($req->input('did'));
            $doc->dname=$req->input('dname');
            $doc->demail=$req->input('demail');
            $doc->dmobile=$req->input('dmobile');
            $doc->daddress=$req->input('daddress');
            $doc->dgender=$req->input('dgen');
            $doc->clinics_cid=$req->input('dclinic');
            $doc->dqualification=$req->input('dqual');
            $res=$doc->save();

            if($res){
                $req->session()->put('dtrue', "Doctor Details Updated Successfully..!!");
                return redirect('doctor/alldoctor');
            }
            else
            {
                $req->session()->put('dfalse', "Server Error..!!");
            return redirect('doctor/alldoctor');
            }
        }
        else
        {
            $req->session()->put('dfalse', "fill Required Fields..!!");
            return redirect('doctor/alldoctor');
        }
    }

    function deletedoctor(Request $req){
        if($req->input('did')!="")
        {
            try{
                $doc=doctor::find($req->input('did'));
                $res=$doc->delete();
                if($res){
                    $req->session()->put('dtrue', "Doctor Deleted..!!");
                            return redirect('doctor/alldoctor');
                }
            }
            catch(QueryException){
                $req->session()->put('dfalse', "Particular doctors and his other reference entries exits you can not delete them..!!");
                return redirect('doctor/alldoctor');
            }

        }
        else
        {
            $req->session()->put('dfalse', "fill Required Fields..!!");
            return redirect('doctor/alldoctor');
        }
    }

    function changedocpass(Request $req){
        if($req->input('did')!="" && $req->input('dopass')!="" && $req->input('dnpass')!="" && $req->input('dcpass')!="")
        {

            if($req->input('dnpass') == $req->input('dcpass'))
            {
                $doc=doctor::find($req->input('did'));

                if($req->input('dopass')==Crypt::decrypt($doc->dpassword)){
                    $doc->dpassword= Crypt::encrypt($req->input('dnpass'));
                    $res=$doc->save();

                    if($res){
                        $req->session()->put('dpasschng', "Doctor password Changed now you can login with your new password..!!");
                        return redirect('doctor/dlogout');
                    }
                    else
                    {
                        $req->session()->put('dfalse', "Server Error..!!");
                        return redirect('doctor/alldoctor');
                    }
                }
                else
                {
                    $req->session()->put('dfalse', "Old Password Mismatch..!!");
                   return redirect('doctor/alldoctor');
                }
            }
            else
            {
                $req->session()->put('dfalse', "Password and Confirm Password Mismatch..!!");
                return redirect('doctor/alldoctor');
            }
        }
        else
        {
            $req->session()->put('dfalse', "fill Required Fields..!!");
            return redirect('doctor/alldoctor');
        }
    }

}
