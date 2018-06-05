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

                    <div class="js-course-form">

                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">

                                <div class="form-group js-error-block js-course_code-block">
                                    <label for="js-edit-course-code" class="col-md-2 control-label">{{ __('lms.page.course.form.course_id') }}</label>
                                    <div class="col-md-10">
                                        <input id="js-edit-course-code" type="text" class="js-edit-course-code form-control" name="course_code"
                                               value="" required placeholder="{{ __('lms.page.course.form.course_id') }}" maxlength="100">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-sm-12 col-md-6">

                                <div class="form-group js-error-block js-course_id-block">
                                    <label for="js-edit-course-type" class="col-md-3 control-label">{{ __('lms.page.course.form.course_type') }}</label>
                                    <div class="col-md-9">
                                        <select id="js-edit-course-type" class="js-edit-course-type form-control" name="course_type">
                                            <option value="Presencial">Presencial</option>
                                            <option value="Virtual">Virtual</option>
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">

                                <div class="form-group js-error-block js-course_id-block">
                                    <label for="js-edit-course-modality" class="col-md-3 control-label">{{ __('lms.page.course.form.course_modality') }}</label>
                                    <div class="col-md-9">
                                        <select id="js-edit-course-type" class="js-edit-course-modality form-control" name="course_modality">
                                            <option value="Test 1">Test 1</option>
                                            <option value="Test 2">Test 2</option>
                                        </select>
                                        <div class="help-block"></div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-12 col-sm-12 col-md-12">

                                <div class="form-group js-error-block js-university-block">
                                    <label for="js-edit-course-university" class="col-md-2 control-label">{{ __('lms.page.course.form.university') }}</label>
                                    <div class="col-md-10">
                                        <select id="js-edit-course-university" name="university" style="width: 100%"
                                                class="js-edit-course-university js-select-university form-control js-lms-select2" >
                                        </select>
                                        <div class="help-block"></div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">

                                <div class="form-group js-error-block js-short_name-block">

                                    <label for="js-edit-course-short_name" class="col-md-2 control-label">{{ __('lms.page.course.form.short_name') }}</label>
                                    <div class="col-md-10">
                                        <input id="js-edit-course-short_name" type="text"
                                               class="js-edit-course-short_name form-control" name="short_name"
                                               maxlength="100" value=""
                                               placeholder={{ __('lms.page.course.form.short_name') }}/>
                                        <div class="help-block"></div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-sm-12 col-md-6">

                                <div class="form-group js-error-block js-start_date-block">

                                    <label for="js-edit-course-start_date"
                                    class="col-md-3 control-label">{{ __('lms.page.course.form.start_date') }}</label>
                                    <div class="col-md-9">
                                        <input id="js-edit-course-start_date" type="text"
                                               class="js-edit-course-start_date js-datepicker form-control" name="Start Date"
                                               required placeholder={{ __('lms.page.course.form.start_date') }}/>
                                        <div class="help-block"></div>
                                    </div>


                                </div>

                            </div>

                            <div class="col-lg-6 col-sm-12 col-md-6">

                                <div class="form-group js-error-block js-end_date-block">
                                    <label for="js-edit-course-end_date"
                                           class="col-md-3 control-label">{{ __('lms.page.course.form.end_date') }}</label>
                                    <div class="col-md-9">
                                        <input id="js-edit-course-end_date" type="text"
                                               class="js-edit-course-end_date js-datepicker form-control" name="end_date"
                                               required placeholder={{ __('lms.page.course.form.end_date') }}/>
                                        <div class="help-block"></div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-md-6">

                                <div class="form-group js-error-block js-hours-block">

                                    <label for="js-edit-course-hours" class="col-md-3 control-label"
                                    >{{ __('lms.page.course.form.hours') }}</label>
                                    <div class="col-md-9">
                                        <input id="js-edit-course-hours" type="number"
                                               class="js-edit-course-hours form-control" name="hours"
                                               value="" required placeholder={{ __('lms.page.course.form.hours') }} />
                                        <div class="help-block"></div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-6 col-sm-12 col-md-6">

                                <div class="form-group js-error-block js-quota-block">
                                    <label for="js-edit-course-quota" class="col-md-3 control-label"
                                    >{{ __('lms.page.course.form.quota') }}</label>
                                    <div class="col-md-9">
                                        <input id="js-edit-course-quota" type="number"
                                               class="js-edit-course-quota form-control" name="quota"
                                               value="" required placeholder={{ __('lms.page.course.form.quota') }} />
                                        <div class="help-block"></div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">

                                <div class="form-group js-error-block js-course_comment-block">

                                    <label for="js-edit-course-comment"
                                           class="col-md-2 control-label">{{ __('lms.page.course.form.comment') }}</label>
                                    <div class="col-md-10">
                                        <input id="js-edit-course-comment" type="text"
                                               class="js-edit-course-comment form-control" name="course_comment"
                                               value="" required placeholder={{ __('lms.page.course.form.comment') }} />
                                            <div class="help-block"></div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">

                                <div class="form-group js-error-block js-course_description-block">
                                    <label for="js-edit-course-description"
                                           class="col-md-2 control-label">{{ __('lms.page.course.form.description') }}</label>
                                    <div    class="col-md-10">
                                        <textarea id="js-edit-course-description" type="text"
                                                  class="js-edit-course-description form-control" name="course_description"
                                                  placeholder="{{ __('lms.page.course.form.description') }}" ></textarea>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">

                                <div class="form-group js-error-block js-course_video-block">

                                    <label for="js-edit-course-video"
                                           class="col-md-2 control-label">{{ __('lms.page.course.form.video') }}</label>
                                    <div    class="col-md-10">
                                        <textarea id="js-edit-course-video"
                                                  class="js-edit-course-video form-control" name="course_video"
                                                  placeholder="{{ __('lms.page.course.form.video') }}" ></textarea>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <div class="form-group js-error-block js-video_type-block">
                                    <label for="js-edit-course-video_type"
                                           class="col-md-3 control-label">{{ __('lms.page.course.form.video_type') }}</label>
                                    <div    class="col-md-9">
                                        <select id="js-edit-course-video_type" name="video_type" style="width: 100%"
                                                class="js-edit-course-video_type js-select-video_type form-control js-lms-select2" >
                                            <option value="youtube">Youtube</option>
                                            <option value="Vimeo">Vimeo</option>
                                            <option value="Upload">Upload</option>
                                        </select>
                                        <div class="help-block"></div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-6 col-sm-12 col-md-6">

                                <div class="form-group js-error-block js-video_embed_code-block">
                                    <label for="js-edit-course-video_embed_code"
                                           class="col-md-3 control-label">{{ __('lms.page.course.form.video_embed') }}</label>
                                    <div    class="col-md-9">
                                        <input id="js-edit-course-video_embed_code"
                                               class="js-edit-course-video_embed_code form-control" name="video_embed_code"
                                               value="" required placeholder="{{ __('lms.page.course.form.video_embed') }}" />
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{--<div class="row">--}}
                            {{--<div class="col-lg-12 col-sm-12 col-md-12">--}}

                                {{--<div class="form-group js-error-block js-course_terms_condition-block">--}}
                                    {{--<label for="js-edit-course-terms_condition"--}}
                                           {{--class="col-md-2 control-label">{{ __('lms.page.course.form.terms_condition') }}</label>--}}
                                    {{--<div    class="col-md-10">--}}
                                        {{--<textarea id="js-edit-course-terms_condition"--}}
                                                  {{--class="js-edit-course-terms_condition form-control" name="course_terms_condition"--}}
                                                  {{--placeholder="{{ __('lms.page.course.form.terms_condition') }}" ></textarea>--}}
                                        {{--<div class="help-block"></div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">

                                <div class="form-group js-error-block js-course_data_update-block">
                                    <label for="js-edit-course-data_update"
                                           class="col-md-2 control-label">{{ __('lms.page.course.form.data_update') }}</label>
                                    <div    class="col-md-10">
                                        <textarea id="js-edit-course-data_update"
                                                  class="js-edit-course-data_update form-control" name="course_data_update"
                                                  placeholder="{{ __('lms.page.course.form.data_update') }}" ></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <input type="hidden" name="id" class="js-course-id" value=""/>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-10">
                                        <i class="fa fa-info-circle"></i> <code>{{ __('lms.page.course.form.inspection_file_message')  }}</code>
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>

                    <div class="row js-course-inspection-form hidden">

                        <div class="col-md-12 col-md-12 col-sm-12">

                            <code>Upload Inspection Form (Letter of Registration)</code>
                            <div id="course-inspection-form-uploader-manual-trigger"></div>

                            <code>Upload Terms and Condition</code>
                            <div id="course-terms_condition-uploader-manual-trigger"></div>

                            <code>Upload Letter of Registration</code>
                            <div id="course-letter_of_registration-uploader-manual-trigger"></div>

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
@include('lms.admin.course.templates.terms_condition_upload_template')
@include('lms.admin.course.templates.letter_of_registration_template')