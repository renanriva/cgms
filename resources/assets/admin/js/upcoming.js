/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    var page = $('#page_upcoming_course').length;

    if(page > 0) {

        console.log('Upcoming');

        // $('#upcoming-course').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: {
        //         url:'/admin/upcoming-courses/ajax/table',
        //         method: 'POST'
        //     },
        //     columns: [
        //         { data: 'course_code', name: 'course_code', searchable: true },
        //         { data: 'course_type', name: 'course_type', searchable: true },
        //         { data: 'short_name', name: 'short_name', searchable: true},
        //         { data: 'short_name', name: 'short_name', searchable: true},
        //         { data: 'start_date', name: 'start_date', searchable: true, render:function (item) {
        //             return new Date(item).toLocaleDateString();
        //         }},
        //         { data: 'end_date', name: 'end_date', searchable: true, render:function (item) {
        //             return new Date(item).toLocaleDateString();
        //         }},
        //         { data: 'modality', name: 'modality', searchable: true},
        //         { data: 'hours', name: 'hours', searchable: true},
        //         { data :'action', searchable:false, orderable: false,}
        //     ],
        //     initComplete: function () {
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


    }//end page

});