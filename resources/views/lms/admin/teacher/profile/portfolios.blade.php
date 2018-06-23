<div class="row">
    <div class="col-lg-12">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Portfolio</h3>

                <div class="box-tools">
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">

                <table class="table table-responsive">

                    <tbody>
                        <tr>
                            <th>Course Type</th>
                            <th>Course</th>
                            <th>Institute</th>
                            <th>Modalidad</th>
                            <th>Hours</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Grade</th>
                            <th>Grade Approved</th>
                            <th>Certificate</th>
                            <th>Diploma</th>
                        </tr>
                        @foreach($portfolios as $registration)
                            <tr>
                                <td>{{ $registration->course->course_type }}</td>
                                <td>{{ $registration->course->short_name }}<br/>
                                    <small class="text-warning">{{ $registration->course->course_code }}</small>
                                </td>
                                <td>{{ $registration->course->university->name }}</td>
                                <td>{{ $registration->course->modality }}</td>
                                <td>{{ $registration->course->hours }}</td>
                                <td>{{ date('d M Y', strtotime($registration->course->start_date)) }}</td>
                                <td>{{ date('d M Y', strtotime($registration->course->end_date)) }}</td>
                                @include('lms.admin.registration.parts.table.td.is_approved')
                                @include('lms.admin.registration.parts.table.td.mark_approved')
                                @include('lms.admin.registration.parts.table.td.certificate')
                                @include('lms.admin.registration.parts.table.td.diploma')
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>