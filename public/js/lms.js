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


        $('#cantons-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'/admin/location/canton/ajax/table',
                method: 'POST'
            },
            columns: [
                { data: 'province_name', name: 'provinces.name', searchable: true },
                { data: 'canton_name', name: 'cantons.name', searchable: true},
                { data: 'canton_capital', name: 'cantons.capital', searchable: true},
                { data: 'canton_dist_name', name: 'cantons.dist_name', searchable: true},
                { data: 'canton_dist_code', name: 'cantons.dist_code', searchable: true},
                { data: 'canton_zone', name: 'cantons.zone', searchable: true},
                { data :'action', searchable:false, orderable: false,}
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
        });

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

});