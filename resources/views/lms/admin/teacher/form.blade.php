@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    {{--<h1>{{ $title }}</h1>--}}
{{--<h1>{{ $teacher->user->name }}</h1>--}}
    <h1> <i class="fa fa-user-plus"></i>
        <span class="js-modal-title-edit hidden">{{ __('lms.page.teacher.form.edit_title') }}</span>
        <span class="js-modal-title-add">{{ __('lms.page.teacher.form.add_title') }}</span>
    </h1>

@stop

@section('content')

    <form class="form-horizontal teacher-form" role="form">

        <div class="row">

            <div class="col-md-6 col-lg-6 ">

                <div class="box box-primary">

                    <div class="box-header"><h3 class="box-title">Personal info</h3></div>

                    <div class="box-body">

                        <div class="row">

                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-first_name-block">
                                    <label for="teacher-first-name" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input id="teacher-first-name" type="text" class="form-control" name="first_name"
                                               value="" required placeholder="First Name" maxlength="100">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-last_name-block">

                                    <label for="teacher-last-name" class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input id="teacher-last-name" type="text" class="form-control" name="last_name"
                                               value="" required placeholder="Last Name" maxlength="100">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-12 col-lg-6 col-md-6">
                                <div class="form-group js-error-block js-social_id-block">
                                    <label for="teacher-social-id" class="col-md-3 control-label">Social Id</label>
                                    <div class="col-md-9">
                                        <input id="teacher-social-id" type="text" class="form-control" name="social_id"
                                               value="" required placeholder="Social Id" maxlength="100">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-6 col-md-6">
                                <div class="form-group js-error-block js-cc-block">
                                    <label for="teacher-cc" class="col-md-3 control-label">CC</label>
                                    <div class="col-md-9">
                                        <input id="teacher-cc" type="text" class=" form-control" name="cc"
                                               value="" required placeholder="CC" maxlength="100">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-email-block">
                                    <label for="teacher-email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input id="teacher-email" type="email" class="js-edit-canton-name form-control" name="email"
                                               value="" required placeholder="Email" maxlength="100">
                                            <div class="help-block"></div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block has-warning">
                                    <div class="col-md-9 col-md-offset-3">
                                        <span class="help-block"> <i class="fa fa-caret-left"></i>
                                            This email will be used as login email address.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group js-error-block js-telephone-block">
                                    <label for="teacher-telephone" class="col-md-3 control-label">Telephone</label>
                                    <div class="col-md-9">
                                        <input id="teacher-telephone" type="text" class=" form-control" name="telephone"
                                               value="" required placeholder="Telephone" maxlength="100">
                                        <div class="help-block"></div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group js-error-block js-mobile-block">
                                    <label for="teacher-mobile" class="col-md-3 control-label">Mobile</label>
                                    <div class="col-md-9">
                                        <input id="teacher-mobile" type="text" class=" form-control" name="mobile"
                                               value="" required placeholder="Mobile" maxlength="100">
                                        <div class="help-block"></div>

                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>

            </div>

            <div class="col-md-6 col-lg-6">

                <div class="box box-primary">

                    <div class="box-header"><h3 class="box-title">Profile Photo</h3></div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group">

                                    <label for="" class="col-md-3 control-label">Photo</label>
                                    <div class="col-md-9">
                                        {{--<div class="text-center">--}}
                                        {{--<img src="//placehold.it/100" class="avatar img-circle" alt="avatar">--}}
                                        {{--<h6>Upload a different photo...</h6>--}}
                                        {{--</div>--}}

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                        <input type="file" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-5 col-sm-12">

                                <div class="form-group js-error-block js-gender-block">
                                    <label class="col-md-3 control-label" for="Gender">Gender</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline" for="Gender-0">
                                            <input type="radio" name="gender" id="Gender-0" value="m" checked="checked">
                                            Male
                                        </label>
                                        <label class="radio-inline" for="Gender-1">
                                            <input type="radio" name="Gender" id="Gender-1" value="f">
                                            Female
                                        </label>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-sm-12">

                                <div class="form-group js-error-block js-date_of_birth-block">
                                    <label for="teacher-dob" class="col-md-3 control-label">Date of Birth</label>
                                    <div class="col-md-9">
                                        <input id="teacher-dob" type="text" class="js-datepicker form-control" name="date_of_birth"
                                               value="" required placeholder="Date of Birth" maxlength="20">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-6">

            <div class="box box-info">

                <div class="box-header"><h3 class="box-title">University info</h3></div>

                <div class="box-body">

                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-12">

                            <div class="form-group">
                                <label for="teacher-university" class="col-md-3 col-lg-3 control-label">University</label>
                            </div>

                        </div>
                        <div class="col-lg-10 col-md-12 col-sm-12">

                            <div class="form-group js-error-block js-university-block">
                                <div class="col-lg-12">
                                    <input id="teacher-university" type="text" class="form-control" name="university"
                                           value="" required placeholder="University" maxlength="100">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group js-error-block js-join_date_block">
                                <label for="teacher-join_date" class="col-md-3 control-label">Join Date</label>
                                <div class="col-md-9">
                                    <input id="teacher-join_date" type="text" class="js-datepicker form-control" name="join_date"
                                           value="" required placeholder="Join Date" maxlength="10">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group js-error-block js-end_date-block">
                                <label for="teacher-end_date" class="col-md-3 control-label">End Date</label>
                                <div class="col-md-9">
                                    <input id="teacher-end_date" type="text" class="js-datepicker form-control" name="end_date"
                                           value="" required placeholder="End Date" maxlength="10">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">

                            <div class="form-group js-error-block js-amie-block">
                                <label for="teacher-amie" class="col-md-3 control-label">AMIE</label>
                                <div class="col-md-9">
                                    <input id="teacher-amie" type="text" class="form-control" name="amie"
                                           value="" required placeholder="AMIE" maxlength="10">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">

                        </div>

                    </div>

                </div>
            </div>

        </div>

            <div class="col-lg-6">

            <div class="box box-info">

                <div class="box-header"><h3 class="box-title">Work Details</h3></div>

                <div class="box-body">

                    <div class="row">

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group js-error-block js-inst_email-block">
                                <label for="teacher-inst-email" class="col-md-3 control-label">Institute Email</label>
                                <div class="col-md-9">
                                    <input id="teacher-inst-email" type="email" class="form-control" name="inst_email"
                                           value="" required placeholder="Institute Email" maxlength="100">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group js-error-block js-work_area-block">
                                <label for="teacher-work_area" class="col-md-3 control-label">Work Area</label>
                                <div class="col-md-9">
                                    <input id="teacher-work_area" type="text" class="form-control" name="work_area"
                                           value="" required placeholder="Work Area" maxlength="100">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group js-error-block js-teacher_function-block">
                                <label for="teacher-function" class="col-md-3 control-label">Function</label>
                                <div class="col-md-9">
                                    <input id="teacher-function" type="text" class=" form-control" name="teacher_function"
                                           value="" required placeholder="Function" maxlength="100">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group js-error-block js-category-block">
                                <label for="teacher-category" class="col-md-3 control-label">Category</label>
                                <div class="col-md-9">
                                    <input id="teacher-category" type="text" class="form-control" name="category"
                                           value="" required placeholder="Category" maxlength="100">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        </div>


        <div class="row">

            <div class="col-lg-6">

                <div class="box box-info">

                    <div class="box-header"><h3 class="box-title">Location info</h3></div>

                    <div class="box-body">

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-province-block">
                                    <label for="province" class="col-md-3 control-label">Province</label>
                                    <div class="col-md-9">
                                        <select id="province" class="form-control js-province" name="province"></select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-canton-block">
                                    <label for="canton" class="col-md-3 control-label">Canton</label>
                                    <div class="col-md-9">
                                        <select id="canton" class="form-control js-canton" name="canton"></select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-parroquia-block">
                                    <label for="Parroquia" class="col-md-3 control-label">Parroquia</label>
                                    <div class="col-md-9">
                                        <input id="Parroquia" type="text" class="form-control" name="parroquia"
                                               value="" required placeholder="Parroquia" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-zone-block">

                                    <label for="Zone" class="col-md-3 control-label">Zone</label>
                                    <div class="col-md-9">
                                        <select id="zone" class="form-control js-zone" name="zone">
                                            <option value="Zona 1">{{ __('lms.words.zone') }} 1</option>
                                            <option value="Zona 2">{{ __('lms.words.zone') }} 2</option>
                                            <option value="Zona 3">{{ __('lms.words.zone') }} 3</option>
                                            <option value="Zona 4">{{ __('lms.words.zone') }} 4</option>
                                            <option value="Zona 5">{{ __('lms.words.zone') }} 5</option>
                                            <option value="Zona 6">{{ __('lms.words.zone') }} 6</option>
                                            <option value="Zona 7">{{ __('lms.words.zone') }} 7</option>
                                        </select>
                                        <div class="help-block"></div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group js-error-block js-district-block">
                                    <label for="district" class="col-md-3 control-label">District</label>
                                    <div class="col-md-9">
                                        <input id="district" type="text" class="form-control" name="district"
                                               value="" required placeholder="District" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-dist_code-block">
                                    <label for="dist_code" class="col-md-3 control-label">District Code</label>
                                    <div class="col-md-9">
                                        <input id="dist_code" type="text" class="form-control" name="dist_code"
                                               value="" required placeholder="District Code" maxlength="10">                                        <div class="help-block"></div>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-6">

                <div class="box box-info">

                    <div class="box-header"><h3 class="box-title">Other info</h3></div>

                    <div class="box-body">

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-reason_type-block">
                                    <label for="reason_type" class="col-md-3 control-label">Reason Type</label>
                                    <div class="col-md-9">
                                        <input id="reason_type" type="text" class=" form-control" name="reason_type"
                                               value="" required placeholder="Reason Type" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-action_type-block">
                                    <label for="speciality" class="col-md-3 control-label">Speciality</label>
                                    <div class="col-md-9">
                                        <input id="speciality" type="text" class="form-control" name="speciality"
                                               value="" required placeholder="Speciality" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-action_type-block">
                                    <label for="action_type" class="col-md-3 control-label">Action Type</label>
                                    <div class="col-md-9">
                                        <input id="action_type" type="text" class=" form-control" name="action_type"
                                               value="" required placeholder="Action Type" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-action_description-block">
                                    <label for="action_description" class="col-md-3 control-label">Action Description</label>
                                    <div class="col-md-9">
                                        <input id="action_description" type="text" class=" form-control" name="action_description"
                                               value="" required placeholder="Action Description" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-disability-block">
                                    <label for="disability" class="col-md-3 control-label">Disability</label>
                                    <div class="col-md-9">
                                        <input id="disability" type="text" class="form-control" name="disability"
                                               value="" required placeholder="Disability" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">

                                <div class="form-group js-error-block js-ethnic_group-block">
                                    <label for="ethnic_group" class="col-md-3 control-label">Ethnic Group</label>
                                    <div class="col-md-9">
                                        <input id="ethnic_group" type="text" class="form-control" name="ethnic_group"
                                               value="" required placeholder="Ethnic Group" maxlength="50">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-4">
                    <button type="button" class="btn btn-submit-teacher btn-block btn-info" data-type="insert"
                    data-id=""><i class="fa fa-upload"></i> Submit</button>
                </div>
            </div>
        </div>

    </form>


@stop