/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    var pageCourseLength = $('#page_course').length;

    if(pageCourseLength > 0) {


        /**
         * Datepicker
         */
        $('.js-edit-course-start_date, .js-edit-course-end_date').datepicker();


        console.log('Course');

        var modal = $('#edit-course-modal');

        $('#course-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'/admin/course/ajax/table',
                method: 'POST'
            },
            columns: [
                { data: 'course_id', name: 'course_id', searchable: true },
                { data: 'short_name', name: 'short_name', searchable: true},
                { data: 'hours', name: 'hours', searchable: true},
                { data: 'start_date', name: 'start_date', searchable: true, render:function (item) {
                    return new Date(item).toLocaleDateString();
                }},
                { data: 'end_date', name: 'end_date', searchable: true, render:function (item) {
                    return new Date(item).toLocaleDateString();
                }},
                { data: 'quota', name: 'quota', searchable: true},
                { data: 'comment', name: 'comment', searchable: false},
                { data :'action', searchable:false, orderable: false,}
            ],
            initComplete: function () {
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

        loadUniversities();
        function loadUniversities() {

            var universityLength = $('.js-edit-course-university').length;

            if (universityLength > 0){

                var selectUniversity = $('.js-select-university');

                selectUniversity.empty();
                selectUniversity.attr('disabled', 'disabled');
                selectUniversity.append('<option>Loading...</option>');

                var ajaxObj = {
                    method: 'get',
                    url: '/admin/university/ajax/'
                };

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 200) {

                            selectUniversity.empty();

                            $.each(response.universities, function (key, value) {
                                selectUniversity.append('<option value="'+value.id+'">'+value.name+'</option>');
                            });
                            selectUniversity.attr('disabled', false);

                        }

                    }).fail(function (jqXhr, textStatus, errorThrown) {

                        alert('Error: '+errorThrown);
                        console.log('error ', jqXhr);
                        selectUniversity.empty();
                        selectUniversity.attr('disabled', false);

                });


                //select 2
                selectUniversity.select2({
                    dropdownParent: modal,
                    width: 'resolve',
                    minimumResultsForSearch: 20,
                    minimumInputLength: 3, // only start searching when the user has input 3 or more characters
                    maximumInputLength: 20 // only allow terms up to 20 characters long
                });


            }

        }



        /**
         * Create Course
         */
        showAddModal();
        function showAddModal() {

            $('#btn-create-course').click(function () {

                console.log('click create course');

                modal.find('.js-modal-title-add').removeClass('hidden');
                modal.find('.js-modal-title-edit').addClass('hidden');
                modal.find('input').val('');

                modal.find('#btn-edit-course').text('Create');
                modal.find('#btn-edit-course').attr('data-type','create');
                modal.modal('show');

            });
        }


        /**
         * Create / Update course
         */
        clickCreateUpdate();
        function clickCreateUpdate() {

            $('#btn-edit-course').click(function (e) {

                e.preventDefault();

                var data = {
                    id          : $(this).attr('data-id'),
                    course_id   : modal.find('.js-edit-course-id').val(),
                    modality : modal.find('.js-edit-course-modality option:selected').val(),
                    course_type : modal.find('.js-edit-course-type option:selected').val(),

                    university_id : modal.find('.js-edit-course-university option:selected').val(),

                    short_name  : modal.find('.js-edit-course-short_name').val(),

                    start_date  : modal.find('.js-edit-course-start_date').val(),
                    end_date    : modal.find('.js-edit-course-end_date').val(),

                    hours       : modal.find('.js-edit-course-hours').val(),
                    quota       : modal.find('.js-edit-course-quota').val(),

                    comment     : modal.find('.js-edit-course-comment').val(),
                    description : modal.find('.js-edit-course-description').val()
                };

                if ( $(this).attr('data-type') ==='update'){
                    update(data);
                } else if ($(this).attr('data-type') === 'create'){
                    insertCourse(data);
                }

            });

        }


        /**
         * Show Edit Modal
         */
        showEditModal();
        function showEditModal() {

            $('#course-table').on('click','.btn-edit-course', function () {

                modal.find('.js-modal-title-edit').removeClass('hidden');
                modal.find('.js-modal-title-add').addClass('hidden');

                var data = {
                    id              : $(this).attr('data-id'),
                    course_id       : $(this).attr('data-course_id'),
                    course_type     : $(this).attr('data-course_type'),
                    modality        : $(this).attr('data-modality'),
                    short_name      : $(this).attr('data-short_name'),
                    description     : $(this).attr('data-description'),
                    comment         : $(this).attr('data-comment'),
                    hours           : $(this).attr('data-hours'),
                    quota           : $(this).attr('data-quota'),
                    start_date      : $(this).attr('data-start_date'),
                    end_date        : $(this).attr('data-end_date'),
                    university_id   : $(this).attr('data-university_id')
                };


                modal.find('.js-edit-course-id').val(data.course_id);
                modal.find('.js-edit-course-type option[value="'+data.course_type+'"]').attr('selected', true);
                modal.find('.js-edit-course-modality option[value="'+data.modality+'"]').attr('selected', true);
                modal.find('.js-edit-course-university option[value="'+data.university_id+'"]').attr('selected', true);
                modal.find('.js-edit-course-short_name').val(data.short_name);
                modal.find('.js-edit-course-description').val(data.description);
                modal.find('.js-edit-course-comment').val(data.comment);
                modal.find('.js-edit-course-hours').val(data.hours);
                modal.find('.js-edit-course-quota').val(data.quota);
                modal.find('.js-edit-course-start_date').val(data.start_date);
                modal.find('.js-edit-course-end_date').val(data.end_date);

                modal.find('#btn-edit-course').attr('data-id', data.id);
                modal.find('#btn-edit-course').text('Update');
                modal.find('#btn-edit-course').attr('data-type','update');
                modal.modal('show');


            });

        }

        /**
         * Save data
         * @param data
         */
        function insertCourse(data) {

            var ajaxObj = {
                method: 'post',
                data: data,
                url: '/admin/course/ajax'
            };
            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 201) {

                        var row = '<tr class="success"><td>'+data.course_id+'</td><td>'+data.short_name+'</td><td>'+data.hours
                            +'</td><td>'+data.start_date+'</td><td>'+data.end_date+'</td><td>'+data.quota+'</td>+' +
                            '<td>'+data.comment+'</td><td>Actions</td></tr>';

                        $('#course-table tr:last').after(row);

                        modal.modal('hide');
                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                alert('Error: '+errorThrown);
                console.log('error ', jqXhr);

            });

        }

        /**
         * Update Course
         * @param data
         */
        function update(data) {

            var ajaxObj = {
                method: 'post',
                data: data,
                url: '/admin/course/ajax/'+data.id
            };
            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {



                    console.log('respnse ', response);

                    if (jqXhr.status === 200) {

                        var startDate = new Date(data.start_date).toLocaleDateString();
                        var endDate = new Date(data.end_date).toLocaleDateString();



                        $('tr#course_id_'+data.id).each(function(){

                            $(this).find('td').eq(0).text(data.course_id);
                            $(this).find('td').eq(1).text(data.short_name);
                            $(this).find('td').eq(2).text(data.hours);

                            // $(this).find('td').eq(3).text(startDate.getDay() +'/'+(startDate.getMonth()+1)+'/'+startDate.getFullYear());
                            $(this).find('td').eq(3).text(startDate);
                            // $(this).find('td').eq(4).text(endDate.getDay()+'/'+(endDate.getMonth()+1)+'/'+endDate.getFullYear());
                            $(this).find('td').eq(4).text(endDate);

                            $(this).find('td').eq(5).text(data.quota);
                            $(this).find('td').eq(6).text(data.comment);

                        });

                        $('tr#course_id_'+data.id).addClass('success');

                        modal.modal('hide');
                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                alert('Error: '+errorThrown);
                console.log('error ', jqXhr);

            });

        }

    }//end page



});