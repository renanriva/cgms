<div class="btn-group btn-group-sm">
    <button class="btn btn-edit-course btn-primary" id="course_edit_{{ $id }}" data-id="{{ $id }}"
            @include('lms.admin.course.data-attributes')
    ><i class="fa fa-edit"></i> {{ __('lms.elements.button.edit') }}</button>
    <button class="btn btn-remove btn-remove-course btn-default" data-id="{{ $id }}"
            title="{{ __('lms.elements.button.remove') }}" data-name="{{ $short_name }}" data-course_id="{{ $id }}"
    ><i class="fa fa-trash"></i> {{ __('lms.elements.button.remove') }}</button>
</div>