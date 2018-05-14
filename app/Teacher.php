<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teachers';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'social_id', 'cc', 'date_of_birth', 'gender', 'telephone', 'mobile', 'moodle_id',
        'inst_email', 'university_name', 'function', 'work_area', 'category',
        'reason_type', 'action_type', 'action_description', 'speciality',
        'join_date', 'end_date', 'amie', 'disability', 'ethnic_group',
        'parroquia', 'user_id', 'created_by', 'updated_by'
    ];



    public function user(){

    }

    public function registrations(){

    }


}
