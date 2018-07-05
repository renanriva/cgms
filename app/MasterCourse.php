<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterCourse extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_courses';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sort','created_by', 'updated_by'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses(){

        return $this->hasMany('App\Courses', 'master_course_id', 'id');

    }
}
