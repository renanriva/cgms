<!-- Modal -->
<div class="modal" id="course-upload-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cloud-upload"></i>
                        &nbsp;<span class="js-modal-title-add">Upload Course</span>
                    </h4>
            </div>
            <form class="form-horizontal js-course-upload-form" >

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12 col-md-12 col-sm-12">
                            <div id="new-course-list-uploader-manual-trigger"></div>
                            <code>.csv, .xls, .xlsx are supported.</code>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 js-errors">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('lms.admin.course.course_create_upload_template')
