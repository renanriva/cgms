/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    console.log('Common');


    var selectProvinceLength = $('.js-select-province').length;

    if(selectProvinceLength > 0) {


    }


    /**
     * Close Delete Modal
     */
    var deleteModal = $('#delete-modal').length;

    if (deleteModal){

        $('#delete-modal .btn-close').click(function () {
            var table = $('.table');
            $(table).find('tr').removeClass('danger')
                                .removeClass('warning');
        });
    }

});