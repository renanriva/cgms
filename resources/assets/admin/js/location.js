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


        // $('#cantons-table').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: {
        //         url:'/admin/location/canton/ajax/table',
        //         method: 'POST'
        //     },
        //     columns: [
        //         { data: 'province_name', name: 'provinces.name', searchable: true },
        //         { data: 'canton_name', name: 'cantons.name', searchable: true},
        //         { data: 'canton_capital', name: 'cantons.capital', searchable: true},
        //         { data: 'canton_dist_name', name: 'cantons.dist_name', searchable: true},
        //         { data: 'canton_dist_code', name: 'cantons.dist_code', searchable: true},
        //         { data: 'canton_zone', name: 'cantons.zone', searchable: true},
        //         { data :'action', searchable:false, orderable: false,}
        //     ],
        //     initComplete: function () {
        //         console.log('init complete ');
        //         this.api().columns().every(function () {
        //             var column = this;
        //             var input = document.createElement("input");
        //             $(input).appendTo($(column.footer()).empty())
        //                 .on('change', function () {
        //                     column.search($(this).val()).draw();
        //                 });
        //         });
        //     },
        // });

        $('#parroquia-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'/admin/location/parroquia/ajax/table',
                method: 'POST'
            },
            columns: [
                { data: 'province_name', name: 'provinces.name', searchable: true },
                { data: 'canton_name', name: 'cantons.name', searchable: true},
                { data: 'parroquia_name', name: 'parroquia.name', searchable: true},
                { data :'action', searchable:false, orderable: false}
            ],
            initComplete: function () {
                console.log('init complete ');
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val()).draw();
                        });
                });
            },
        })



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