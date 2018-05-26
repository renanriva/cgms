@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    {{--<h1>{{ $title }}</h1>--}}
{{--<h1>{{ $teacher->user->name }}</h1>--}}
    <h1>
        <span class="js-modal-title-edit hidden">{{ __('lms.page.teacher.form.edit_title') }}</span>
        <span class="js-modal-title-add">{{ __('lms.page.teacher.form.add_title') }}</span>
    </h1>

@stop

@section('content')

    <form class="form-horizontal teacher-form" role="form" method="post" action="/admin/teachers">

        <div class="row">

            <div class="col-md-6 col-lg-6 ">

                <div class="box box-primary">

                    <div class="box-header"><h3 class="box-title">Personal info</h3></div>

                    <div class="box-body">

                        <div class="form-group">
                            <label for="teacher-first-name" class="col-md-2 control-label">First Name</label>
                            <div class="col-md-4">
                                <input id="teacher-first-name" type="text" class="form-control" name="first_name"
                                       value="" required placeholder="First Name" maxlength="100">
                            </div>

                            <label for="teacher-last-name" class="col-md-2 control-label">Last Name</label>
                            <div class="col-md-4">
                                <input id="teacher-last-name" type="text" class="form-control" name="last_name"
                                       value="" required placeholder="Last Name" maxlength="100">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="teacher-social-id" class="col-md-2 control-label">Social Id</label>
                            <div class="col-md-4">
                                <input id="teacher-social-id" type="text" class="form-control" name="social_id"
                                       value="" required placeholder="Social Id" maxlength="100">
                            </div>

                            <label for="teacher-cc" class="col-md-2 control-label">CC</label>
                            <div class="col-md-4">
                                <input id="teacher-cc" type="text" class=" form-control" name="cc"
                                       value="" required placeholder="CC" maxlength="100">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="teacher-email" class="col-md-2 control-label">Email</label>
                            <div class="col-md-6">
                                <input id="teacher-email" type="email" class="js-edit-canton-name form-control" name="email"
                                       value="" required placeholder="Email" maxlength="100">
                                <code>This email will be used as login email address.</code>

                            </div>
                        </div>

                        <div class="form-group">

                            <label for="teacher-telephone" class="col-md-2 control-label">Telephone</label>
                            <div class="col-md-4">
                                <input id="teacher-telephone" type="text" class=" form-control" name="telephone"
                                       value="" required placeholder="Telephone" maxlength="100">
                            </div>
                            <label for="teacher-mobile" class="col-md-2 control-label">Mobile</label>
                            <div class="col-md-4">
                                <input id="teacher-mobile" type="text" class=" form-control" name="mobile"
                                       value="" required placeholder="Mobile" maxlength="100">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-6 col-lg-6">

                <div class="box box-primary">

                    <div class="box-header"><h3 class="box-title">Profile Photo</h3></div>
                    <div class="box-body">

                        <div class="form-group">

                            <label for="js-edit-canton-name" class="col-md-2 control-label">Photo</label>
                            <div class="col-md-4">

                                <div class="text-center">
                                    <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
                                    <h6>Upload a different photo...</h6>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <input type="file" class="form-control">

                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="Gender">Gender</label>
                            <div class="col-md-4">
                                <label class="radio-inline" for="Gender-0">
                                    <input type="radio" name="gender" id="Gender-0" value="1" checked="checked">
                                    Male
                                </label>
                                <label class="radio-inline" for="Gender-1">
                                    <input type="radio" name="Gender" id="Gender-1" value="2">
                                    Female
                                </label>
                            </div>
                            <label for="teacher-dob" class="col-md-2 control-label">Date of Birth</label>
                            <div class="col-md-4">
                                <input id="teacher-dob" type="text" class="js-datepicker form-control" name="date_of_birth"
                                       value="" required placeholder="Date of Birth" maxlength="100">
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

                    <div class="form-group">

                        <label for="teacher-university" class="col-md-2 control-label">University</label>
                        <div class="col-md-10">
                            <input id="teacher-university" type="text" class="form-control" name="university"
                                   value="" required placeholder="University" maxlength="100">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="teacher-join_date" class="col-md-2 control-label">Join Date</label>
                        <div class="col-md-4">
                            <input id="teacher-join_date" type="text" class="js-datepicker form-control" name="join_date"
                                   value="" required placeholder="Join Date" maxlength="100">
                        </div>
                        <label for="teacher-end_date" class="col-md-2 control-label">End Date</label>
                        <div class="col-md-4">
                            <input id="teacher-end_date" type="text" class="js-datepicker form-control" name="end_date"
                                   value="" required placeholder="End Date" maxlength="100">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="teacher-amie" class="col-md-2 control-label">AMIE</label>
                        <div class="col-md-6">
                            <input id="teacher-amie" type="text" class="form-control" name="amie"
                                   value="" required placeholder="AMIE" maxlength="10">
                        </div>
                    </div>
                </div>
            </div>

        </div>

            <div class="col-lg-6">

            <div class="box box-info">

                <div class="box-header"><h3 class="box-title">Work Details</h3></div>

                <div class="box-body">

                    <div class="form-group">

                        <label for="teacher-inst-email" class="col-md-2 control-label">Institute Email</label>
                        <div class="col-md-4">
                            <input id="teacher-inst-email" type="email" class="form-control" name="inst_email"
                                   value="" required placeholder="Institute Email" maxlength="100">
                        </div>

                        <label for="teacher-work_area" class="col-md-2 control-label">Work Area</label>
                        <div class="col-md-4">
                            <input id="teacher-work_area" type="text" class="form-control" name="work_area"
                                   value="" required placeholder="Work Area" maxlength="100">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="teacher-function" class="col-md-2 control-label">Function</label>
                        <div class="col-md-4">
                            <input id="teacher-function" type="text" class=" form-control" name="teacher_function"
                                   value="" required placeholder="Function" maxlength="100">
                        </div>

                        <label for="teacher-category" class="col-md-2 control-label">Category</label>
                        <div class="col-md-4">
                            <input id="teacher-category" type="text" class="form-control" name="category"
                                   value="" required placeholder="Category" maxlength="100">
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
                        <div class="form-group">
                            <label for="province" class="col-md-2 control-label">Province</label>
                            <div class="col-md-4">
                                <select id="province" class="form-control js-province" name="province">
                                </select>

                            </div>

                            <label for="canton" class="col-md-2 control-label">Canton</label>
                            <div class="col-md-4">
                                <select id="canton" class="form-control js-canton" name="canton"></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="parroquea" class="col-md-2 control-label">Parroquea</label>
                            <div class="col-md-4">
                                <input id="parroquea" type="text" class="form-control" name="parroquea"
                                       value="" required placeholder="Parroquea" maxlength="50">
                            </div>

                            <label for="Zone" class="col-md-2 control-label">Zone</label>
                            <div class="col-md-4">
                                <select id="zone" class="form-control" name="zone">
                                    <option value="Zona 1">{{ __('lms.words.zone') }} 1</option>
                                    <option value="Zona 2">{{ __('lms.words.zone') }} 2</option>
                                    <option value="Zona 3">{{ __('lms.words.zone') }} 3</option>
                                    <option value="Zona 4">{{ __('lms.words.zone') }} 4</option>
                                    <option value="Zona 5">{{ __('lms.words.zone') }} 5</option>
                                    <option value="Zona 6">{{ __('lms.words.zone') }} 6</option>
                                    <option value="Zona 7">{{ __('lms.words.zone') }} 7</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="district" class="col-md-2 control-label">District</label>
                            <div class="col-md-4">
                                <input id="district" type="text" class="form-control" name="district"
                                       value="" required placeholder="District" maxlength="50">
                            </div>

                            <label for="dost_code" class="col-md-2 control-label">District Code</label>
                            <div class="col-md-4">
                                <input id="dist_code" type="text" class="form-control" name="dist_code"
                                       value="" required placeholder="District Code" maxlength="10">
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-6">

                <div class="box box-info">

                    <div class="box-header"><h3 class="box-title">Other info</h3></div>

                    <div class="box-body">

                        <div class="form-group">
                            <label for="reason_type" class="col-md-2 control-label">Reason Type</label>
                            <div class="col-md-4">
                                <input id="reason_type" type="text" class=" form-control" name="reason_type"
                                       value="" required placeholder="Reason Type" maxlength="50">
                            </div>
                            <label for="speciality" class="col-md-2 control-label">Speciality</label>
                            <div class="col-md-4">
                                <input id="speciality" type="text" class="form-control" name="speciality"
                                       value="" required placeholder="Speciality" maxlength="50">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="action_type" class="col-md-2 control-label">Action Type</label>
                            <div class="col-md-4">
                                <input id="action_type" type="text" class=" form-control" name="action_type"
                                       value="" required placeholder="Action Type" maxlength="50">
                            </div>

                            <label for="action_description" class="col-md-2 control-label">Action Description</label>
                            <div class="col-md-4">
                                <input id="action_description" type="text" class=" form-control" name="action_description"
                                       value="" required placeholder="Action Description" maxlength="50">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="disability" class="col-md-2 control-label">Disability</label>
                            <div class="col-md-4">
                                <input id="disability" type="text" class="form-control" name="disability"
                                       value="" required placeholder="Disability" maxlength="50">
                            </div>

                            <label for="ethnic_group" class="col-md-2 control-label">Ethnic Group</label>
                            <div class="col-md-4">
                                <input id="ethnic_group" type="text" class="form-control" name="ethnic_group"
                                       value="" required placeholder="Ethnic Group" maxlength="50">
                            </div>
                        </div>

                    </div>
                </div>


            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-block btn-info">Submit</button>
                </div>
            </div>
        </div>

    </form>


@stop