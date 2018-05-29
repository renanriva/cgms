<?php

namespace App\Listeners;

use App\Events\RegistrationApproved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;

/**
 * Class GenerateInspectionCertificate
 *
 * @package App\Listeners
 */
class GenerateInspectionCertificate
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param RegistrationApproved $approved
     * @return void
     * @internal param object $event
     */
    public function handle(RegistrationApproved $approved)
    {
        //@todo generate file and update the registration


        $certificateFilename =$approved->registration->course->course_code . '_certificate_of_'.$approved->registration->student->social_id.'.pdf';

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('lms.admin.registration.pdf.certificate', ['registration' => $approved->registration]);
        $pdf->save(storage_path('app/public/course/certificate/' . $certificateFilename));

        $approved->registration->registry_is_generated = true;
        $approved->registration->save();

    }
}
