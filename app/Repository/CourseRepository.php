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

/**
 * Class CourseRepository
 *
 * @package App\Repository
 */
class CourseRepository
{

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
        $course->course_type            = $post['course_type'];
        $course->modality               = $post['modality'];

        $course->university_id          = $post['university_id'];
        $course->short_name             = $post['short_name'];

        $course->start_date             = $post['start_date'];
        $course->end_date               = $post['end_date'];

        $course->hours                  = $post['hours'];
        $course->quota                  = $post['quota'];

        $course->comment                = $post['comment'];
        $course->description            = $post['description'];
        $course->video_text             = $post['video_text'];
        $course->video_type             = $post['video_type'];
        $course->video_code             = $post['video_code'];
        $course->data_update_brief      = $post['data_update_text'];

        $course->inspection_form_generated = false;

        $course->created_by     = Auth::user()->id;
        $course->updated_by     = Auth::user()->id;
        $course->save();

        $course->save();


//        add user of the teacher
//        event(new TeacherCreated($newCourse, $creation_type, $creation_type));

        return $course;

    }

    public function update($teacher, $id){


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
}