/**
 * Created by ariful.haque on 06/05/2018.
 */
$(document).ready(function () {

    console.log('get ajax data');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    /**
     * if under these pages
     */



});