<div class="btn-group btn-group-xs">
    <button class="btn btn-edit-teacher btn-primary" id="teacher_edit_{{ $id }}" data-id="{{ $id }}"
            @include('lms.admin.teacher.data-attributes')
    ><i class="fa fa-edit"></i> {{ __('lms.elements.button.edit') }}</button>

    <button class="btn btn-create-modal-user btn-info" id="teacher_create_modal_{{ $id }}" data-id="{{ $id }}"
            {{--@include('lms.admin.teacher.data-attributes')--}}
    ><i class="fa fa-edit"></i> {{ __('lms.elements.button.create') }}</button>

    <button class="btn btn-remove btn-remove-teacher btn-default" data-id="{{ $id }}"
            title="{{ __('lms.elements.button.remove') }}"
    ><i class="fa fa-trash"></i> {{ __('lms.elements.button.remove') }}</button>
</div>