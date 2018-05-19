<!-- Modal -->
<div class="modal" id="edit-universe-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-o"></i>
                        <span class="js-modal-title-edit hidden">{{ __('lms.page.university.form.edit_title') }}</span>
                        <span class="js-modal-title-add">{{ __('lms.page.university.form.add_title') }}</span>
                    </h4>
            </div>
            <form class="form-horizontal js-edit-course-form" >

                <div class="modal-body">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <input type="hidden" name="id" class="js-course-id" value=""/>

                            <div class="form-group">
                                <label for="js-edit-university-name"
                                       class="col-md-3 col-lg-3 control-label">{{ __('lms.page.university.form.name') }}</label>
                                <div class="col-md-9 col-lg-9">
                                    <input id="js-edit-university-name" type="text"
                                           class="js-edit-university-name form-control" name="course_id"
                                           value="" required placeholder="{{ __('lms.page.university.form.name') }}"
                                           maxlength="100">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 js-errors">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-edit-university" data-id="" class="btn btn-primary" data-type="update">
                        <i class="fa fa-plus"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>