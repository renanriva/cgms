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
            // $('.js-edit-course-start_date, .js-edit-course-end_date').datepicker();


        var modal = $('#edit-teacher-modal');


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

        $('#trigger-upload').click(function() {
            $('#fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });
    }


});