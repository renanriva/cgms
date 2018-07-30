<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 27/05/2018
     * Time: 2:23 PM
     */

namespace App\Repository;


use App\Course;
use App\Events\TeacherCreated;
use App\Registration;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Class CourseRepository
 *
 * @package App\Repository
 */
class CourseRepository
{

    /**
     * @param $page
     * @return mixed
     */
    public function paginate($page){

        $data = Cache::tags('COURSE_PAGINATE')->remember('COURSE_PAGINATE_'.$page, 60, function ()  {


            return Course::with(['masterCourse', 'requests', 'university', 'registrations', 'approvedRegistrations',
                'updatedBy'])
                    ->orderBy('updated_at', 'desc')
                    ->orderBy('stage', 'asc')
                    ->orderBy('status', 'asc')
                    ->paginate(10);

        });

        return $data;

    }

    /**
     * @param $page
     * @param $universityId
     * @return mixed
     */
    public function coursesByUniversity($page, $universityId){

        $data = Cache::tags('COURSE_PAGINATE')->remember('COURSE_UNIVERSITY_'.$universityId.'__PAGINATE_'.$page, 60,
            function () use ($universityId)  {


            return Course::with(['masterCourse', 'requests', 'university', 'registrations', 'approvedRegistrations'])
                ->where('university_id', $universityId)
                ->paginate(10);

        });

        return $data;
    }

    /**
     * @param array $post
     * @return Course
     */
    public function insert($post){

        /**
         * Store a teacher and return the teacher
         */

        $course = new Course();

        $course->course_code            = $post['course_code'];
        $course->course_type_id         = $post['course_type_id'];

        $course->university_id          = $post['university_id'];
        $course->short_name             = $post['short_name'];

        $course->start_date             = $post['start_date'];
        $course->end_date               = $post['end_date'];

        $course->hours                  = $post['hours'];
        $course->quota                  = $post['quota'];

        $course->comment                            = $post['comment'];
        $course->description                        = $post['description'];
        $course->video_text                         = $post['video_text'];
        $course->video_type                         = $post['video_type'];
        $course->video_code                         = $post['video_code'];
        $course->data_update_brief                  = $post['data_update_text'];
        $course->terms_conditions                   = $post['terms_conditions'];

        $course->master_course_id                   = $post['master_course_id'];
        $course->edition                            = $post['course_edition'];
        $course->stage                              = $post['course_stage'];
        $course->status                             = $post['course_status'];
        $course->has_disclaimer                     = $post['is_disclaimer'];
        $course->cost                               = $post['cost'];
        $course->finance_type                       = $post['finance_type'];
        $course->grade_upload_start_date            = $post['grade_upload_start_date'];
        $course->grade_upload_end_date              = $post['grade_upload_start_date'];

        $course->inspection_form_generated = false;

        $course->created_by     = Auth::user()->id;
        $course->updated_by     = Auth::user()->id;
        $course->save();


        return $course;

    }

    public function update($teacher, $id){

/*
        $newTeacher = Teacher::find($id);

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

        return $newTeacher; */

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
     * Update Grade and grade details
     *
     * @param string    $courseId
     * @param string    $student_social_id
     * @param float     $grade
     * @param integer   $approved
     * @param User      $user
     * @return mixed
     */
    public function updateGrade($courseId, $student_social_id, $grade, $approved, $user){

        $registration = Registration::where('course_id', $courseId)
                        ->where('user_social_id', $student_social_id)
                        ->first();

        if ($registration){
            $registration->mark = $grade;
            $registration->mark_approved = $approved;
            $registration->mark_approved_by = $user->id;
            $registration->mark_upload_time = Carbon::now();
            $registration->save();

            return $registration;

        } else {
            return null;
        }


    }


    public function findById($id){

        $time = config('adminlte.cache_time');

        $course = Cache::tags(['COURSE_FIND_BY_ID'])->remember('COURSE_FIND_BY_ID_'.$id, $time, function () use($id){

            return Course::with(['requests', 'university', 'registrations', 'approvedRegistrations',
                'diplomaUploadedBy'])
            ->find($id);

        });

        return $course;

    }

    /**
     * Invalidate cache course
     * @param $id
     */
    public function flushById($id){

        Cache::tags(['COURSE_FIND_BY_ID'])->flush('COURSE_FIND_BY_ID_'.$id);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getById($id){


        return $this->findById($id);

    }

    /**
     * @param $code
     * @return mixed
     */
    public function findByCourseCode($code){

        $time = config('adminlte.cache_time');

        $course = Cache::tags(['COURSE_FIND_BY_CODE'])->remember('COURSE_FIND_BY_CODE_'.$code, $time, function () use($code){

            return Course::where('course_code', $code)->first();

        });

        return $course;


    }

    public function flushCache(){

        Cache::tags(['COURSE_FIND_BY_ID', 'COURSE_FIND_BY_CODE'])->flush();
        Cache::tags(['COURSE_PAGINATE'])->flush();
    }

    /**
     * @param $id
     */
    public function invalidateCache($id){

        $this->flushById($id);

    }
}