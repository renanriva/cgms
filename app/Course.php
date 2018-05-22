<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'courses';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_code', 'course_type', 'modality',
        'short_name', 'description',         'comment',
        'video_text', 'video_code', 'video_type',
        'terms_and_conditions', 'data_update_brief',
        'inspection_form_url', 'inspection_form_generated',
        'hours',         'quota',
        'start_date', 'end_date',
        'university_id',
        'created_by', 'updated_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function requests(){

        return $this->belongsToMany('App\Teacher', 'course_requests',
                                            'course_id', 'teacher_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function university(){

        return $this->belongsTo('App\University', 'university_id', 'id');
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date'
    ];

}
