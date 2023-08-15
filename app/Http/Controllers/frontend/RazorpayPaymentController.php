<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\patient;
use Session;
use Exception;

class RazorpayPaymentController extends Controller
{
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $req)
    {
        if($req->post('pid')==session('pid')){

            $user=patient::find($req->post('pid'));
            return ['data'=>$user,'title'=>'ShreeHari'];
        }
    }

    public function getwithid($id){
        $user=patient::find($id);
        // return $user;
        return view('frontend.razorpayView',['data'=>$user,'title'=>'ShreeHari']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));

            } catch (Exception $e) {
                return  $e->getMessage();
                $request->session()->put('error',$e->getMessage());
                return redirect()->back();
            }
        }

        $request->session()->put('success', 'Payment successful Do not Press Back Button You Will be Redirected');
        // return redirect()->back();
        return redirect(Route('appview',session('pid')));
    }
}
