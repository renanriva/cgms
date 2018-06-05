@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.page.teacher.index.page_header') }}</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span id="search_concept">Filter by</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#contains">Contains</a></li>
                        <li><a href="#its_equal">It's equal</a></li>
                        <li><a href="#greather_than">Greather than ></a></li>
                        <li><a href="#less_than">Less than < </a></li>
                        <li class="divider"></li>
                        <li><a href="#all">Anything</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">
                <input type="text" class="form-control" name="x" placeholder="Search term...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
    </div>
    <br/>

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
                                <th>{{ __('lms.page.teacher.table.modality') }}</th>
                                <th>{{ __('lms.page.teacher.table.hours') }}</th>
                                <th>{{ __('lms.page.teacher.table.start_date') }}</th>
                                <th>{{ __('lms.page.teacher.table.end_date') }}</th>
                                <th>{{ __('lms.page.registration.pending.table.terms_condition') }}</th>
                                <th>{{ __('lms.page.registration.pending.table.record_uploaded') }}</th>
                                <th>{{ __('lms.page.teacher.table.approved') }}</th>
                                <th>{{ __('lms.page.teacher.table.certificate') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($registrations as $registration)
                                <tr>
                                    <td>{{ $registration->id }}</td>
                                    <td>{{ $registration->student->social_id }}</td>
                                    <td>{{ $registration->student->first_name }}</td>
                                    <td>{{ $registration->course->course_type }}</td>
                                    <td>{{ $registration->course->short_name }}</td>
                                    <td>{{ $registration->course->university->name }}</td>
                                    <td>{{ $registration->course->modality }}</td>
                                    <td>{{ $registration->course->hours }}
                                    <td>{{ date('d M Y', strtotime($registration->course->start_date)) }}</td>
                                    <td>{{ date('d M Y', strtotime($registration->course->end_date)) }}</td>
                                    @include('lms.admin.registration.parts.table.td.terms_condition')
                                    @include('lms.admin.registration.parts.table.td.student_inspection_form')
                                    <td>
                                        @if($registration->is_approved == REGISTRATION_IS_APPROVED)
                                            <i class="fa fa-check-square-o"></i> Approved<br/>
                                            <small>by {{ $registration->approvedBy->name }} at <br/>{{ date('d m Y - h:i a', strtotime($registration->approval_time)) }}</small>
                                        @else
                                            <i class="fa fa-times"></i> Not Approved

                                        @endif
                                    </td>
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
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot></tfoot>
                    </table>

                </div>
                <div class="box-footer text-center">
                    {{ $registrations->links() }}
                </div>
            </div>


        </div>
    </div>

@stop