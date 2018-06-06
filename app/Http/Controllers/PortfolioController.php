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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function teachers(Request $request){


        $user = Auth::user();
//        if ($user->can('browse', Teacher::class)) {

            if ($user->role == 'admin'){


                $search_in = $request->input('search_param');
                $search_keyword = $request->input('x');
                $registration = $request->input('registration') == null ? 3 : $request->input('registration');


                $title = 'Teacher Portfolio - '.env('APP_NAME') ;

                $registrations = Registration::where(function ($query) use($search_in, $search_keyword, $registration){



                    if($registration !== 3){
                        if ($registration == 1 || $registration == 0){
                            $query->where('is_approved', $registration);
                        }
                    }

                    if ($search_in == 'teachers_name'){
                        // teacher name search

                        $query->whereHas('student', function ($cQuery) use ($search_keyword){
                            $cQuery->where('first_name', 'LIKE', '%' . $search_keyword . '%')
                            ->orWhere('last_name', 'LIKE', '%'.$search_keyword.'%');
                        });

                    } elseif ($search_in == 'course_name'){

                        $query->whereHas('course', function ($cQuery) use ($search_keyword){
                            $cQuery->where('short_name', 'LIKE', '%' . $search_keyword . '%');
                        });

                    } elseif ($search_in == 'course_code'){

                        $query->whereHas('course', function ($cQuery) use ($search_keyword){
                            $cQuery->where('course_code',  $search_keyword );
                        });

                    }

                })->orderBy('id', 'desc')
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
