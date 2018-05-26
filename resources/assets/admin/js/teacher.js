/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    var pageLength = $('#page_teacher').length;

    if(pageLength > 0) {

        console.log('Teacher');

        /**
         * Datepicker
         */

        $('#teacher-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'/admin/teachers/ajax/table',
                method: 'POST'
            },
            columns: [
                { data: 'social_id', name: 'teachers.social_id', searchable: true },
                { data: 'teacher_name', name: 'teacher_name', searchable: true,
                    render:function (item, data, meta) {
                        var icon = meta.gender === 'F'? 'female':'male';
                        var url = '/admin/teachers/profile/'+meta.id;
                        return '<i class="fa fa-'+icon+'"></i>&nbsp;<a href="'+url+'">'+meta.teacher_name+'</a>';
                }},
                { data: 'teacher_email', name: 'teacher_email', searchable: true},
                { data: 'university', name: 'university', searchable: true},
                // { data: 'function', name: 'function', searchable: true},
                { data: 'moodle_id', name: 'moodle_id', searchable: true},
                { data: 'province', name: 'province', searchable: true, render:function (item, data, meta) {
                    return meta.province + ',<br/>'+meta.canton + ', <br/><small>'+meta.parroquia+'<small/>';
                }},
                // { data: 'canton', name: 'canton', searchable: true},
                { data: 'district', name: 'district', searchable: true, render: function (item, data, meta) {

                    return meta.district+',<br/>'+meta.district_code+'<br/>'+'<small>'+meta.zone+'</small>';
                }},
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



        var modal = $('#edit-teacher-modal');

        showAddModal();
        function showAddModal() {

            $('#btn-create-teacher').click(function () {

                modal.find('.js-modal-title-add').removeClass('hidden');
                modal.find('.js-modal-title-edit').addClass('hidden');
                modal.find('.js-login-section').removeClass('hidden');

                modal.find('input').val('');

                modal.find('#btn-store-teacher').text('Create');
                modal.find('#btn-store-teacher').attr('data-type','create');
                modal.modal('show');

            });
        }


        var importModal = $('#upload-teacher-modal');

        /**
         * Show Delete modal
         */
        showImport();
        function showImport() {

            $('#btn-import-teachers').click(function () {

                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                importModal.modal('show');

            });
        }


        //qq upload

        $('#fine-uploader-manual-trigger').fineUploader({
            template: 'qq-template-manual-trigger',
            request: {
                endpoint: '/admin/teachers/upload',
                customHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            validation: {
                itemLimit: 1,
                allowedExtensions:  ['xlsx', 'xls', 'csv'],
            },
            callbacks: {
                onSubmit: function (id, name) {

                },
                onComplete: function (id, name, response, xhr ) {

                    $('.js-message').empty();

                    if(response.error === undefined){
                        $('.js-message').removeClass('hidden')
                        .append('<div class="alert alert-success" role="alert">Total <strong>'+response.rows.length+'</strong> records added.</div>');
                    } else {
                        console.log('error ', response.error);
                        $('.js-message').removeClass('hidden')
                            .append('<div class="alert alert-danger" role="alert">'+response.error+'. We think non compliant file was uploaded.</div>');
                    }

                },
                onStatusChange: function (id, oldStatus, newStatus) {

                },
                onCancel: function (id, name) {

                }
            },
            autoUpload: false
        });

        //@todo should be #page_teacher #triger-upload to be specific button selector
        $('#trigger-upload').click(function() {
            $('#fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });


        var createMoodleUser = $('#create-moodal-modal');

        showCreateModalModal();
        function showCreateModalModal() {

            $('#teacher-table').on('click','.btn-create-modal-user', function () {

                // modal.find('.js-modal-title-edit').removeClass('hidden');
                // modal.find('.js-modal-title-add').addClass('hidden');
                //
                // var data = {
                //     id              : $(this).attr('data-id'),
                //     course_id       : $(this).attr('data-course_id'),
                //     course_type     : $(this).attr('data-course_type'),
                //     modality        : $(this).attr('data-modality'),
                //     short_name      : $(this).attr('data-short_name'),
                //     description     : $(this).attr('data-description'),
                //     comment         : $(this).attr('data-comment'),
                //     hours           : $(this).attr('data-hours'),
                //     quota           : $(this).attr('data-quota'),
                //     start_date      : $(this).attr('data-start_date'),
                //     end_date        : $(this).attr('data-end_date'),
                //     university_id   : $(this).attr('data-university_id')
                // };
                //
                //
                // modal.find('.js-edit-course-id').val(data.course_id);
                // modal.find('.js-edit-course-type option[value="'+data.course_type+'"]').attr('selected', true);
                // modal.find('.js-edit-course-modality option[value="'+data.modality+'"]').attr('selected', true);
                // modal.find('.js-edit-course-university option[value="'+data.university_id+'"]').attr('selected', true);
                // modal.find('.js-edit-course-short_name').val(data.short_name);
                // modal.find('.js-edit-course-description').val(data.description);
                // modal.find('.js-edit-course-comment').val(data.comment);
                // modal.find('.js-edit-course-hours').val(data.hours);
                // modal.find('.js-edit-course-quota').val(data.quota);
                // modal.find('.js-edit-course-start_date').val(data.start_date);
                // modal.find('.js-edit-course-end_date').val(data.end_date);
                //
                // modal.find('#btn-edit-course').attr('data-id', data.id);
                // modal.find('#btn-edit-course').text('Update');
                // modal.find('#btn-edit-course').attr('data-type','update');
                createMoodleUser.modal('show');


            });

        }


    }


    var isTeacherForm = $('.teacher-form').length;

    if (isTeacherForm > 0 ){



        loadProvinces();
        function loadProvinces() {

            var provinceLength = $('.js-province').length;

            if (provinceLength > 0){

                var province = $('.js-province');

                province.empty();
                province.attr('disabled', 'disabled');
                province.append('<option>Loading...</option>');

                var ajaxObj = {
                    method: 'post',
                    url: '/admin/location/province/ajax/all'
                };

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 200) {

                            province.empty();

                            $.each(response.provinces, function (key, value) {
                                province.append('<option value="'+value.id+'">'+value.name+'</option>');
                            });
                            province.attr('disabled', false);

                        }

                    }).fail(function (jqXhr, textStatus, errorThrown) {

                        alert('Error: '+errorThrown);
                        console.log('error ', jqXhr);
                        province.empty();
                        province.attr('disabled', false);

                });


                //select 2
                province.select2({
                    // dropdownParent: modal,
                    width: 'resolve',
                    minimumResultsForSearch: 20,
                    // minimumInputLength: 1, // only start searching when the user has input 3 or more characters
                    maximumInputLength: 20 // only allow terms up to 20 characters long
                });


            }

        }

        // on select 2 select, load canton
        $('.js-province').on('select2:select', function (e) {

            var data = e.params.data;
            console.log(data);

            loadCantons(data.id)
        });

        function loadCantons(provinceId) {


            var canton = $('.js-canton');

            canton.empty();
            canton.attr('disabled', 'disabled');
            canton.append('<option>Loading...</option>');

            var ajaxObj = {
                method: 'get',
                url: '/admin/location/canton/ajax/'+provinceId
            };

            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 200) {

                        canton.empty();

                        $.each(response.cantons, function (key, value) {
                            canton.append('<option value="'+value.id+'">'+value.name+'</option>');
                        });

                        canton.attr('disabled', false);

                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                    alert('Error: '+errorThrown);
                    console.log('error ', jqXhr);
                    canton.empty();
                    canton.attr('disabled', false);

            });


            //select 2
            canton.select2({
                // dropdownParent: modal,
                width: 'resolve',
                minimumResultsForSearch: 20,
                // minimumInputLength: 0, // only start searching when the user has input 3 or more characters
                maximumInputLength: 20 // only allow terms up to 20 characters long
            });




        }// end function

    }


});