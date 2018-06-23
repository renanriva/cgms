<td>
    @if($registration->is_approved == REGISTRATION_IS_APPROVED)
        <i class="fa fa-check-square-o"></i> Approved<br/>
        <small>by {{ $registration->approvedBy->name }} at <br/>{{ date('d m Y - h:i a', strtotime($registration->approval_time)) }}</small>
    @else
        <i class="fa fa-times"></i> Not Approved

    @endif
</td>