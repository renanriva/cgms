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

                // importModal.find('.model-title').text('Delete Canton');
                // importModal.find('.js-message').text('Are you sure to delete Canton [' + name + ']?');
                // importModal.find('#btn-delete-confirm').attr('data-url', '/admin/course/ajax/' + id);
                // importModal.find('#btn-delete-confirm').attr('data-id', id);
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

            // thumbnails: {
            //     placeholders: {
            //         waitingPath: '/source/placeholders/waiting-generic.png',
            //         notAvailablePath: '/source/placeholders/not_available-generic.png'
            //     }
            // },
            autoUpload: false
        });

        $('#trigger-upload').click(function() {
            $('#fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });

        // $('#fine-uploader-gallery').fineUploader({
        //     template: 'qq-template-gallery',
        //     request: {
        //         endpoint: '/server/uploads'
        //     },
        //     autoUpload: false,
        //     thumbnails: {
        //         // placeholders: {
        //         //     waitingPath: '/source/placeholders/waiting-generic.png',
        //         //     notAvailablePath: '/source/placeholders/not_available-generic.png'
        //         // }
        //     },
        //     validation: {
        //         allowedExtensions: ['xls', 'csv', 'xlsx'],
        //         itemLimit: 1,
        //         sizeLimit: 204800 // 50 kB = 50 * 1024 bytes
        //     },
        //     callbacks: {
        //         // onSubmit: function (id, name) {
        //         //     console.log('file id: '+  id + ' | name: '+name);
        //         //     $('#trigger-upload-'+element).removeClass('btn-info')
        //         //         .addClass('btn-primary');
        //         //     $('#trigger-select-'+element).addClass('btn-info')
        //         //         .removeClass('btn-primary');
        //         //
        //         // },
        //         // onComplete: function (id, name, response, xhr ) {
        //         //
        //         //     $('.event-image-'+element).prop('src', response.url);
        //         //
        //         //     $('#trigger-upload-'+element).addClass('btn-info')
        //         //         .removeClass('btn-primary');
        //         //     $('#trigger-select-'+element).removeClass('btn-info')
        //         //         .addClass('btn-primary');
        //         //
        //         // },
        //         // onStatusChange: function (id, oldStatus, newStatus) {
        //         //
        //         // },
        //         // onCancel: function (id, name) {
        //         //
        //         //     $('#trigger-upload-'+element).addClass('btn-info')
        //         //         .removeClass('btn-primary');
        //         //     $('#trigger-select-'+element).removeClass('btn-info')
        //         //         .addClass('btn-primary');
        //         //
        //         // }
        //     }
        // });

        // var qq = require('fine-uploader');
        // var uploader = new qq.FineUploaderBasic();
        //
        // console.log('uploader ', uploader);
    }


});