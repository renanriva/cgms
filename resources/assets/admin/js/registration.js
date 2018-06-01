/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    var pageCourseLength = $('#page_register').length;

    if(pageCourseLength > 0) {

        console.log('register');

        var registrationId = $('#registration_id').val();


        $('#page_register .btn-accept-tc').click(function () {

            var data = {
                accept_tc : $('#chk-accept-registration-tc').is(':checked'),
            };

            updateRegistration(registrationId, data, 'accept');

        });


        function updateRegistration(registrationId, data, part) {

            var obj = {
                url: '/admin/registration/'+registrationId+'/update/'+part,
                method: 'POST',
                data: data,
            };
            $.ajax(obj)
            .done(function (response, textStatus, jqXhr) {

                $('.js-accept-time')
                    .removeClass('hidden')
                    .html(response.registration.tc_accept_time);

                $('.btn-accept-tc').remove();

            }).fail(function (jqXhr, textStatus, errorThrown) {
                console.log(' fail registration ' , jqXhr);

                alert('Error : '+errorThrown);

            });

        }



        $('.next').click(function(){

            var nextId = $(this).parents('.tab-pane').next().attr("id");
            console.log('next ', nextId);
            // $('#'+nextId).tab('show');
            $('a[href="#'+nextId+'"]').tab('show');

        });

        $('.first').click(function(){

            $('#myWizard a:first').tab('show');

        });


        // upload signed registration file
        $('#registration_release_file_upload').fineUploader({
            template: 'qq-registration-release-file-template-manual-trigger',
            multiple: false,
            request: {
                endpoint: '/admin/registration/'+registrationId+'/upload/inspection',
                params: {
                    teacher_id : function () {
                        return $('#teacher_social_id').val();
                    }
                },
                customHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            validation: {
                itemLimit: 1,
                allowedExtensions:  ['doc', 'docx', 'pdf'],
            },
            callbacks: {
                onSubmit: function (id, name) {

                },
                onComplete: function (id, name, response, xhr ) {

                },
                onStatusChange: function (id, oldStatus, newStatus) {

                },
                onCancel: function (id, name) {

                }
            },
            autoUpload: false
        });

        $('#btn-upload-registration-release-file').click(function() {
            console.log('#btn-upload-registration-release-file');
            $('#registration_release_file_upload').fineUploader('uploadStoredFiles');
        });

    }//end page

});