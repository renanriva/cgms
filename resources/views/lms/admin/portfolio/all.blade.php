@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.page.teacher.index.page_header') }}</h1>
@stop

@section('content')

    @if(Auth::user()->role == 'admin')
    <div class="row">
        <form class="form-horizontal" method="get" action="/admin/portfolio">
            <div class="col-xs-6">
                <div class="input-group">

                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span id="search_concept">{{  ucfirst(str_replace('_', ' ', app('request')->input('search_param')))   }}</span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#course_code">Course Code</a></li>
                            <li><a href="#course_name">Course Name</a></li>
                            <li><a href="#social_id">Social Id</a></li>
                            <li><a href="#teachers_name">Teachers Name</a></li>
                            <li class="divider"></li>
                            <li><a href="#all">All Fields</a></li>
                        </ul>

                    </div>

                    <input type="hidden" name="search_param" id="search_param"
                           value="{{ app('request')->input('search_param') }}">
                    <input type="text" class="form-control" name="x" placeholder="Search term..." value="{{ app('request')->input('x') }}">
                </div>
            </div>
            <div class="col-xs-2">
                <div class="input-group">

                    <select class="form-control" name="registration">
                        <option
                                disabled="">Registration</option>
                        <option {{ app('request')->input('registration') == 1 ? 'selected' : '' }}
                                value="1">Approved</option>
                        <option {{ app('request')->input('registration') == 0 ? 'selected' : '' }}
                                value="0">Not Approved</option>
                        <option {{ app('request')->input('registration') == 3 ? 'selected' : '' }}
                                value="3">All</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="btn-group-sm">
                    <button class="btn btn-primary btn-search btn-flat"
                            formaction="/admin/portfolio"
                            type="submit"><i class="fa fa-search"></i> Search</button>
                    <button class="btn btn-success btn-download btn-flat"
                            formaction="/admin/portfolio/download" formtarget="_blank"
                            type="submit"><i class="fa fa-cloud-download"></i> Download</button>

                </div>
            </div>
        </form>
    </div>
    <br/>
    @endif

    <div class="row" id="portfolio">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.page.teacher.index.table_header') }}</h3>
                    </div>
                    <div class="pull-right">
                    </div>
                </div>
                <div class="box-body">

                    <table class="table table-bordered table-responsive" id="teacher-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>{{ __('lms.page.teacher.table.security_id') }}</th>
                                <th width="18%">{{ __('lms.page.teacher.table.name') }}</th>
                                <th>{{ __('lms.page.teacher.table.course_type') }}</th>
                                <th>{{ __('lms.page.teacher.table.course_name') }}</th>
                                <th>{{ __('lms.page.teacher.table.university') }}</th>
                                {{--<th>{{ __('lms.page.teacher.table.modality') }}</th>--}}
                                {{--<th>{{ __('lms.page.teacher.table.hours') }}</th>--}}
                                <th>{{ __('lms.page.teacher.table.start_date') }}</th>
                                <th>{{ __('lms.page.teacher.table.end_date') }}</th>
                                {{--<th>{{ __('lms.page.registration.pending.table.terms_condition') }}</th>--}}
                                <th>{{ __('lms.page.registration.pending.table.record_uploaded') }}</th>
                                <th>{{ __('lms.page.teacher.table.approved') }}</th>
                                <th>Grade</th>
                                <th>Grade Approved</th>
                                <th>{{ __('lms.page.teacher.table.certificate') }}</th>
                                <th>{{ __('lms.page.teacher.table.diploma') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($registrations as $registration)
                                <tr>
                                    <td>{{ $registration->id }}</td>
                                    <td>{{ $registration->student->social_id }}</td>
                                    <td>{{ $registration->student->first_name }}</td>
                                    <td>{{ $registration->course->course_type }}</td>
                                    <td>{{ $registration->course->short_name }}<br/>
                                        <small class="text-warning">{{ $registration->course->course_code }}</small></td>
                                    <td>{{ $registration->course->university->name }}</td>
{{--                                    <td>{{ $registration->course->modality }}</td>--}}
{{--                                    <td>{{ $registration->course->hours }}--}}
                                    <td>{{ date('d M Y', strtotime($registration->course->start_date)) }}</td>
                                    <td>{{ date('d M Y', strtotime($registration->course->end_date)) }}</td>
                                    @include('lms.admin.registration.parts.table.td.student_inspection_form')
                                    <td>
                                        @if($registration->is_approved == REGISTRATION_IS_APPROVED)
                                            <i class="fa fa-check-square-o"></i> Approved<br/>
                                            <small>by {{ $registration->approvedBy->name }} at <br/>{{ date('d m Y - h:i a', strtotime($registration->approval_time)) }}</small>
                                        @else
                                            <i class="fa fa-times"></i> Not Approved

                                        @endif
                                    </td>
                                    @include('lms.admin.registration.parts.table.td.mark_approved')
                                    <td class="js-certificate">
                                        @if($registration->is_approved == REGISTRATION_IS_APPROVED)

                                            <form method="post" target="_blank"
                                                  action="{{ url("/admin/registration/$registration->id/download/certificate") }}">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-link btn-link-download" rel="tooltip"
                                                        title="{{ basename($registration->certificate_path) }}"
                                                ><i class="fa fa-cloud-download"></i> Download</button>
                                            </form>

                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($registration->diploma_path))

                                            <form method="post" target="_blank"
                                                  action="{{ url("/admin/registration/$registration->id/download/diploma") }}">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-link btn-link-download" rel="tooltip"
                                                        title="{{ basename($registration->diploma) }}"
                                                ><i class="fa fa-cloud-download"></i> Download</button>
                                            </form>

                                        @endif

                                        @if(Auth::user()->role == 'admin')
                                            @isset($registration->diploma_download_time)
                                                <small>
                                                    <span>Last download  </span><br/>
                                                    <span class="text-info">
                                                        {{ date('d M Y', strtotime($registration->diploma_download_time)) }}<br/>
                                                        {{ date('h:i a', strtotime($registration->diploma_download_time)) }}

                                                    </span>
                                                </small>
                                            @endisset
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot></tfoot>
                    </table>

                </div>
                <div class="box-footer text-center">
                    {{ $registrations->appends(request()->query())->links() }}
                </div>
            </div>


        </div>
    </div>

@stop