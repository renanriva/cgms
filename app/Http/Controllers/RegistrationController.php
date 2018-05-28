<?php

namespace App\Http\Controllers;

use App\Events\RegistrationApproved;
use App\Registration;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Province;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Canton;

/**
 * Class UniversityController
 *
 * @package App\Http\Controllers
 */
class RegistrationController extends Controller
{
    public function index(){

        $title = 'Registration Management - '.env('APP_NAME') ;

        return view('lms.admin.university.index',
                ['title'=> $title]);

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPending(){

        $title = 'Pending Registration Management - '.env('APP_NAME') ;
        $registrations = Registration::all();

        return view('lms.admin.registration.pending',
            ['title'=> $title, 'registrations' => $registrations]);

    }

    /**
     * @param Request $request
     * @param         $registrationId
     * @param         $part
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRegistration(Request $request, $registrationId, $part)
    {

        $post = $request->all();

        $registration = Registration::find($registrationId);
        $current_time = Carbon::now()->toDateTimeString();

        if ($part == 'accept'){

            $registration->accept_tc = $post['accept_tc'] == true ? REGISTRATION_ACCEPT_TERMS_AND_CONDITION : REGISTRATION_ACCEPT_TERMS_AND_CONDITION_FALSE;

            $registration->tc_accept_time = $current_time;
            $registration->status = REGISTRATION_STATUS_ACCEPT;
            $registration->save();

        } elseif( $part == 'approve'){

            $registration->is_approved= REGISTRATION_IS_APPROVED;
            $registration->approval_time= $current_time;
            $registration->approved_by= Auth::user()->id;
            $registration->status = REGISTRATION_STATUS_COMPLETE;

            $registration->save();

//            @TODO generate inspection certificate and update status
            event(new RegistrationApproved($registration));

        }

        return response()->json(['registration' => $registration,
            'adminUser' => Auth::user()->name]);
    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {

    }


    /**
     * @todo add validation rule
     * @param Request $request
     * @return $this
     */
    public function store(Request $request){

        $canton = new Canton();
        $post = $request->all();

        $canton->province_id    = $post['province_id'];
        $canton->name           = $post['name'];
        $canton->capital        = $post['capital'];
        $canton->dist_name        = $post['dist_name'];
        $canton->dist_code        = $post['dist_code'];
        $canton->zone        = $post['zone'];
        $canton->save();

        return response()->json(['canton' => $canton])->setStatusCode(201);
    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){

        $canton = Canton::find($id);

        if ($canton){

            // todo add canton update validation
            $post = $request->all();

            $canton->province_id    = $post['province_id'];
            $canton->name           = $post['name'];
            $canton->capital        = $post['capital'];
            $canton->dist_name        = $post['dist_name'];
            $canton->dist_code        = $post['dist_code'];
            $canton->zone        = $post['zone'];
            $canton->save();

            return response()->json(['canton' => $canton])->setStatusCode(200);
        } else{

            return response()->json(['error' => 'Not found'])->setStatusCode(404);
        }


    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCertificate(){
//
//        $pdf = App::make('dompdf.wrapper');
//        $pdf->loadView('lms.admin.registration.pdf.certificate');
//        return $pdf->stream();


        $certificateFilename = 'laravel-5.1_certificate_of_bh0161256.pdf';
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('lms.admin.registration.pdf.certificate');
        $pdf->save(storage_path('app/public/course/certificate/' . $certificateFilename));

        echo 'done';
//        return $pdf->download('invoice.pdf');


//        return view('lms.admin.registration.pdf.certificate',
//            ['title'=> 'Test']);

    }


}
