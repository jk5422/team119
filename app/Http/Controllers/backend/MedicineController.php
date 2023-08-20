<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\medicine;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class MedicineController extends Controller
{
    function allmedicines(){
        $med=DB::table('medicines')->join('doctors','medicines.doctors_did','=','doctors.did')->get('*');
        // return $med;
        return view('backend.allmedicines',['title'=>'All Medicines | ShreeHari','data'=>$med]);
    }

    function getmedicinelist(){
        $med=medicine::all();
        $result=json_decode($med,true);
        $html='<option value="">#--Select Medicine--#</option>';

        foreach($result as $item){
            $html.='<option value="'.$item['medicineid'].'">'.$item['medicinename'].'</option>';
        }
        return $html;
    }

    function medicinedetails(Request $req){
        if($req->post('mid')!=""){
            $med=DB::table('medicines')->join('doctors','doctors.did','=','medicines.doctors_did')->where('medicines.medicineid','=',$req->post('mid'))->get('*');

            return ['data'=>$med];
        }
        else
        {
            return ['data'=>'#--Not Found--#'];
        }
    }

    function addmedicine(Request $req){
        if($req->input('medname')!="" && $req->input('medaddr')!=""){

            $cnt=DB::table('medicines')->where('medicinename','LIKE',$req->input('medname'))->where('doctors_did','=',$req->input('medaddr'))->count();

            if($cnt>=1){
                $req->session()->put('mfalse', "Medicine Already Exist..!!");
                    return redirect('doctor/allmedicines');
            }
            else
            {
                $med=new medicine();
                $med->medicinename=$req->input('medname');
                $med->doctors_did=$req->input('medaddr');
                $res=$med->save();

                if($res){
                    $req->session()->put('mtrue', "Medicine Added..!!");
                    return redirect('doctor/allmedicines');
                }
                else
                {
                    $req->session()->put('mfalse', "Server Error..!!");
                    return redirect('doctor/allmedicines');
                }
            }

        }
        else
        {
            $req->session()->put('mfalse', "fill Required Fields..!!");
            return redirect('doctor/allmedicines');
        }
    }

    function medicineupdate(Request $req)
    {
        if($req->input('umedid')!="" && $req->input('umedname')!="" && $req->input('umedaddr')!="")
        {
                $med=medicine::find($req->input('umedid'));
                $med->medicinename=$req->input('umedname');
                $med->doctors_did=$req->input('umedaddr');
                $res=$med->save();

                if($res){
                    $req->session()->put('mtrue', "Medicine details Updated..!!");
                    return redirect('doctor/allmedicines');
                }
                else
                {
                    $req->session()->put('mfalse', "Server Error..!!");
                    return redirect('doctor/allmedicines');
                }
            }
            else
            {
                $req->session()->put('mfalse', "fill Required Fields..!!");
                return redirect('doctor/allmedicines');
            }

    }

    function delmedicine(Request $req){
        if($req->input('dmedid')!=""){
            try{
                $med=medicine::find($req->input('dmedid'));
                $res=$med->delete();
                if($res){
                    $req->session()->put('mtrue', "Medicine Deleted..!!");
                            return redirect('doctor/allmedicines');
                }
            }
            catch(QueryException){
                $req->session()->put('mfalse', "Particular Medicine and his other reference entries exits you can not delete them..!!");
                return redirect('doctor/allmedicines');
            }
        }
        else
        {
            $req->session()->put('mfalse', "fill Required Fields..!!");
            return redirect('doctor/allmedicines');
        }
    }
}
