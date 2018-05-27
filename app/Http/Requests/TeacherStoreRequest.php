<?php

namespace App\Http\Requests;

use App\Teacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TeacherStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->user()->can('create', Teacher::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'social_id' => 'required|unique:teachers|string|max:50',
            'cc' => 'required|string|max:50',
            'telephone' => 'string|max:50',
            'mobile' => 'string|max:50',
            'gender' => 'required|string|max:10',
            'email' => 'required|email|unique:users|max:255',
            'inst_email' => 'required|email|unique:teachers|max:255',
            'date_of_birth' => 'date_format:d/m/Y|string|max:10|min:10',
            'join_date' => 'date_format:d/m/Y|string|max:10|min:10',
            'end_date' => 'date_format:d/m/Y|string|max:10|min:10',

        ];
    }
}
