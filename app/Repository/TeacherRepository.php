<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 27/05/2018
     * Time: 2:23 PM
     */

namespace App\Repository;


use App\Events\TeacherCreated;
use App\Registration;
use App\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Class TeacherRepository
 *
 * @package App\Repository
 */
class TeacherRepository
{

    public $registrationRepo ;
    public function __construct()
    {
        $this->registrationRepo = new RegistrationRepository();

    }


    /**
     * @param array $teacher
     * @param int      $creation_type
     * @return Teacher
     */
    public function insert($teacher, $creation_type){

        /**
         * Store a teacher and return the teacher
         */

        $newTeacher = new Teacher();
        $newTeacher->first_name = $teacher['first_name'];
        $newTeacher->last_name = $teacher['last_name'];
        $newTeacher->social_id = $teacher['social_id'];
        $newTeacher->cc = $teacher['cc'];

        $newTeacher->gender = $teacher['gender'];
        $newTeacher->date_of_birth = $teacher['date_of_birth'];

        $newTeacher->email = $teacher['email'];
        $newTeacher->telephone = $teacher['telephone'];
        $newTeacher->mobile = $teacher['mobile'];

        $newTeacher->inst_email = $teacher['inst_email'];
        $newTeacher->university_name = $teacher['university_name'];
        $newTeacher->join_date = $teacher['join_date'];
        $newTeacher->end_date = $teacher['end_date'];
        $newTeacher->amie= $teacher['amie'];

        $newTeacher->function = $teacher['function'] ;
        $newTeacher->work_area = $teacher['work_area'];

        $newTeacher->category = $teacher['category'];
        $newTeacher->reason_type = $teacher['reason_type'];
        $newTeacher->action_type = $teacher['action_type'] ;
        $newTeacher->action_description = $teacher['action_description'];
        $newTeacher->speciality= $teacher['speciality'];

        $newTeacher->disability = $teacher['disability'];
        $newTeacher->ethnic_group = $teacher['ethnic_group'];

        $newTeacher->province = $teacher['province'];
        $newTeacher->canton = $teacher['canton'];
        $newTeacher->parroquia = $teacher['parroquia'];
        $newTeacher->district = $teacher['district'];
        $newTeacher->district_code = $teacher['dist_code'];
        $newTeacher->zone = $teacher['zone'];

        $newTeacher->created_by = Auth::user()->id;
        $newTeacher->updated_by = Auth::user()->id;

        $newTeacher->save();


//        add user of the teacher
        event(new TeacherCreated($newTeacher, $creation_type, $creation_type));

        return $newTeacher;

    }

    public function update($teacher, $id){


        $newTeacher = $this->findById($id);

        $newTeacher->first_name = $teacher['first_name'];
        $newTeacher->last_name = $teacher['last_name'];
//        $newTeacher->social_id = $teacher['social_id'];
        $newTeacher->cc = $teacher['cc'];

        $newTeacher->gender = $teacher['gender'];
        $newTeacher->date_of_birth = $teacher['date_of_birth'];

//        $newTeacher->email = $teacher['email'];
        $newTeacher->telephone = $teacher['telephone'];
        $newTeacher->mobile = $teacher['mobile'];

//        $newTeacher->inst_email = $teacher['inst_email'];
        $newTeacher->university_name = $teacher['university_name'];
        $newTeacher->join_date = $teacher['join_date'];
        $newTeacher->end_date = $teacher['end_date'];
        $newTeacher->amie= $teacher['amie'];

        $newTeacher->function = $teacher['function'] ;
        $newTeacher->work_area = $teacher['work_area'];

        $newTeacher->category = $teacher['category'];
        $newTeacher->reason_type = $teacher['reason_type'];
        $newTeacher->action_type = $teacher['action_type'] ;
        $newTeacher->action_description = $teacher['action_description'];
        $newTeacher->speciality= $teacher['speciality'];

        $newTeacher->disability = $teacher['disability'];
        $newTeacher->ethnic_group = $teacher['ethnic_group'];

        $newTeacher->province = $teacher['province'];
        $newTeacher->canton = $teacher['canton'];
        $newTeacher->parroquia = $teacher['parroquia'];
        $newTeacher->district = $teacher['district'];
        $newTeacher->district_code = $teacher['dist_code'];
        $newTeacher->zone = $teacher['zone'];

        $newTeacher->updated_by = Auth::user()->id;

        $newTeacher->save();

        return $newTeacher;

    }


    /**
     * @param $social_id
     * @param $inst_email
     * @return bool
     */
    public function isTeacherExist($social_id, $inst_email){

        $teacher = Teacher::where([
            'social_id' => $social_id,
            'inst_email'    => $inst_email
        ])->count();

        if ($teacher > 0){
            return true;
        }

        return false;

    }


    /**
     * Search Filter
     *
     * @param $search_in
     * @param $search_keyword
     * @param $registration
     * @param $page
     * @return mixed
     */
    /*
    public function filter($search_in, $search_keyword, $registration, $page){


        $minutes = 20;
        $user = getAuthUser();

        $cache_key = 'portfolio_search_in_'.$search_in. '_with_'.$search_keyword .
            '_with_registration_'.$registration .
            '_in_page_'.$page.'for_user_'.$user->id;

        $registrations = Cache::tags(['PORTFOLIO_ADMIN'])->remember($cache_key, $minutes, function () use($search_in, $search_keyword, $registration){


            return Registration::with(['student', 'course', 'course.university', 'markApprovedBy','approvedBy'])
                ->where(function ($query) use($search_in, $search_keyword, $registration){

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

                } elseif ($search_in == 'all'){

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

            })
                ->orderBy('is_approved', 'desc')
                ->orderBy('tc_accept_time', 'desc')
            ->paginate(10);

        });


        return $registrations;

    }
 /*

    /**
     *
     *
     * @param $search_in
     * @param $search_keyword
     * @param $registration
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
  /*
    public function downloadPortfolio($search_in, $search_keyword, $registration){

        $minutes = 20;

        $cache_key = 'portfolio_search_in_'.$search_in. '_with_'.$search_keyword .
            '_with_registration_'.$registration;

        $registrations = Cache::tags(['portfolio'])->remember($cache_key, $minutes, function ()
                    use($search_in, $search_keyword, $registration) {

            return  Registration::with(['student', 'course', 'markApprovedBy','approvedBy'])
                ->where(function ($query) use($search_in, $search_keyword, $registration){

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

                    } elseif ($search_in == 'all'){

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

                })
                ->orderBy('id', 'desc')
                ->get();

        });


        return $registrations;
    }
/*
    /**
     * @param $id
     * @return mixed
     */
    public function getPortfolioById($id){

        $teacher = Cache::tags(['PORTFOLIO_BY_ID'])->remember('PORTFOLIO_BY_ID_'.$id, 10, function () use($id){

            return Registration::with(['student', 'course', 'course.university', 'markApprovedBy', 'approvedBy'])
                ->where('teacher_id', $id)
                ->orderBy('id', 'desc')
                ->paginate(50);

        }) ;


        return $teacher;

    }

    /**
     *
     */
    public function findById($id){

        $teacher = Cache::tags(['FIND_BY_ID'])->remember('FIND_BY_ID_'.$id, 10, function () use($id){

            return Teacher::find($id);

        }) ;


        return $teacher;


    }


    /**
     * @param $id
     */
    public function flushCacheById($id){

        Cache::tags(['FIND_BY_ID'])->flush('FIND_BY_ID_'.$id);

    }


}