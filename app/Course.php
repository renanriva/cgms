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
        'data_update_brief', 'terms_conditions',
        'inspection_form_url', 'inspection_form_generated',
        'hours',         'quota',
        'start_date', 'end_date',
        'university_id',
        'lor_file_path', 'tc_file_path',
        'diploma_uploaded_by_id', 'diploma_upload_time', 'diploma_uploaded',
        'created_by', 'updated_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function requests(){

        return $this->belongsToMany('App\Teacher', 'course_requests',
                                            'course_id', 'teacher_id')
            ->withPivot('teacher_id', 'course_id', 'course_code', 'teacher_social_id', 'status')
            ->as('requests')
            ->withTimestamps();

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function university(){

        return $this->belongsTo('App\University', 'university_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registrations(){
        return $this->hasMany('App\Registration', 'course_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approvedRegistrations(){
        return $this->hasMany('App\Registration', 'course_id', 'id')
            ->where('is_approved', REGISTRATION_IS_APPROVED);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function diplomaUploadedBy(){

        return $this->belongsTo('App\User', 'diploma_uploaded_by_id', 'id');

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
