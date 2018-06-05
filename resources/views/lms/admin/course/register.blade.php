@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.page.register.index.page_header') }}</h1>
@stop

@section('content')

    <div class="row" id="page_register">


        <div class="col-lg-6 col-md-6 col-sm-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Course Details</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <p class=""><strong><i class="fa fa-man margin-r-5"></i> Short Name: </strong> {{ $course->short_name }}</p>

                    <hr>
                    <p class=""><strong><i class="fa fa-map-marker margin-r-5"></i> Course Code</strong> {{ $course->course_code }}</p>

                    <hr>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Hours</b> <a class="pull-right">{{ $course->hours }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Start Date</b> <a class="pull-right">{{ $course->start_date }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>End Date</b> <a class="pull-right">{{ $course->end_date }}</a>
                        </li>
                    </ul>

                </div>
                <!-- /.box-body -->
            </div>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-man margin-r-5"></i> Name</strong>

                    <p class="">{{ $teacher->user->name }}</p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Social Id</strong>

                    <p class="text-muted">{{ $teacher->social_id }}</p>

                    <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i> University</strong>

                    <p>{{ $teacher->work_area }}, {{ $teacher->university_name }}</p>

                </div>
                <!-- /.box-body -->
            </div>

        </div>

        <div class="col-lg-8 col-md-12">

            <div class="box box-info">

                <div class="box-body">

                    <div class="" id="myWizard">
                        <div class="navbar">
                            <div class="navbar-inner">
                                <ul class="nav nav-pills">
                                    <li class="active"><a href="#step1" data-toggle="tab">1. Video</a></li>
                                    <li><a href="#step2" data-toggle="tab">2. Description</a></li>
                                    <li><a href="#step3" data-toggle="tab">3. Terms & Condition</a></li>
                                    <li><a href="#step4" data-toggle="tab">4. Data Update</a></li>
                                    <li><a href="#step5" data-toggle="tab">5. Registry</a></li>
                                    <li><a href="#step6" data-toggle="tab">6. Registration Certificate</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="step1">
                                <h3>Video</h3>
                                <div class="box-layout">

                                    <p>{{ $course->video_text }}</p>

                                    @if($course->video_type == 'youtube')
                                        <iframe width="560" height="315"
                                                src="https://www.youtube.com/embed/{{ $course->video_code }}">
                                        </iframe>
                                    @endif
                                    <div class="next-layout">
                                        <a class="btn btn-default btn-flat next" href="javascript:void(0)">Next</a>
                                    </div>
                                </div>

                                {{--<hr/>--}}
                            </div>
                            <div class="tab-pane" id="step2">
                                <h3>Description</h3>
                                <div class="box-layout">
                                    <p>{{ $course->description }}</p>


                                    <div class="next-layout">
                                        <a class="btn btn-default btn-flat next" href="javascript:void(0)">Next</a>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="step3">
                                <h3>Terms and Conditions</h3>
                                <div class="box-layout">
                                    <p class="">{{ $course->terms_and_conditions }}</p>
                                    <div class="form-group">
                                        <div class="js-pdf-viewer">

                                        </div>

                                        <input type="hidden" id="teacher_id" value="{{ $teacher->user->id }}">
                                        <input type="hidden" id="course_id" value="{{ $teacher->user->id }}">

                                    </div>

                                    <div class="next-layout">
                                        <div class="row">
                                            <div class="col-lg-6 text-left">
                                                <div class="checkbox ">
                                                    <label class="">
                                                        @if($registration->accept_tc == 0)
                                                            <input type="checkbox" id="chk-accept-registration-tc"
                                                                   @if ($registration->accept_tc == 1)
                                                                   checked="checked"
                                                                    @endif
                                                            > Accept
                                                        @endif
                                                    </label>

                                                    @if($registration->accept_tc == 0)
                                                        &nbsp;&nbsp;
                                                        <button type="button"
                                                                class="btn-accept-tc btn-primary btn btn-flat">Accept</button>
                                                    @endif
                                                </div>

                                                @if($registration->accept_tc == 1)
                                                    <div class="pull-left">
                                                        <i class="fa fa-check"></i> Accepted at
                                                        {{ date('m/d/Y h:i a', strtotime($registration->tc_accept_time)) }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-lg-6">
                                                <a class="btn btn-default btn-flat next" href="javascript:void(0)">Next</a>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="step4">
                                <h3>Data Update</h3>
                                <div class="box-layout">
                                    <p>{{ $course->data_update_brief }}</p>

                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Social Id</th>
                                                <th>First name</th>
                                                <th>Last name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>T&C Accept</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{ $teacher->social_id }}
                                                </td>
                                                <td>
                                                    {{ $teacher->user->name }}
                                                </td>
                                                <td>

                                                </td>
                                                <td>
                                                    {{ $teacher->inst_email }}
                                                </td>
                                                <td>
                                                    {{ $teacher->mobile }}
                                                </td>
                                                <td>
                                                    Accept
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="next-layout">
                                        <a class="btn btn-default btn-flat next" href="javascript:void(0)">Next</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="step5">
                                <h3>Registration Inspection</h3>

                                <div class="box-layout">
                                    <p>Lorem ipsum</p>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p>File <code>{{ basename($registration->inspection_certificate)  }}</code>
                                                uploaded at: {{ date('d M Y: h:i a', strtotime($registration->inspection_certificate_upload_time)) }}</p>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div id="registration_release_file_upload"></div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <h3><i class="fa fa-download"></i> Download Letter of Registration</h3>
                                            <hr/>
                                            <p><a class="btn btn-link" href="{{ url('/asset/letter_of_registration.pdf') }}"
                                                target="_blank"
                                                >lor_{{ $teacher->social_id }}.pdf</a>
                                            <label><i class="fa fa-check-square-o"></i></label></p>

                                        </div>
                                    </div>
                                    <div class="next-layout">
                                        <a class="btn btn-default btn-flat next" href="javascript:void(0)">Next</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="step6">
                                <div class="box-layout">
                                    <p>This is the last step. You're done.</p>
                                    <div class="next-layout">
                                        <a class="btn btn-success first" href="javascript:void(0)">Start over</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <input type="hidden" id="registration_id" value="{{ $registration->id }}">
                    <input type="hidden" id="teacher_social_id" value="{{ $teacher->social_id }}">

                </div>
            </div>

        </div>


    </div>

    @include('lms.admin.course.registration_release_file_upload')

    <style type="text/css">

        #myWizard .navbar{
            border: 1px solid #ccc;
            border-bottom: none;
            margin-bottom: 0;
            border-radius: 0;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            min-height: 0;
        }
        #myWizard h3{
            margin-top: 10px;
        }
        #myWizard .tab-content{
            padding:10px 20px;
            border: 1px solid #CCCCCC;
            min-height: 300px;
            position: inherit;
        }

        .box-layout{
            border: 1px solid #000000;
            padding:20px;
            min-height: 220px;
            position: relative;
        }
        #myWizard .next-layout{
            position: absolute;
            bottom: 10px;
            width: 100%;
            padding-right: 30px;
            text-align: right;
        }

    </style>

@stop