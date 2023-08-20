<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\payment;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    function allpayments(){
        $pay=DB::table('payments')->join('patients','payments.appt_pid','=','patients.pid')->join('appoinments','payments.app_apno','=','appoinments.apno')->get('*');

        return view('backend.allpayments',['title'=>'All Payments | ShreeHari','data'=>$pay]);
    }
}
