<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class PortfolioController
 *
 * @package App\Http\Controllers
 */
class PortfolioController extends Controller
{


    /**
     * @todo add guard policy
     */
    public function teachers(){


        $user = Auth::user();
//        if ($user->can('browse', Teacher::class)) {



            if ($user->role == 'admin'){

                $title = 'Teacher Portfolio - '.env('APP_NAME') ;
                $registrations = Registration::orderBy('id', 'desc')
                                        ->paginate(10);
            } elseif ($user->role == 'teacher'){

                $title = 'My Portfolio - '.env('APP_NAME') ;

                $registrations = Registration::where('teacher_id', $user->teacher->id)
                    ->orderBy('id', 'desc')
                    ->paginate(10);
            }

            return view('lms.admin.portfolio.all', ['title'=> $title,
                            'registrations' => $registrations]);

//        } else{
//            echo  'unauthorized';
//        }


    }


}
