<td class="js-td-is-approved">
    @if($registration->is_approved == REGISTRATION_IS_NOT_APPROVED)
        <div class="form-group">
            <div class="checked">
                <label>
                    <input type="checkbox"
                           class="js-approve-check-{{ $registration->id }}" /> Approve
                </label>
            </div>
            <button class="btn btn-xs btn-primary btn-flat btn-approve-confirm"
                    data-id="{{ $registration->id }}">Confirm</button>
        </div>
    @else
        <i class="fa fa-check"></i> Yes <br/>
        <small><i class="fa fa-clock-o"></i>
            {{ date('d M, Y - h:i a', strtotime($registration->approval_time)) }}</small>
    @endif
</td>