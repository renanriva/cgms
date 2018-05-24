<?php

namespace App\Providers;

use App\Canton;
use App\Course;
use App\Parroquia;
use App\Policies\CantonPolicy;
use App\Policies\CoursePolicy;
use App\Policies\ParroquiaPolicy;
use App\Policies\ProvincePolicy;
use App\Policies\TeacherPolicy;
use App\Policies\UniversityPolicy;
use App\Province;
use App\Teacher;
use App\University;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Teacher::class => TeacherPolicy::class,
        Course::class => CoursePolicy::class,
        Province::class => ProvincePolicy::class,
        Canton::class => CantonPolicy::class,
        Parroquia::class => ParroquiaPolicy::class,
        University::class => UniversityPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
