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
        'name', 'created_by', 'updated_by'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courses(){

        return $this->belongsTo('App\Course', 'university_id', 'id');
    }

}
