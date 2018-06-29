<div class="btn-group btn-group-xs">
    <a href="/admin/teachers/{{ $id }}/edit" class="btn btn-edit-teacher btn-primary" id="teacher_edit_{{ $id }}" data-id="{{ $id }}"
    ><i class="fa fa-edit"></i> {{ __('lms.elements.button.edit') }}</a>


    <button class="btn btn-remove btn-remove-teacher btn-default" data-id="{{ $id }}" data-name="{{ $teacher_name }}"
            title="{{ __('lms.elements.button.remove') }}"
    ><i class="fa fa-trash"></i> {{ __('lms.elements.button.remove') }}</button>
</div>