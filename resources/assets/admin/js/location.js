$(document).ready(function () {

    console.log('location ready');


    $(function() {

        // provinces
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/location/province/ajax/table',
            columns: [
                { data: 'id', name: 'provinces.id' },
                { data: 'name', name: 'provinces.name' },
                { data: 'count', name: 'count', searchable: false},
                { data :'action', searchable:false, orderable: false}
            ]
        });

    });


    getAllProvinces();

    function getAllProvinces() {
        var ajaxObj = {
            method: 'post',
            url: '/admin/location/province/ajax/all/'
        };

        $.ajax(ajaxObj)
            .done(function (response, textStatus, jqXhr) {

                var provinces = response.provinces;
                $.each(provinces, function (key, value) {
                    $('.js-edit-canton-province').append('<option value="'+value.id+'">'+value.name+'</option>');
                })


            }).fail(function (jqXhr, textStatus, errorThrown) {

        });
    }

});