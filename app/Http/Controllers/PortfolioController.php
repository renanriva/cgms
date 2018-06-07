<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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

        if ($user->role == 'admin'){


            $search_in = $request->input('search_param');
            $search_keyword = $request->input('x');
            $registration = $request->input('registration') == null ? 3 : $request->input('registration');


            $title = 'Teacher Portfolio - '.env('APP_NAME') ;

            $minutes = 15;
            $page = $request->input('page') == null ? 1: $request->input('page');
            $cache_key = 'portfolio_search_in_'.$search_in. '_with_'.$search_keyword .
                '_with_registration_'.$registration .
                '_in_page_'.$page;
            $registrations = Cache::remember($cache_key, $minutes, function () use($search_in, $search_keyword, $registration){


                return Registration::where(function ($query) use($search_in, $search_keyword, $registration){

                    // if not all == 3 , then search registration with id
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

                    } elseif ($search_in == 'social_id'){
                        // teacher social_id search
                        $query->whereHas('student', function ($cQuery) use ($search_keyword){
                            $cQuery->where('social_id', $search_keyword );
                        });

                    } elseif ($search_in == 'course_name'){

                        $query->whereHas('course', function ($cQuery) use ($search_keyword){
                            $cQuery->where('short_name', 'LIKE', '%' . $search_keyword . '%');
                        });

                    } elseif ($search_in == 'course_code'){

                        $query->whereHas('course', function ($cQuery) use ($search_keyword){
                            $cQuery->where('course_code',  $search_keyword );
                        });

                    }elseif ($search_in == 'all'){
                        
                        $query->whereHas('student', function ($cQuery) use ($search_keyword){
                            $cQuery->where('first_name', 'LIKE', '%' . $search_keyword . '%')
                                ->orWhere('last_name', 'LIKE', '%'.$search_keyword.'%')
                                ->orWhere('social_id', $search_keyword);
                        });

                        $query->orWhereHas('course', function ($cQuery) use ($search_keyword){

                            $cQuery->where('short_name', 'LIKE', '%' . $search_keyword . '%')
                                    ->orWhere('course_code',  $search_keyword );
                        });

                    }

                })->orderBy('id', 'desc')
                    ->paginate(10);

            });

        } elseif ($user->role == 'teacher'){

                $title = 'My Portfolio - '.env('APP_NAME') ;

                $registrations = Registration::where('teacher_id', $user->teacher->id)
                    ->orderBy('id', 'desc')
                    ->paginate(10);
        }

        return view('lms.admin.portfolio.all', ['title'=> $title,
                        'registrations' => $registrations]);

    }

    /**
     * @param Request $request
     */
    public function download(Request $request){



        $search_in = $request->input('search_param');
        $search_keyword = $request->input('x');
        $registration = $request->input('registration') == null ? 3 : $request->input('registration');
        $minutes = 15;
        $page = $request->input('page') == null ? 1: $request->input('page');
        $cache_key = 'portfolio_search_in_'.$search_in. '_with_'.$search_keyword .
            '_with_registration_'.$registration .
            '_in_page_'.$page;


//        $storage = Cache::getStore(); // will return instance of FileStore
//        $filesystem = $storage->getFilesystem(); // will return instance of Filesystem
//
//        $dir = (\Cache::getDirectory());
//        $keys = [];
//        foreach ($filesystem->allFiles($dir) as $file1) {
//
//            if (is_dir($file1->getPath())) {
//
//                foreach ($filesystem->allFiles($file1->getPath()) as $file2) {
//                    $keys = array_merge($keys, [$file2->getRealpath() => unserialize(substr(\File::get($file2->getRealpath()), 10))]);
//                }
//            }
//            else {
//
//            }
//        }

        echo '<pre>';
//        var_dump($cache_key);
//
//        var_dump(Cache::get($cache_key));

//        var_dump($keys);

        echo '</pre>';

        var_dump($request->all());

    }


}
