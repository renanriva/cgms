<?php

namespace App\Listeners;

use App\Events\RegistrationApproved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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

        $approved->registration->registry_is_generated = true;
        $approved->registration->save();

//        $update = Registration::find($approved->registration->id);
//        $update->registry_is_generated = true;
//        $update->save();
    }
}
