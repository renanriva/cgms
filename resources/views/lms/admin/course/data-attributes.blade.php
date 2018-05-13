data-id="{{ $id }}"
data-course_id="{{$course_id}}"
data-course_type="{{$course_type}}"
data-modality="{{ $modality }}"
data-short_name="{{ $short_name }}"
data-description="{{$description}}"
data-comment="{{$comment}}"
data-hours="{{$hours}}"
data-quota="{{$quota}}"
data-start_date="{{ date('m/d/Y', strtotime($start_date))}}"
data-end_date="{{date('m/d/Y', strtotime($end_date))}}"
data-university_id="{{$university_id}}"