<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\appoinment;

class DashboardController extends Controller
{
    function getallcount()
    {
        $apccnt=DB::table('appoinments')->where('appoinments.apstatus','=','1')->get()->count();

        $appcnt=DB::table('appoinments')->where('appoinments.apstatus','=',null)->get()->count();

        $ptcnt=DB::table('patients')->get()->count();

        $contact=DB::table('appoinments')->where('appoinments.apstatus','=','2')->get()->count();


        return ['apccount'=>$apccnt,'appcount'=>$appcnt,'patients'=>$ptcnt,'contact'=>$contact];
    }

    function getrecentapp(){
        $rcntapp=appoinment::join('patients','patients.pid','=','appoinments.patients_pid')->join('payments','payments.app_apno','=','appoinments.apno')->where('appoinments.apstatus','=',null)->orderBy('appoinments.created_at','desc')->get()->take(5);
        $html='';
        for($i=0;$i<count($rcntapp);$i++){


                                $html.='<tr>
                                        <td>'.$rcntapp[$i]->apno.'</td>
                                        <td>'.date('d-m-Y', strtotime($rcntapp[$i]->apdate)).'</td>
                                        <td>'.$rcntapp[$i]->aptimeslot.'</td>
                                        <td>'.$rcntapp[$i]->pname.'</td>';

                                        if($rcntapp[$i]->apstatus==''){

                                            $html.='<td>Pending</td>';
                                        }

                                        $html.='<td>'.$rcntapp[$i]->paymode.'</td>';

                                        $html.="<td><a type='button' class='btn btn-primary' onclick=window.open('/doctor/dashboard/pdf/".$rcntapp[$i]->apno."','_blank','width=800,height=500');>View</a></td>";

                                    $html.='</tr>';

                    }

                    return $html;
    }

    function getpayments(){

        $rcntpay=appoinment::join('payments','payments.app_apno','=','appoinments.apno')->orderBy('appoinments.created_at','desc')->get()->take(5);
        $html='';
        for($i=0;$i<count($rcntpay);$i++){


                                $html.='<tr>
                                        <td>'.$rcntpay[$i]->apno.'</td>
                                        <td>'.date('d-m-Y H:m:s a', strtotime($rcntpay[$i]->created_at)).'</td>';

                                        if($rcntpay[$i]->paymentid!=''){

                                            $html.='<td>'.$rcntpay[$i]->paymentid.'</td>';
                                        }
                                        else
                                        {
                                            $html.='<td>Cash On Counter</td>';
                                        }

                                    $html.='</tr>';

                    }

                    return $html;
    }
}
