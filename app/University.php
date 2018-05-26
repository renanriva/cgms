<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'universities';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'login_email', 'login_user_name', 'phone',
        'website' , 'profile_logo', 'note', 'created_by', 'updated_by', 'user_id'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courses(){

        return $this->belongsTo('App\Course', 'university_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){

        return $this->hasOne('App\User',  'user_id', 'id');

    }

    public function createdBy(){

        return $this->hasOne('App\User',  'created_id', 'id');

    }

    public function updatedBy(){

        return $this->hasOne('App\User',  'updated_id', 'id');

    }


}
