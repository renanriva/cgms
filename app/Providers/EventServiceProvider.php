<?php

namespace App\Providers;

use App\Events\RegistrationApproved;
use App\Events\UniversityCreated;
use App\Listeners\CreateUniversityUser;
use App\Listeners\GenerateInspectionCertificate;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        RegistrationApproved::class => [
            GenerateInspectionCertificate::class,
        ],

        UniversityCreated::class => [
            CreateUniversityUser::class
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
