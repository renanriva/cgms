<table class="table table-borderless table-responsive" id="upcoming-course">
    <thead>
    <tr>
        <th>{{ __('lms.page.upcoming.table.course_type') }}</th>
        {{--<th>{{ __('lms.page.upcoming.table.course_code') }}</th>--}}
        <th>{{ __('lms.page.upcoming.table.short_name') }}</th>
        <th>{{ __('lms.page.upcoming.table.institution') }}</th>
        <th>{{ __('lms.page.upcoming.table.modality') }}</th>
        <th>{{ __('lms.page.upcoming.table.hours') }}</th>
        <th>{{ __('lms.page.upcoming.table.start_date') }}</th>
        <th>{{ __('lms.page.upcoming.table.end_date') }}</th>
        <th>{{ __('lms.page.upcoming.table.action') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($teacher->allUpcomingCourses as $course)
        <tr>
            <td>{{ $course->course_type }}</td>
            {{--<td>{{ $course->course_code }}</td>--}}
            <td>{{ $course->short_name }}<br/>
                <small class="text-warning">{{ $course->course_code }}</small>
            </td>
            <td>{{ $course->university->name }}</td>
            <td>{{ $course->modality }}</td>
            <td>{{ $course->hours }} hours</td>
            <td>{{ date('d M Y', strtotime($course->start_date)) }}</td>
            <td>{{ date('d M Y', strtotime($course->end_date)) }}</td>
            <td>
                @can('register', $course)
                <form method="post" action="{{ url('admin/course/register/'.$course->id) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-link"><i class="fa fa-user-plus"></i> Register</button>
                </form>
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>