<div class="btn-group btn-group-sm">
    <button class="btn btn-edit-teacher btn-primary" id="teacher_edit_{{ $id }}" data-id="{{ $id }}"
            @include('lms.admin.location.canton.data-attributes')
    ><i class="fa fa-edit"></i> {{ __('lms.elements.button.edit') }}</button>

    <button class="btn btn-remove btn-remove-teacher btn-default" data-id="{{ $id }}" data-name="{{ $canton_name }}"
            title="{{ __('lms.elements.button.remove') }}"
    ><i class="fa fa-trash"></i> {{ __('lms.elements.button.remove') }}</button>
</div>