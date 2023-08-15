<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\patient;
use Illuminate\Support\Facades\Crypt;

class ChangePass extends Controller
{
    //
    function change($id){

        if ($id == session('pid')) {
        $user=patient::find($id);
        return view('frontend.changepassword',['data'=>$user,'title'=>'ChangePassword | ShreeHari']);
        }
        else
        {
            return redirect('dashboard');
        }
    }

    function updatepass(Request $req){

        if($req->input('pid')!="" && $req->input('opass')!="" && $req->input('npass')!="" && $req->input('cnpass')!=""){

            if($req->input('npass') != $req->input('cnpass')){
                $req->session()->put('passflse', "New Password and Confirm Password Doesn't Match..!!");
             return redirect(Route('changepass',$req->input('pid')));
            }
            else
            {
                $user=patient::find($req->input('pid'));
            // return ;
            if(Crypt::decrypt($user['password'])==$req->input('opass')){
                $user->password=Crypt::encrypt($req->input('npass'));
                $res=$user->save();
                if($res){
                    $req->session()->put('passtrue', "Password changed now  login with new password..!!");
                    return redirect('/logout');
                }
            }
            else
            {
                $req->session()->put('passflse', "Old Password is wrong please try again..!!");
             return redirect(Route('changepass',$req->input('pid')));
            }
        }

        }
        else
        {
            $req->session()->put('passflse', "Please fill required fields..!!");
             return redirect(Route('changepass',$req->input('pid')));
        }

    }
}
