/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    var pageCourseLength = $('#page_register').length;

    if(pageCourseLength > 0) {

        console.log('register');


        // $('.next').click(function(){
        //
        //     var nextId = $(this).parents('.tab-pane').next().attr("id");
        //     console.log('next ', nextId);
        //     $('#'+nextId).tab('show');
        //
        // });
        //
        // $('.first').click(function(){
        //
        //     $('#myWizard a:first').tab('show');
        //
        // });


        $('#registration_release_file_upload').fineUploader({
            template: 'qq-registration-release-file-template-manual-trigger',
            multiple: false,
            request: {
                endpoint: '/admin/course/upload/request-list',
                customHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            validation: {
                itemLimit: 1,
                allowedExtensions:  ['csv', 'xls', 'xlsx'],
            },
            callbacks: {
                onSubmit: function (id, name) {

                },
                onComplete: function (id, name, response, xhr ) {

                    if(response.error === undefined){
                        modal.modal('hide');
                    }

                },
                onStatusChange: function (id, oldStatus, newStatus) {

                },
                onCancel: function (id, name) {

                }
            },
            autoUpload: false
        });

        $('#btn-upload-registration-release-file').click(function() {
            console.log('course-request-list-uploader-manual-trigger');
            $('#qq-registration-release-file-template-manual-trigger').fineUploader('uploadStoredFiles');
        });

    }//end page

});