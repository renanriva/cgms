<?php

namespace App\Http\Requests;

use App\Course;
use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', Course::class);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'course_code'           => 'required|unique:courses|string|max:50',
//            'course_type'           => 'required|string|max:50',
//            'modality'              => 'required|string|max:50|min:1',
            'short_name'            => 'required|string|max:255',

            'start_date'            => 'sometimes|nullable|date_format:d/m/Y|string|max:10|min:10',
            'end_date'              => 'sometimes|nullable|date_format:d/m/Y|string|max:10|min:10',

            'university_id'         => 'sometimes|nullable|integer',

            'hours'                 => 'required|numeric|max:1000|min:1',
            'quota'                 => 'required|numeric|max:1000|min:1',

            'comment'               => 'sometimes|string|nullable|max:255',
            'description'           => 'sometimes|string|nullable|max:5000',
            'video_text'            => 'sometimes|string|nullable|max:5000',
            'video_type'            => 'sometimes|string:nullable|max:255',
            'video_code'            => 'sometimes|string|nullable|max:1000',

            'data_update_brief'     => 'sometimes|nullable|string:max:100',

        ];

    }
}
