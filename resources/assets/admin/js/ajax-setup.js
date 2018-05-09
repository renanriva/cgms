
$(document).ready(function () {

    /**
     * Set csrf token to all ajax call
     */

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });


    $('table').on('hover', '.btn-remove', function () {
        $(this).removeClass('btn-default');
        $(this).addClass('btn-danger');
    },function () {
        console.log('hover in');
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-default');
    });


    //enable tooltip
    // $('[data-toggle="tooltip"]').tooltip();


    /**
     * Make the form elements enable and disable
     *
     * @param disableStatus
     */
    // window.toogleForm = function(disableStatus) {
    //     $('.modal input').attr('DISABLED', disableStatus);
    //     $('.modal button').attr('DISABLED', disableStatus);
    // }


    /**
     * Datetime picker
     */
    // $('.js-ds-datepicker').datetimepicker({
    //     format: 'MM/DD/YYYY',
    // });



});