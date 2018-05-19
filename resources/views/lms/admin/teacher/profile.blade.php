@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ $teacher->user->name }}</h1>
@stop

@section('content')

    <div class="row" id="page_teacher_profile">

        <div class="col-lg-7 col-md-7 col-sm-12">

            <div class="box box-primary">

                <div class="box-body box-profile">

                    <div class="row">

                        <div class="col-lg-3">
                            <img class="img-responsive img-thumbnail"
                                 src="https://placeimg.com/640/480/people">
                                <h3 class="profile-username text-center">{{ $teacher->user->name }}</h3>
                                <p class="text-muted text-center">{{ $teacher->function }}</p>

                        </div>
                        <div class="col-lg-9">

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <i class="fa fa-id-card"></i> <b>Socail ID</b> <span class="pull-right">{{ $teacher->social_id}}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-qrcode"></i>&nbsp;<b>AMIE</b> <span class="pull-right">{{ $teacher->amie}}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-phone"></i>&nbsp;<b>Telephone</b> <span class="pull-right">{{ $teacher->telephone}}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-mobile"></i>&nbsp;<b>Cell</b> <span class="pull-right">{{ $teacher->mobile}}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-envelope"></i>&nbsp;<b>Login Email</b> <span class="pull-right">{{ $teacher->user->email}}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-envelope-o"></i>&nbsp;<b>Institute Email</b> <span class="pull-right">{{ $teacher->inst_email }}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa {{ $teacher->gender == 'F' ? 'fa-female' : 'fa-male' }}"></i>&nbsp;
                                    <b> Gender</b> <span class="pull-right">{{ $teacher->gender == 'F' ? "Female" : "Male" }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Date of Birth</b> <span class="pull-right">&nbsp;{{ date('jS M, Y', strtotime($teacher->date_of_birth)) }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Disability</b> <sapn class="pull-right">&nbsp;{{ $teacher->disability }}</sapn>
                                </li>
                                <li class="list-group-item">
                                    <b>Ethnic Group</b> <span class="pull-right">{{ $teacher->ethnic_group }}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-envelope-o"></i>&nbsp<b>Note</b> <span class="pull-right">
                                        User was imported by {{ $teacher->createdBy->name }} here at {{ $teacher->created_at }}</span>
                                </li>
                            </ul>

                            {{--<a href="#" class="btn btn-primary btn-block"><b>Edit</b></a>--}}

                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>

        </div>

        <div class="col-lg-5 col-md-5 col-sm-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-building margin-r-5"></i> Institute</strong>

                    <p class="text-muted">{{ $teacher->university_name }}<br/>
                    Work Area: {{ $teacher->work_area }}<br/>
                    Category: {{ $teacher->category }}<br/>
                    Start Date: {{ $teacher->join_date }}<br/>
                    End Date: {{ $teacher->end_date }}<br/>
                    </p>

                    <hr>
                    <strong><i class="fa fa-bolt margin-r-5"></i> Reason</strong>
                    <p class="text-muted">Reason Type: {{ $teacher->reason_type }}<br/>
                        Action: {{ $teacher->action_type }}<br/>
                        Description: {{ $teacher->action_description }}<br/>
                        Speciality: {{ $teacher->speciality }}<br/>
                    </p>
                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                    <p class="text-muted">{{ $teacher->parroquia }}, {{ $teacher->canton }}, {{ $teacher->province }}</p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> District</strong>

                    <p class="text-muted">{{ $teacher->district }} [{{ $teacher->district_code }}]. Zone: {{ $teacher->zone }}</p>

                    {{--<hr>--}}

                    {{--<strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>--}}

                    {{--<p>--}}
                        {{--<span class="label label-danger">UI Design</span>--}}
                        {{--<span class="label label-success">Coding</span>--}}
                        {{--<span class="label label-info">Javascript</span>--}}
                        {{--<span class="label label-warning">PHP</span>--}}
                        {{--<span class="label label-primary">Node.js</span>--}}
                    {{--</p>--}}

                    {{--<hr>--}}

                    {{--<strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>--}}

                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>--}}
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-ls-12 col-md-12 col-sm-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.page.teacher_profile.index.table_header') }}</h3>
                    </div>
                    <div class="pull-right">
                        {{--<div class="btn-group">--}}
                            {{--<button class="btn btn-sm btn-success" id="btn-import-teachers" type="submit">--}}
                                {{--<i class="fa fa-upload"></i> {{ __('lms.elements.button.upload') }}</button>--}}
                            {{--<button class="btn btn-sm btn-primary" id="btn-create-canton">--}}
                                {{--<i class="fa fa-plus"></i> {{ __('lms.elements.button.create') }}</button>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="box-body">

                    <table class="table table-bordered table-responsive" id="teacher-table">
                        <thead>
                        <tr>
                            {{--<th>{{ __('lms.page.teacher.table.id') }}</th>--}}
                            <th>{{ __('lms.page.teacher_profile.table.course_type') }}</th>
                            <th>{{ __('lms.page.teacher_profile.table.course_name') }}</th>
                            <th>{{ __('lms.page.teacher_profile.table.institute') }}</th>
                            <th>{{ __('lms.page.teacher_profile.table.modality') }}</th>
                            <th>{{ __('lms.page.teacher_profile.table.hours') }}</th>
                            <th>{{ __('lms.page.teacher_profile.table.start_date') }}</th>
                            <th>{{ __('lms.page.teacher_profile.table.end_date') }}</th>
                            <th>{{ __('lms.page.teacher_profile.table.status') }}</th>
                            <th>{{ __('lms.page.teacher_profile.table.certificate') }}</th>
                        </tr>
                        </thead>
                        <tfoot></tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>

{{--    @include('lms.admin.location.canton.edit_modal')--}}
    {{--@include('lms.admin.teacher.upload_form')--}}
    {{--@include('lms.admin.parts.modal_delete')--}}

@stop