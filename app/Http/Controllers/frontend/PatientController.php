<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\patient;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Routing\Route;
use Illuminate\Routing\RouteUri;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    function register(Request $req)
    {
        if ($req->input('pname') != "" && $req->input('pmobile') != "" && $req->input('pemail') != "" && $req->input('page') != "" && $req->input('ppass') != "" && $req->input('paddress') != "")
        {
            $cnt = patient::where('pname', 'LIKE', $req->input('pname'))->where('pmobile', '=', $req->input('pmobile'))->where('pemail', 'LIKE', $req->input('pemail'))->count();

            if ($cnt >= 1) {
                $req->session()->put('ptreg', "Patient account already exist..!!");
                return redirect('register');
            } else {
                $user = new patient();
                $user->pname = $req->input('pname');
                $user->pmobile = $req->input('pmobile');
                $user->pemail = $req->input('pemail');
                $user->page = $req->input('page');
                $user->pgender = $req->input('pgen');
                $user->password = Crypt::encrypt($req->input('ppass'));
                $user->paddress = $req->input('paddress');
                $res = $user->save();
                if ($res) {
                    $req->session()->put('ptreg', "Patient register successfully..!!");
                    return redirect('login');
                }
            }
        } else {
            $req->session()->put('ptreg', "Please fill all required details..!!");
            return redirect('register');
        }
    }

    function login(Request $req)
    {
        if ($req->input('ptlgnm') != "" && $req->input('ptlgpass') != "") {
            $cnt = patient::where('pmobile', '=', $req->input('ptlgnm'))->orwhere('pemail', 'LIKE', $req->input('ptlgnm'))->count();

            if ($cnt < 1) {
                $req->session()->put('ptlog', "Patient  Doesn't exist..!!");
                return redirect('login');
            } else {

                $user = patient::where('pmobile', '=', $req->input('ptlgnm'))->orwhere('pemail', 'LIKE', $req->input('ptlgnm'))->get();
                if (($user[0]->pemail == $req->input('ptlgnm') || $user[0]->pmobile == $req->input('ptlgnm')) && Crypt::decrypt($user[0]->password) == $req->input('ptlgpass')) {
                    $req->session()->put('pname', $user[0]->pname);
                    $req->session()->put('pid', $user[0]->pid);
                    return redirect('dashboard');
                } else {
                    $req->session()->put('ptlog', "Invalid Credentials..!!");
                    return redirect('login');
                }
            }
        } else {
            $req->session()->put('ptlog', "Please fill all required details..!!");
            return redirect('login');
        }
    }

    function profileview($id)
    {
        if ($id == session('pid')) {

            $users = patient::where('pid', '=', $id)->get('*');
            return view('frontend.profile', ['data' => $users,'title'=>'Profile | ShreeHari']);
        } else {
            return redirect('dashboard');
        }
    }

    function profileupdate(Request $req)
    {
        if ($req->input('pid') == session('pid')) {

            if ($req->input('pname') != "" && $req->input('pmobile') != "" && $req->input('pemail') != "" && $req->input('page') != ""  && $req->input('paddress') != "") {
                $users = patient::where('pid', '=', $req->input('pid'))->get('*')->first();
                $users->pname = $req->input('pname');
                $users->pmobile = $req->input('pmobile');
                $users->pemail = $req->input('pemail');
                $users->page = $req->input('page');
                $users->pgender = $req->input('pgen');
                $users->paddress = $req->input('paddress');
                $result = $users->save();
                if ($result) {
                    $req->session()->put('prupdt', "Profile updated..!!");
                    return redirect(Route('profile',$req->input('pid')));
                }
            }
            else
            {
                $req->session()->put('prupdtfls', "please fill all required field..!!");
                return redirect(Route('profile',$req->input('pid')));
            }
        } else {
            return redirect('dashboard');
        }
    }

    function allpatients(){
        $pt=patient::all();
        return view('backend.allpatients',['title'=>'All Patients | ShreeHari','data'=>$pt]);
    }
}
