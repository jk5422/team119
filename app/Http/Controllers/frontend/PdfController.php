<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\appoinment;
use Illuminate\Support\Facades\DB;
use Elibyy\TCPDF\Facades\TCPDF as PDF;

class PdfController extends Controller
{

    public function index($id)
    {
        $user = DB::table('appoinments')->join('patients', 'appoinments.patients_pid', '=', 'patients.pid')->join('payments', 'appoinments.apno', '=', 'payments.app_apno')->join('services', 'appoinments.services_sid', '=', 'services.sid')->join('clinics', 'appoinments.clinics_cid', '=', 'clinics.cid')->join('doctors', 'appoinments.doctors_did', '=', 'doctors.did')->where('appoinments.apno', '=', $id)->distinct()->get('*');

        if ($id == $user[0]->apno) {

            $html = '<table border="1" cellpadding="5" cellspacing="3" style="">
        <tr>
        <td colspan="6" style="text-align:center;"><h2>Appoinment Receipt</h2></td>
        </tr>
        <tr><td rowspan="4" colspan="3"><img src="frontend/images/logo_1.jfif" alt="ShreeHari" height="80px" width="180px"/><br/><h6><i>' . $user[0]->caddress . '</i></h6></td>
            <td colspan="3" style="text-align:center;"><b>Appoinment Details</b></td>
        </tr>
        <tr><td colspan="1">Appoinment No :</td><td colspan="2">' . $user[0]->apno . '</td></tr>
        <tr><td colspan="1">Appoinment Date :</td><td colspan="2">' . date('d-m-Y', strtotime($user[0]->apdate)) . '</td></tr>
        <tr><td colspan="1">Appoinment Time :</td><td colspan="2">' . $user[0]->aptimeslot . '</td></tr>


        <tr><th colspan="6" style="text-align:center;"><b>Patient Details</b></th></tr>
        <tr>
        <td colspan="3">Name :</td><td colspan="3">' . $user[0]->pname . '</td></tr>
        <tr><td colspan="3">Mobile :</td><td colspan="3">' . $user[0]->pmobile . '</td></tr>
        <tr>
        <td colspan="3">Email :</td><td colspan="3">' . $user[0]->pemail . '</td></tr>
        <tr><td colspan="3">Address :</td><td colspan="3">' . $user[0]->paddress . '</td></tr>

        <tr><th colspan="6" style="text-align:center;"><b>Service Details</b></th></tr>
        <tr style="text-align:center;"><th colspan="3">Service Name</th><th colspan="3">Doctor Name</th></tr>
        <tr style="text-align:center;"><td colspan="3">' . $user[0]->sname . '</td><td colspan="3">' . $user[0]->dname . '(' . $user[0]->dqualification . ')</td></tr>

        <tr><th colspan="6" style="text-align:center;"><b>Payment Details</b></th></tr>
        <tr style="text-align:center;"><td colspan="2">PayId</td><td colspan="2">Payment Mode</td><td colspan="2">Amount(in Rs.)</td></tr>
        <tr>';

            if ($user[0]->paymentid != "") {

                $html .= '<td colspan="2">' . $user[0]->paymentid . '</td>';
            } else {
                $html .= '<td colspan="2">Amount to be pay(INR)</td>';
            }

            $html .= '<td colspan="2">' . $user[0]->paymode . '</td><td colspan="2">Rs.50/-</td></tr>

        <tr><td colspan="3" rowspan="2" style="font-size: 10px;text-align: left;"><b style="color:red;text-align:center;">#___Terms & Condition___#</b><br><em><ol><li>Bring this appointment copy receipt when the patient comes to the clinic for an appointment.</li><li>If the patient has kept the payment mode cash while taking the appointment, then the cost will have to be paid in cash when the patient comes to the clinic for the appointment.</li></ol></em></td>

        <td colspan="3"><b style="color:green;text-align:center;">*___Signed By___*</b><br><br><br><br>Doctor Sign. : &nbsp;&nbsp;&nbsp;&nbsp; __________________ <br><br><br> Date : &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;__________________<br><br><br><br><br></td>

        </tr>
        </table>';

            PDF::SetTitle($user[0]->pname . '_' . 'AppoinmentNo' . '_' . $user[0]->apno);
            PDF::AddPage();
            PDF::writeHTML($html, true, false, true, false, '');
            PDF::Output($user[0]->pname . '_' . $user[0]->apno . '.pdf');
        }
        else
        {
            return redirect('dashboard');
        }
    }

    public function prescriptionview($id){
        $user = DB::table('appoinments')->join('patients', 'appoinments.patients_pid', '=', 'patients.pid')->join('prescriptions', 'appoinments.apno', '=', 'prescriptions.appoinments_apno')->join('services', 'appoinments.services_sid', '=', 'services.sid')->join('clinics', 'appoinments.clinics_cid', '=', 'clinics.cid')->join('doctors', 'appoinments.doctors_did', '=', 'doctors.did')->where('appoinments.apno', '=', $id)->distinct()->get('*');

        // ->join('prescriptions', 'prescriptions.medicines_medid', '=', 'medicines.medicineid')

        $pres=DB::table('prescriptions')->join('appoinments','appoinments.apno','=','prescriptions.appoinments_apno')->join('medicines','medicines.medicineid','=','prescriptions.medicines_medid')->where('prescriptions.appoinments_apno','=',$id)->get('*');


        if ($id == $user[0]->apno) {

            $html = '<table border="1" cellpadding="5" cellspacing="3" style="">
        <tr>
        <td colspan="6" style="text-align:center;"><h2>Prescription Reciept</h2></td>
        </tr>
        <tr><td rowspan="4" colspan="3"><img src="frontend/images/logo_1.jfif" alt="ShreeHari" height="80px" width="180px"/><br/><h6><i>' . $user[0]->caddress . '</i></h6></td>
            <td colspan="3" style="text-align:center;"><b>Patient Details</b></td>
        </tr>
        <tr><td colspan="1">Patient Name:</td><td colspan="2">' . $user[0]->pname. '</td></tr>
        <tr><td colspan="1">Appoinment No :</td><td colspan="2">' . $user[0]->apno . '</td></tr>
        <tr><td colspan="1">Appoinment Date :</td><td colspan="2">' . date('d-m-Y', strtotime($user[0]->apdate)) . '</td></tr>



        <tr><th colspan="6" style="text-align:center;"><b>Service Details</b></th></tr>
        <tr style="text-align:center;"><th colspan="3">Service Name</th><th colspan="3">Doctor Name</th></tr>
        <tr style="text-align:center;"><td colspan="3">' . $user[0]->sname . '</td><td colspan="3">' . $user[0]->dname . '(' . $user[0]->dqualification . ')</td></tr>

        <tr><th colspan="6" style="text-align:center;"><b>Prescription Details</b></th></tr>
        <tr>
        <th colspan="1" style="text-align:center;font-weight:bold;color:blue;">Medicines</th>
        <th colspan="5"><b style="color:green;text-align:center;"><u>Time</u></b><br><br>
        [BB-Before Breakfast]
        [AB- After Breakfast]
        [BL-Before Lunch]
        [AL- After Lunch]
        [BN- Before Dinner]
        [N- At Night]
        </th>
        </tr>
        <tr style="text-align:center;">
        <td colspan="1">Medicine Name</td>
        <td colspan="1">Morning</td>
        <td colspan="1">Afternoon</td>
        <td colspan="1">Evening</td>
        <td colspan="1">Night</td>
        <td colspan="1">Remarks</td>
        </tr>
        ';

        foreach($pres as $item){
            $html.='
            <tr>
                <td>'.$item->medicinename.'</td>
                <td>'.$item->morning.'</td>
                <td>'.$item->afternoon.'</td>
                <td>'.$item->evening.'</td>
                <td>'.$item->night.'</td>';

                if($item->remarks==""){
                    $html.='<td>-</td>';
                }
                else
                {
                    $html.='<td>'.$item->remarks.'</td>';

                }

           $html.= '</tr>';
        }

        $html.='</table>';

            PDF::SetTitle($user[0]->pname . '_' . 'Prescription' . '_' . $user[0]->apno);
            PDF::AddPage();
            PDF::writeHTML($html, true, false, true, false, '');
            PDF::Output($user[0]->pname . '_'. 'Prescription_' . $user[0]->apno . '.pdf');
        }
        else
        {
            return redirect('dashboard');
        }
    }



    function appoinmentreport(Request $req){
        date_default_timezone_set("Asia/Calcutta");
        if($req->input('fdate')!="" && $req->input('tdate')!="")
        {
            $fdate=$req->input('fdate');
            $tdate=$req->input('tdate');

            $cnt = DB::table('appoinments')->join('patients', 'appoinments.patients_pid', '=', 'patients.pid')->join('payments', 'appoinments.apno', '=', 'payments.app_apno')->join('doctors', 'appoinments.doctors_did', '=', 'doctors.did')->whereBetween('appoinments.apdate',[$fdate,$tdate])->get()->count();

            if($cnt>=1){

                $app = DB::table('appoinments')->join('patients', 'appoinments.patients_pid', '=', 'patients.pid')->join('payments', 'appoinments.apno', '=', 'payments.app_apno')->join('doctors', 'appoinments.doctors_did', '=', 'doctors.did')->whereBetween('appoinments.apdate',[$fdate,$tdate])->get();

            $html = '
        <table border="1" cellpadding="5" cellspacing="3" style="">
        <tr>
        <td colspan="6" style="text-align:center;"><h2>Appoinments Report</h2></td>
        </tr>
        <tr><td rowspan="4" colspan="3"><img src="frontend/images/logo_1.jfif" alt="ShreeHari" height="80px" width="180px"/><br/><h6>FF 116, Avalon, Opp. Samast Patidar Samaj Wadi, Nr. Ankur School, Amba Talavadi,Katargam, Surat.</h6></td>
            <td colspan="3" style="text-align:center;"><b>Report Details By Date</b></td>
        </tr>
        <tr><td colspan="1">From :</td><td colspan="2">'.date('d-m-Y', strtotime($fdate)).'</td></tr>
        <tr><td colspan="1">To :</td><td colspan="2">'.date('d-m-Y', strtotime($tdate)).'</td></tr>
        <tr><td colspan="1">Report Print Date :</td><td colspan="2">'.date('d-m-Y h:m:s a').'</td></tr>


        <tr><th colspan="6" style="text-align:center;font-size:15px;"><b>Appoinment Details</b></th></tr>
        <tr style="font-weight:bold;">
            <th>APNO</th>
            <th>APDATE</th>
            <th>PATIENTS</th>
            <th>APSTATUS</th>
            <th>DOCTORS</th>
            <th>PAYMODE</th>
        </tr>
        ';

        for($i=0;$i<count($app);$i++){
            $html.='<tr>
                <td>'.$app[$i]->apno.'</td>
                <td>'.date('d-m-Y', strtotime($app[$i]->apdate)).'</td>
                <td>'.$app[$i]->pname.'</td>';

                if($app[$i]->apstatus=='')
                {
                    $html.='<td style="color:blue;">Pending</td>';
                }
                else if($app[$i]->apstatus=='0'){
                    $html.='<td style="color:red;">Cancelled</td>';

                }
                else
                {
                    $html.='<td style="color:green;">Confirmed</td>';
                }

                $html.='<td>'.$app[$i]->dname.'</td>
                <td>'.$app[$i]->paymode.'</td>
            </tr>';
        }

        $html.='</table>';

            PDF::SetTitle('ShreeHari Report');
            PDF::AddPage();
            PDF::writeHTML($html, true, false, true, false, '');
            PDF::Output('ShreeHari Report' . '.pdf');

        }
        else
        {
            $req->session()->put('rfalse', "!!...Not Found...!!");
            return redirect('doctor/Allreports');
        }
    }
        else
        {
            $req->session()->put('rfalse', "Please fill all required details..!!");
            return redirect('doctor/Allreports');
        }
    }

    function appdocreport(Request $req){
        date_default_timezone_set("Asia/Calcutta");
        if($req->input('did')!="")
        {
            $cnt = DB::table('appoinments')->join('patients', 'appoinments.patients_pid', '=', 'patients.pid')->join('payments', 'appoinments.apno', '=', 'payments.app_apno')->join('doctors', 'appoinments.doctors_did', '=', 'doctors.did')->where('appoinments.doctors_did','=',$req->input('did'))->get()->count();

            if($cnt>=1){

                $app = DB::table('appoinments')->join('patients', 'appoinments.patients_pid', '=', 'patients.pid')->join('payments', 'appoinments.apno', '=', 'payments.app_apno')->join('doctors', 'appoinments.doctors_did', '=', 'doctors.did')->where('appoinments.doctors_did','=',$req->input('did'))->get();

            $html = '
        <table border="1" cellpadding="5" cellspacing="3" style="">
        <tr>
        <td colspan="6" style="text-align:center;"><h2>Appoinments Report</h2></td>
        </tr>
        <tr><td rowspan="4" colspan="3"><img src="frontend/images/logo_1.jfif" alt="ShreeHari" height="80px" width="180px"/><br/><h6>FF 116, Avalon, Opp. Samast Patidar Samaj Wadi, Nr. Ankur School, Amba Talavadi,Katargam, Surat.</h6></td>
            <td colspan="3" style="text-align:center;"><b>Report Details By Doctor</b></td>
        </tr>
        <tr><td colspan="1">Dr.Id:</td><td colspan="2">'.$app[0]->did.'</td></tr>
        <tr><td colspan="1">Dr.Name :</td><td colspan="2">'.$app[0]->dname.'</td></tr>
        <tr><td colspan="1">Report Print Date :</td><td colspan="2">'.date('d-m-Y h:m:s a').'</td></tr>


        <tr><th colspan="6" style="text-align:center;font-size:15px;"><b>Appoinment Details</b></th></tr>
        <tr style="font-weight:bold;">
            <th>APNO</th>
            <th>APDATE</th>
            <th>PATIENTS</th>
            <th>APSTATUS</th>
            <th>DOCTORS</th>
            <th>PAYMODE</th>
        </tr>
        ';

        for($i=0;$i<count($app);$i++){
            $html.='<tr>
                <td>'.$app[$i]->apno.'</td>
                <td>'.date('d-m-Y', strtotime($app[$i]->apdate)).'</td>
                <td>'.$app[$i]->pname.'</td>';

                if($app[$i]->apstatus=='')
                {
                    $html.='<td style="color:blue;">Pending</td>';
                }
                else if($app[$i]->apstatus=='0'){
                    $html.='<td style="color:red;">Cancelled</td>';

                }
                else
                {
                    $html.='<td style="color:green;">Confirmed</td>';
                }

                $html.='<td>'.$app[$i]->dname.'</td>
                <td>'.$app[$i]->paymode.'</td>
            </tr>';
        }

        $html.='</table>';

            PDF::SetTitle('ShreeHari Report');
            PDF::AddPage();
            PDF::writeHTML($html, true, false, true, false, '');
            PDF::Output('ShreeHari Report' . '.pdf');

        }
        else
        {
            $req->session()->put('rfalse', "!!...Not Found...!!");
            return redirect('doctor/Allreports');
        }
    }
        else
        {
            $req->session()->put('rfalse', "Please fill all required details..!!");
            return redirect('doctor/Allreports');
        }
    }

    function apppayment(Request $req){

        date_default_timezone_set("Asia/Calcutta");
        if($req->input('pfdt')!="" && $req->input('ptdt')!="")
        {
            $fdate=$req->input('pfdt');
            $tdate=$req->input('ptdt');

            $cnt = DB::table('appoinments')->join('patients', 'appoinments.patients_pid', '=', 'patients.pid')->join('payments', 'appoinments.apno', '=', 'payments.app_apno')->join('doctors', 'appoinments.doctors_did', '=', 'doctors.did')->whereBetween('payments.created_at',[$fdate,$tdate])->get()->count();

            if($cnt>=1){

                $app = DB::table('appoinments')->join('patients', 'appoinments.patients_pid', '=', 'patients.pid')->join('payments', 'appoinments.apno', '=', 'payments.app_apno')->join('doctors', 'appoinments.doctors_did', '=', 'doctors.did')->whereBetween('payments.created_at',[$fdate,$tdate])->get();

            $html = '
        <table border="1" cellpadding="5" cellspacing="3" style="">
        <tr>
        <td colspan="6" style="text-align:center;"><h2>Payments Report</h2></td>
        </tr>
        <tr><td rowspan="4" colspan="3"><img src="frontend/images/logo_1.jfif" alt="ShreeHari" height="80px" width="180px"/><br/><h6>FF 116, Avalon, Opp. Samast Patidar Samaj Wadi, Nr. Ankur School, Amba Talavadi,Katargam, Surat.</h6></td>
            <td colspan="3" style="text-align:center;"><b>Payment Report Details</b></td>
        </tr>
        <tr><td colspan="1">From :</td><td colspan="2">'.date('d-m-Y', strtotime($fdate)).'</td></tr>
        <tr><td colspan="1">To :</td><td colspan="2">'.date('d-m-Y', strtotime($tdate)).'</td></tr>
        <tr><td colspan="1">Report Print Date :</td><td colspan="2">'.date('d-m-Y h:m:s a').'</td></tr>


        <tr><th colspan="6" style="text-align:center;font-size:15px;"><b>Payment Details</b></th></tr>
        <tr style="font-weight:bold;">
            <th>APNO</th>
            <th colspan="2">PAYID</th>
            <th>PATIENTS</th>
            <th>PAYDATE</th>
            <th>PAYMODE</th>
        </tr>
        ';

        for($i=0;$i<count($app);$i++){
            $html.='<tr>
                <td>'.$app[$i]->apno.'</td>';
                if($app[$i]->paymentid==''){
                    $html.='<td colspan="2" style="color:blue;">Cash On counter</td>';
                }
                else
                {
                    $html.='<td colspan="2">'.$app[$i]->paymentid.'</td>';
                }
              $html.='<td>'.$app[$i]->pname.'</td>
                <td>'.date('d-m-Y', strtotime($app[$i]->created_at)).'</td>
                <td>'.$app[$i]->paymode.'</td>
            </tr>';
        }

        $html.='</table>';

            PDF::SetTitle('ShreeHari Report');
            PDF::AddPage();
            PDF::writeHTML($html, true, false, true, false, '');
            PDF::Output('ShreeHari Report' . '.pdf');

        }
        else
        {
            $req->session()->put('rfalse', "!!...Not Found...!!");
            return redirect('doctor/Allreports');
        }
    }
        else
        {
            $req->session()->put('rfalse', "Please fill all required details..!!");
            return redirect('doctor/Allreports');
        }
    }
}
