<!-- Modal -->
<div class="modal" id="edit-course-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-o"></i>
                        <span class="js-modal-title-edit hidden">{{ __('lms.page.course.form.edit_title') }}</span>
                        <span class="js-modal-title-add">{{ __('lms.page.course.form.add_title') }}</span>
                    </h4>
            </div>
            <form class="form-horizontal js-edit-course-form" >

                <div class="modal-body">

                    <div class="row js-course-form">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <input type="hidden" name="id" class="js-course-id" value=""/>

                            <div class="form-group">
                                <label for="edit-course-id" class="col-md-2 control-label">{{ __('lms.page.course.form.course_id') }}</label>
                                <div class="col-md-4">
                                    <input id="edit-course-id" type="text" class="js-edit-course-id form-control" name="course_id"
                                           value="" required placeholder="{{ __('lms.page.course.form.course_id') }}" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-course-type" class="col-md-2 control-label">{{ __('lms.page.course.form.course_type') }}</label>
                                <div class="col-md-4">
                                    <select id="js-edit-course-type" class="js-edit-course-type form-control" name="course_type">
                                        <option value="Presencial">Presencial</option>
                                        <option value="Virtual">Virtual</option>
                                    </select>
                                </div>
                                <label for="js-edit-course-modality" class="col-md-2 control-label">{{ __('lms.page.course.form.course_modality') }}</label>
                                <div class="col-md-4">
                                    <select id="js-edit-course-type" class="js-edit-course-modality form-control" name="course_modality">
                                        <option value="Test 1">Test 1</option>
                                        <option value="Test 2">Test 2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-course-university" class="col-md-2 control-label">{{ __('lms.page.course.form.university') }}</label>
                                <div class="col-md-10">
                                    <select id="js-edit-course-university" name="university" style="width: 100%"
                                            class="js-edit-course-university js-select-university form-control js-lms-select2" >
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-course-short_name" class="col-md-2 control-label">{{ __('lms.page.course.form.short_name') }}</label>
                                <div class="col-md-10">
                                    <input id="js-edit-course-short_name" type="text" class="js-edit-course-short_name form-control" name="Short Name"
                                           maxlength="100" value="" required placeholder={{ __('lms.page.course.form.short_name') }}/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-course-start_date"
                                       class="col-md-2 control-label">{{ __('lms.page.course.form.start_date') }}</label>
                                <div class="col-md-4">
                                    <input id="js-edit-course-start_date" type="text" class="js-edit-course-start_date form-control" name="Start Date"
                                           required placeholder={{ __('lms.page.course.form.start_date') }}/>
                                </div>

                                <label for="js-edit-course-end_date"
                                       class="col-md-2 control-label">{{ __('lms.page.course.form.start_date') }}</label>
                                <div class="col-md-4">
                                    <input id="js-edit-course-end_date" type="text" class="js-edit-course-end_date form-control" name="End Date"
                                           required placeholder={{ __('lms.page.course.form.start_date') }}/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-course-hours" class="col-md-2 control-label">{{ __('lms.page.course.form.hours') }}</label>
                                <div class="col-md-4">
                                    <input id="js-edit-course-hours" type="number" class="js-edit-course-hours form-control" name="hours"
                                           value="" required placeholder={{ __('lms.page.course.form.hours') }} />
                                </div>
                                <label for="js-edit-course-quota" class="col-md-2 control-label">{{ __('lms.page.course.form.quota') }}</label>
                                <div class="col-md-4">
                                    <input id="js-edit-course-quota" type="number" class="js-edit-course-quota form-control" name="quota"
                                           value="" required placeholder={{ __('lms.page.course.form.quota') }} />
                                </div>
                            </div>

                            <div class="form-group">

                                <label for="js-edit-course-comment"
                                       class="col-md-2 control-label">{{ __('lms.page.course.form.comment') }}</label>
                                <div class="col-md-10">
                                    <input id="js-edit-course-comment" type="text"
                                           class="js-edit-course-comment form-control" name="course_comment"
                                           value="" required placeholder={{ __('lms.page.course.form.comment') }} />
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="js-edit-course-description"
                                       class="col-md-2 control-label">{{ __('lms.page.course.form.description') }}</label>
                                <div    class="col-md-10">
                                    <textarea id="js-edit-course-description" type="text"
                                              class="js-edit-course-description form-control" name="course_description"
                                               placeholder="{{ __('lms.page.course.form.description') }}" ></textarea>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="js-edit-course-video"
                                       class="col-md-2 control-label">{{ __('lms.page.course.form.video') }}</label>
                                <div    class="col-md-10">
                                    <textarea id="js-edit-course-video"
                                              class="js-edit-course-video form-control" name="course_video"
                                              placeholder="{{ __('lms.page.course.form.video') }}" ></textarea>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="js-edit-course-video_type"
                                       class="col-md-2 control-label">{{ __('lms.page.course.form.video_type') }}</label>
                                <div    class="col-md-4">
                                    <select id="js-edit-course-video_type" name="video_type" style="width: 100%"
                                            class="js-edit-course-video_type js-select-video_type form-control js-lms-select2" >
                                        <option value="youtube">Youtube</option>
                                        <option value="Vimeo">Vimeo</option>
                                        <option value="Upload">Upload</option>
                                    </select>
                                </div>

                                <label for="js-edit-course-video_embed_code"
                                       class="col-md-2 control-label">{{ __('lms.page.course.form.video_embed') }}</label>
                                <div    class="col-md-4">
                                    <input id="js-edit-course-video_embed_code"
                                           class="js-edit-course-video_embed_code form-control" name="video_embed_code"
                                           value="" required placeholder="{{ __('lms.page.course.form.video_embed') }}" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-course-terms_condition"
                                       class="col-md-2 control-label">{{ __('lms.page.course.form.terms_condition') }}</label>
                                <div    class="col-md-10">
                                    <textarea id="js-edit-course-terms_condition"
                                              class="js-edit-course-terms_condition form-control" name="course_terms_condition"
                                              placeholder="{{ __('lms.page.course.form.terms_condition') }}" ></textarea>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="js-edit-course-data_update"
                                       class="col-md-2 control-label">{{ __('lms.page.course.form.data_update') }}</label>
                                <div    class="col-md-10">
                                    <textarea id="js-edit-course-data_update"
                                              class="js-edit-course-data_update form-control" name="course_data_update"
                                              placeholder="{{ __('lms.page.course.form.data_update') }}" ></textarea>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-10">
                                    <i class="fa fa-info-circle"></i> <code>{{ __('lms.page.course.form.inspection_file_message')  }}</code>
                                </div>
                            </div>


                        </div>

                    </div>

                    <div class="row js-course-inspection-form hidden">

                        <div class="col-md-12 col-md-12 col-sm-12">

                            <div id="course-inspection-form-uploader-manual-trigger"></div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 js-errors">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-edit-course" data-id="" class="btn btn-primary" data-type="update">
                        <i class="fa fa-plus"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('lms.admin.teacher.template')