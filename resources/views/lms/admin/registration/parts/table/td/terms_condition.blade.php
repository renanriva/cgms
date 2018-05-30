<td>{{ $registration->accept_tc == 1 ? 'Yes' : 'No' }}
    @if ($registration->accept_tc == REGISTRATION_ACCEPT_TERMS_AND_CONDITION_TRUE)
        <br/><small><i class="fa fa-clock-o"></i>
            {{ date('d M, Y - h:i a', strtotime($registration->tc_accept_time)) }}</small>
    @endif
</td>