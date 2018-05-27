<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 27/05/2018
     * Time: 2:23 PM
     */

namespace App\Repository;


use App\Events\TeacherCreated;
use App\Teacher;
use Illuminate\Support\Facades\Auth;

/**
 * Class TeacherRepository
 *
 * @package App\Repository
 */
class TeacherRepository
{

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




}