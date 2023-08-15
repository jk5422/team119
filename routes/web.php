<?php

use App\Http\Controllers\backend\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\homecontroller;
use App\Http\Controllers\frontend\PatientController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\AppoinmentsController;
use App\Http\Controllers\frontend\GetclinicController;
use Illuminate\Contracts\Session\Session;
use App\Http\Controllers\frontend\RazorpayPaymentController;
use App\Http\Controllers\frontend\ChangePass;
use App\Http\Controllers\frontend\PdfController;

use App\Http\Controllers\backend\DoctorController;
use App\Http\Controllers\backend\MedicineController;
use App\Http\Controllers\backend\ServiceController;
use App\Http\Controllers\backend\PaymentController;
use App\Http\Controllers\backend\PrescreptionController;
use App\Http\Controllers\backend\ForgotpassController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*****************PATIENT SIDE ALL ROUTES**************************/



Route::get('/', [homecontroller::class, 'index']);

/******* PATIENT LOGIN REGISTER VIEW OPEN ROUTES ********/
Route::get('login', function () {
    if(session('pname')){
        return view('frontend.dashboard',['title' => 'Dashboard | ShreeHari']);
    }
    else
    {
        return view('frontend.login', ['title' => 'login | ShreeHari']);
    }
});

Route::get('register', function () {
    if(session('pname')){
        return view('frontend.dashboard',['title' => 'Dashboard | ShreeHari']);

    }
    else
    {

        return view('frontend.register', ['title' => 'register | ShreeHari']);
    }
});
Route::get('contact', function () {
    return view('frontend.contact', ['title' => 'Contact | ShreeHari']);
});
Route::get('about', function () {
    return view('frontend.about', ['title' => 'About | ShreeHari']);
});
Route::get('/forgot',[ForgotpassController::class,'forgetpage']);
Route::get('appoinments-take', function(){
    return redirect('/login');
});

/********* PATIENTS POST REQUEST ROUTES OF LOGIN AND REGISTER ***********/
Route::post('register', [PatientController::class, 'register']);
Route::post('contact', [ContactController::class, 'contact']);
Route::post('login', [PatientController::class, 'login']);
Route::post('forgot/sendemail',[ForgotpassController::class,'sendemail']);
Route::post('forgot/getotp',[ForgotpassController::class,'getotp']);
Route::post('forgot/resendemail',[ForgotpassController::class,'resendemail']);
Route::post('forgot/setnewcred',[ForgotpassController::class,'setnewcredentials']);


/********** PATIENT MIDDLEWARE AUTHENTICATION ************/
Route::group(['middleware' => ['patientauth']], function () {

    Route::get('/logout', function () {
        Session()->pull('pname');
        Session()->pull('pid');
        return redirect('/login');
    });
    Route::get('dashboard', function () {
        return view('frontend.dashboard', ['title' => 'Dashboard | ShreeHari']);
    });
    Route::get('profile-view/{id}', [PatientController::class, 'profileview'])->name('profile');
    Route::get('appoinments-take/{id}', [AppoinmentsController::class, 'showpatient'])->name('appview');
    Route::get('appoinments-view/{id}', [AppoinmentsController::class, 'viewappoinments'])->name('appoinments');
    Route::get('change-pass/{id}', [ChangePass::class, 'change'])->name('changepass');
    Route::get('pdf/{id}', [PdfController::class, 'index']);
    Route::get('prescription/{id}', [PdfController::class, 'prescriptionview']);

/**************** PATIENTS SIDE POST REQUEST ROUTES ****************/
    Route::post('/clinics', [GetclinicController::class, 'clinics']);
    Route::post('password-update', [ChangePass::class, 'updatepass']);
    Route::post('/services', [GetclinicController::class, 'services']);
    Route::post('/appoinment-done', [AppoinmentsController::class, 'makeappoinment']);
    Route::post('profile-update', [PatientController::class, 'profileupdate']);
    Route::post('/updateappoinment', [AppoinmentsController::class, 'updateappoinment']);
    Route::post('cancelappoinment', [AppoinmentsController::class, 'patientappcancel']);
    Route::post('/checkdate', [AppoinmentsController::class, 'checkfordate']);
    Route::post('/checkslot', [AppoinmentsController::class, 'checkforslot']);
    Route::post('/checkforpasttime', [AppoinmentsController::class, 'checkforpasttime']);

    /* RAZORPAY ROUTES*/
    Route::post('/payonline', [RazorpayPaymentController::class, 'index']);
});




/*********************DOCTOR SIDE ALL ROUTES***************************/

Route::get('/doctor/forgot', [ForgotpassController::class, 'drforgotindex']);
Route::post('doctor/fpass', [ForgotpassController::class, 'drsendemail']);
Route::post('/doctor/fpass/drgetotp', [ForgotpassController::class, 'drgetotp']);
Route::post('/doctor/fpass/drresendemail', [ForgotpassController::class, 'drresendemail']);
Route::post('doctor/fpass/drsetnewcred', [ForgotpassController::class, 'drsetnewcredentials']);


Route::get('doctor', function () {
    if(session('dname')){
        return view('backend.dashboard', ['title' => 'Dashboard Doctor | ShreeHari']);
    }
    else
    {
        return view('backend.signin', ['title' => 'Doctor SignIn | ShreeHari']);
    }
});
Route::get('doctor/dlog', function () {
    if(session('dname')){
        return view('backend.dashboard', ['title' => 'Dashboard Doctor | ShreeHari']);
    }
    else
    {
        return view('backend.signin', ['title' => 'Doctor SignIn | ShreeHari']);
    }
});

Route::post('doctor/dlog', [DoctorController::class, 'logindoctor']);



/* DOCTOR MIDDLEWARE AUTHENTICATION */
Route::group(['middleware' => ['doctorauth']], function () {

    /* LOGOUT DOCTOR ROUTES */
    Route::get('doctor/dlogout', function () {
        Session()->pull('dname');
        Session()->pull('did');
        return redirect('doctor');
    });

    /* PAGES ROUTES */
    Route::get('doctor/dashboard', function () {
        return view('backend.dashboard', ['title' => 'Dashboard Doctor | ShreeHari']);
    });
    Route::get('doctor/alldoctor', [DoctorController::class,'alldoctor']);
    Route::get('doctor/allclinics', [GetclinicController::class,'allclinics']);
    Route::get('doctor/allmedicines', [MedicineController::class,'allmedicines']);
    Route::view('doctor/Allreports','backend.reports',['title'=>'All Report']);
    Route::get('doctor/allservices', [ServiceController::class,'allservices']);
    Route::get('doctor/allpatients', [PatientController::class,'allpatients']);
    Route::get('doctor/allpayments', [PaymentController::class,'allpayments']);
    Route::get('doctor/contactus', [ContactController::class,'allcontactus']);
    Route::get('doctor/allappoinments', [AppoinmentsController::class,'allappoinments']);
    Route::get('doctor/pendappoinments', [AppoinmentsController::class,'pendingappoinments']);
    Route::get('doctor/allappoinments/pdf/{id}', [PdfController::class, 'index']);
    Route::get('doctor/dashboard/pdf/{id}', [PdfController::class, 'index']);
    Route::get('doctor/prescription/pdf/{id}', [PdfController::class, 'prescriptionview']);
    Route::get('doctor/pendappoinments/prescription/pdf/{id}', [PdfController::class, 'prescriptionview']);
    Route::get('doctor/pendappoinments/getpresc/{id}',[PrescreptionController::class,'getprescription']);




    /* AJAX Request */
    Route::get('/getcounts', [DashboardController::class, 'getallcount']);
    Route::get('/getrecentapp', [DashboardController::class, 'getrecentapp']);
    Route::get('/getpayments', [DashboardController::class, 'getpayments']);
    Route::get('/getclinic', [DoctorController::class, 'allclinic']);
    Route::get('/getdoctor', [DoctorController::class, 'alldoc']);
    Route::get('/getmedicine', [MedicineController::class, 'getmedicinelist']);
    Route::get('/getservices', [ServiceController::class, 'getservices']);
    Route::get('/getcnid', [ContactController::class, 'getcnidall']);
    Route::post('/getdocdetails', [DoctorController::class, 'docdetails']);
    Route::post('/getclinicdetails', [GetclinicController::class, 'clinicdetails']);
    Route::post('/getmedicinedetails', [MedicineController::class, 'medicinedetails']);
    Route::post('/getassoclinic', [DoctorController::class, 'getassclinic']);
    Route::post('/getservicelistdetail', [ServiceController::class, 'getservicelistdetail']);
    Route::post('/getmsg', [ContactController::class, 'getmsg']);
    Route::post('/getpresdata', [PrescreptionController::class, 'getpresdetails']);
    Route::post('/checkpresupdate', [PrescreptionController::class, 'checkforupdate']);
    Route::post('doctor/Allreports/appreport', [PdfController::class, 'appoinmentreport']);
    Route::post('doctor/Allreports/appdoc', [PdfController::class, 'appdocreport']);
    Route::post('/doctor/Allreports/payment', [PdfController::class, 'apppayment']);



    /* ADD UPDATE DELETE REQUEST ROUTES FOR DOCTORS */
    Route::post('adddoctor/dadd', [DoctorController::class, 'adddoctor']);
    Route::post('alldoctor/udoc', [DoctorController::class, 'updatedoctor']);
    Route::post('alldoctor/deldoc', [DoctorController::class, 'deletedoctor']);
    Route::post('alldoctor/changepass', [DoctorController::class, 'changedocpass']);
    Route::post('allclinic/cadd', [GetclinicController::class, 'addclinic']);
    Route::post('allclinics/cupdate', [GetclinicController::class, 'updateclinic']);
    Route::post('allclinics/delclinic', [GetclinicController::class, 'deleteclinic']);
    Route::post('allmedicines/madd', [MedicineController::class, 'addmedicine']);
    Route::post('allmedicines/mupdate', [MedicineController::class, 'medicineupdate']);
    Route::post('allmedicines/mdel', [MedicineController::class, 'delmedicine']);
    Route::post('allservices/sadd', [ServiceController::class, 'addservice']);
    Route::post('allservices/supdate', [ServiceController::class, 'serviceupdate']);
    Route::post('allservices/sdel', [ServiceController::class, 'delservice']);
    Route::post('contactus/ciddel', [ContactController::class, 'delcid']);
    Route::post('pendappoinments/uapstatus', [AppoinmentsController::class, 'updateappstatus']);
    Route::post('pendappoinments/uapdata', [AppoinmentsController::class, 'upadminappoinment']);
    Route::post('pendappoinments/addprescription', [PrescreptionController::class, 'addprescription']);
    Route::post('pendappoinments/updateprescription', [PrescreptionController::class, 'updateprescription']);



});


