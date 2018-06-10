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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPending(Request $request){

        $title = 'Pending Registration Management - '.env('APP_NAME') ;

        $posts = $request->all();
        $minutes = 15;
        $page = isset( $posts['page'] ) ? $posts['page'] : 1 ;

        $registrations = Cache::remember('pending_registrations_by_page_'.$page, $minutes, function () {

                 return Registration::orderBy('id', 'desc')
                    ->orderBy('is_approved', 'desc')
                    ->paginate(10);

        });

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

            $registration->reg_date = date('Y-m-d', strtotime('now'));
            $registration->tc_accept_time = $current_time;
            $registration->status = REGISTRATION_STATUS_ACCEPT;
            $registration->save();

        } elseif( $part == 'approve'){

            $registration->is_approved= REGISTRATION_IS_APPROVED;
            $registration->approval_time= $current_time;
            $registration->approved_by= Auth::user()->id;
            $registration->status = REGISTRATION_STATUS_COMPLETE;

            $registration->save();
//            @todo invalidate registration_by_id cache

//            @TODO generate inspection certificate and update status
            event(new RegistrationApproved($registration));

        }

        return response()->json(['registration' => $registration,
            'adminUser' => Auth::user()->name]);
    }


    /**
     * @param Request $request
     * @param         $registrationId
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadStudentInspection(Request $request, $registrationId){

        $cloud = Storage::disk();

        $filename = "course_".$registrationId.'_teacher_'.$request->input('teacher_id').'_inspection_signed_certificate.'.$request->file('qqfile')->extension();
        $path = $cloud->putFileAs('course/signed_certificates', $request->file('qqfile'), $filename);

        $path = storage_path('app/'.$path);


        $registration = Registration::find($registrationId);

        $current_time = Carbon::now()->toDateTimeString();
        $registration->inspection_certificate = $path;
        $registration->inspection_certificate_signed = REGISTRATION_INSPECTION_CERTIFICATE_SIGNED;
        $registration->inspection_certificate_upload_time = $current_time;
        $registration->status = REGISTRATION_STATUS_SIGNED;
        $registration->save();


        /**
         * Update the course request status
         */
        DB::table('course_requests')
            ->where('course_id', $registration->course_id)
            ->where('teacher_id', $registration->teacher_id)
            ->update(['status' => COURSE_REQUEST_ACCEPTED]);

        return response()->json(['path'=> $path, 'success' => true]);

    }


    /**
     * @todo add registration policy
     *
     * @param $registrationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function downloadStudentInspectionCertificate($registrationId){

        $minutes = 15;

        $registration = Cache::remember('registration_by_id_'.$registrationId, $minutes,
            function () use($registrationId){

                return Registration::find($registrationId);

            });


        if ($registration){

            return response()->file($registration->inspection_certificate);

        } else {
            return response()->redirectTo('admin/unauthorized');

        }

    }

    /**
     * @todo add registration policy
     *
     * @param $registrationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function downloadStudentCertificate($registrationId){

        $minutes = 15;

        $registration = Cache::remember('registration_by_id_'.$registrationId, $minutes,
            function () use($registrationId){

            return Registration::find($registrationId);

        });

        if ($registration){

            return response()->file($registration->certificate_path);

        } else {
            return response()->redirectTo('admin/unauthorized');

        }

    }

    public function downloadStudentDiploma($registrationId){

        $minutes = 15;

        $registration = Cache::remember('registration_by_id_'.$registrationId, $minutes,
            function () use($registrationId){

                return Registration::find($registrationId);

            });

        if ($registration){

            return response()->file($registration->diploma_path);

        } else {
            return response()->redirectTo('admin/unauthorized');

        }

    }

}
