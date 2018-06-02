var grade_page = $('#course_grade_page').length;

console.log(' size ', grade_page);
if (grade_page > 0){

    console.log('course_grade_page');

    var addMark = $('#course-add-mark-modal');
    var courseId = null;

    showAddMark();
    function showAddMark() {
        console.log('click for modal');
        $('.btn-upload-grade').click(function () {

            courseId = $(this).attr('data-id');
            console.log('course id ', courseId);
            addMark.modal('show');
            $('#btn-upload-course-mark-list').attr('data-id', courseId);
        });
    }


    $('#course-mark-add-uploader-manual-trigger').fineUploader({
        template: 'qq-course-mark-upload-template',
        multiple: false,
        request: {
            endpoint: '/admin/course/'+$('.btn-upload-grade').attr('data-id')+'/add-grade',
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


            },
            onStatusChange: function (id, oldStatus, newStatus) {

            },
            onCancel: function (id, name) {

            }
        },
        autoUpload: false
    });

    $('#btn-upload-course-mark-list').click(function() {
        console.log('course-request-list-uploader-manual-trigger');
        $('#course-mark-add-uploader-manual-trigger').fineUploader('uploadStoredFiles');
    });


}