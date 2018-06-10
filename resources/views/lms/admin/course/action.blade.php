<div class="btn-group btn-group-sm">
    <button class="btn btn-edit-course btn-primary" id="course_edit_{{ $id }}" data-id="{{ $id }}"
            @include('lms.admin.course.data-attributes')
    ><i class="fa fa-edit"></i> {{ __('lms.elements.button.edit') }}</button>

    @if(Auth::user()->role == 'admin')
    <button class="btn btn-remove btn-remove-course btn-default" data-id="{{ $id }}"
            title="{{ __('lms.elements.button.remove') }}" data-name="{{ $short_name }}" data-course_id="{{ $id }}"
    ><i class="fa fa-trash"></i> {{ __('lms.elements.button.remove') }}</button>
    @elseif(Auth::user()->role == 'university')
        <a href="/admin/course/{{ $id }}/add-grade" class="btn btn-success" data-id="{{ $id }}">
            <i class="fa fa-plus"></i> Add Grade</a>
    @endif

{{--    @can('upload_diploma', $course)--}}
        <button class="btn btn-upload-diploma btn-info" data-id="{{ $id }}"
                title="{{ __('lms.elements.button.upload_diploma') }}"
                data-name="{{ $short_name }}" data-course_id="{{ $id }}">
            <i class="fa fa-cloud-upload"></i> {{ __('lms.elements.button.upload_diploma') }}
        </button>
    {{--@endcan--}}
</div>