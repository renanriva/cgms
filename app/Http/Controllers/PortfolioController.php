<?php

namespace App\Http\Controllers;

use App\Registration;
use App\Repository\TeacherRepository;
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

        $page           = $request->input('page') == null ? 1: $request->input('page');

        if ($user->role == 'admin'){


            $title = 'Teacher Portfolio - '.env('APP_NAME') ;


            $search_in      = $request->input('search_param');
            $search_keyword = $request->input('x');
            $registration   = $request->input('registration') == null ? 3 : $request->input('registration');


            $teacher_repo = new TeacherRepository();


            $registrations = $teacher_repo->filter($search_in, $search_keyword, $registration, $page);

        } elseif ($user->role == 'teacher'){

            $title = 'My Portfolio - '.env('APP_NAME') ;

            $minutes = 20;
            $cache_key = 'portfolio_of_teacher_'.$user->teacher->id.'_of_page_'.$page;

            $registrations = Cache::remember($cache_key, $minutes, function () use($user){

                return Registration::with(['student', 'course', 'markApprovedBy', 'approvedBy'])
                    ->where('teacher_id', $user->teacher->id)
                    ->orderBy('id', 'desc')
                    ->paginate(10);
            });

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
