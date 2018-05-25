@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.page.upcoming.index.page_header') }}</h1>
@stop

@section('content')

    <div class="row" id="page_upcoming_course">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.page.upcoming.index.table_header') }}</h3>
                    </div>
                    <div class="pull-right">
                    </div>
                </div>
                <div class="box-body">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">About Me</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <strong><i class="fa fa-man margin-r-5"></i> Name</strong>

                            <p class="">{{ Auth::user()->name }}</p>

                            <hr>

                            <strong><i class="fa fa-map-marker margin-r-5"></i> Social Id</strong>

                            <p class="">{{ Auth::user()->id }}</p>



                            {{--<p>{{ $teacher->work_area }}, {{ $teacher->university_name }}</p>--}}

                        </div>
                        <!-- /.box-body -->
                    </div>


                    <table class="table table-bordered table-responsive" id="upcoming-course">
                        <thead>
                            <tr>
                                <th>{{ __('lms.page.upcoming.table.course_code') }}</th>
                                <th>{{ __('lms.page.upcoming.table.course_type') }}</th>
                                <th>{{ __('lms.page.upcoming.table.short_name') }}</th>
                                <th>{{ __('lms.page.upcoming.table.institution') }}</th>
                                <th>{{ __('lms.page.upcoming.table.modality') }}</th>
                                <th>{{ __('lms.page.upcoming.table.start_date') }}</th>
                                <th>{{ __('lms.page.upcoming.table.end_date') }}</th>
                                <th>{{ __('lms.page.upcoming.table.hours') }}</th>
                                <th>{{ __('lms.page.upcoming.table.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $course->course_code }}</td>
                                    <td>{{ $course->course_type }}</td>
                                    <td>{{ $course->short_name }} <br/>
                                    {{--{{ var_dump($course->allUpcomingCourses->status) }}--}}
                                    </td>
                                    <td>{{ $course->university->name }}</td>
                                    <td>{{ $course->modality }}</td>
                                    <td>{{ date('d M Y', strtotime($course->start_date)) }}</td>
                                    <td>{{ date('d M Y', strtotime($course->end_date)) }}</td>
                                    <td>{{ $course->hours }} hours</td>
                                    <td>
                                        <form method="post" action="{{ url('admin/course/register/'.$course->id) }}">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-link"><i class="fa fa-user-plus"></i> Register</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>

                </div>
            </div>

        </div>

    </div>

@stop