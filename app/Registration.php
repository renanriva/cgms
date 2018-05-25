<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Registration
 *
 * @package App
 */
class Registration extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'registrations';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reg_date', 'teacher_id', 'course_id', 'user_social_id', 'user_first_name', 'user_last_name',
        'email', 'cell_phone', 'accept_tc', 'tc_accept_time',
        'inspection_certificate', 'inspection_certificate_signed', 'inspection_certificate_upload_time',
        'registry_is_generated', 'is_approved',
        'approval_time', 'approved_by',
    ];



}
