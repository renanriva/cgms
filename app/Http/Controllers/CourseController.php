<?php

namespace App\Http\Controllers;

use App\Course;
use App\Registration;
use App\Repository\CourseRepository;
use App\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

use App\Canton;

/**
 * Class CourseController
 *
 * @package App\Http\Controllers
 */
class CourseController extends Controller
{

    /**
     * @todo add authorization check
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $title = 'Course Management - '.env('APP_NAME') ;
        return view('lms.admin.course.index', ['title'=> $title]);

    }


    /**
     * @todo add authorization check
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {

        $course = Course::get();

        return Datatables::of($course)
            ->editColumn('action', 'lms.admin.course.action')
            ->setRowId(function ($course){
                return 'course_id_'.$course->id;
            })
            ->make(true);

    }


    /**
     * @todo add validation rule
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){

        // @todo add authorization check

        $course = new Course();

        $post = $request->all();

        $course['course_code']    = $post['course_code'];
        $course['course_type']    = $post['course_type'];
        $course['modality']       = $post['modality'];

        $course['university_id']                = $post['university_id'];
        $course['short_name']                   = $post['short_name'];

//        @todo check date format
        $course['start_date']                   = date('Y-m-d', strtotime($post['start_date']));
        $course['end_date']                     = date('Y-m-d', strtotime($post['end_date']));

        $course['hours']                        = $post['hours'];
        $course['quota']                        = $post['quota'];

        $course['comment']                      = $post['comment'];
        $course['description']                  = $post['description'];
        $course['video_text']                   = $post['video_text'];
        $course['video_type']                   = $post['video_type'];
        $course['video_code']                   = $post['video_code'];
        $course['terms_and_conditions']         = $post['terms_condition'];
        $course['data_update_brief']            = $post['data_update_text'];

        $course['inspection_form_generated']    = false;
//        $course->save();
        
        $courseRepo = new CourseRepository();

        $newCourse = $courseRepo->insert($course);

        return response()->json(['course' => $newCourse])->setStatusCode(201);
    }

    /**
     * @todo add authorization check
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){

        $course = Course::find($id);

        if ($course){

            // todo add course update validation
            $post = $request->all();

            $course->course_code      = $post['course_code'];
            $course->course_type    = $post['course_type'];
            $course->modality       = $post['modality'];

            $course->university_id  = $post['university_id'];
            $course->short_name     = $post['short_name'];

            $course->start_date     = date('Y-m-d', strtotime($post['start_date']));
            $course->end_date       = date('Y-m-d', strtotime($post['end_date']));

            $course->hours          = $post['hours'];
            $course->quota          = $post['quota'];

            $course->comment        = $post['comment'];
            $course->description    = $post['description'];

            $course->updated_by     = Auth::user()->id;
            $course->save();

            return response()->json(['course' => $course])->setStatusCode(200);
        } else{

            return response()->json(['error' => 'Not found'])->setStatusCode(404);
        }


    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){

//        @todo add authorization check
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json()->setStatusCode(204);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadCourseList(Request $request){

//        @todo cloud_storage_path
        $cloud = Storage::disk('public');
        $path = $cloud->putFile('course/new_course_list', $request->file('qqfile'));

        $path = storage_path('app/public/'.$path);

        $teacherRepo = new TeacherRepository();

        try {
            $rows = [];

            Excel::load($path, function ($reader) use(&$rows, $teacherRepo){

                foreach ($reader->toArray() as $row) {


                    $teacher['first_name'] = $row['nombres'];
                    $teacher['last_name'] = "";
                    $teacher['gender'] = ucfirst($row['genero']);
                    $teacher['social_id'] = $row['cedula'];

                    $teacher['cc'] = $row['c_c'];

                    $teacher['date_of_birth'] = date('Y-m-d', strtotime($row['fecha_nacimiento']));
                    $teacher['telephone'] = $row['telefono'];
                    $teacher['mobile'] = $row['celular'];
                    $teacher['moodle_id'] = '';
                    $teacher['inst_email'] = $row['correo_electronico'];
                    $teacher['email'] = $row['correo_electronico'];
                    $teacher['university_name'] = $row['institucion_educativa'];
                    $teacher['function'] = $row['funcion'];
                    $teacher['work_area'] = $row['regimen_laboral'];
                    $teacher['category'] = $row['categoria'];
                    $teacher['reason_type'] = $row['tipo_razon'];
                    $teacher['action_type'] = $row['tipo_accion'];
                    $teacher['action_description'] = $row['explicacion_accion'];
                    $teacher['speciality'] = $row['especialidad'];
                    $teacher['join_date'] = date('Y-m-d', strtotime($row['fecha_inicio']));
                    $teacher['end_date'] = isset($row['fecha_fin']) ? date('Y-m-d', strtotime($row['fecha_fin'])) : null;
                    $teacher['amie'] = $row['amie'];
                    $teacher['disability'] = $row['discapacidad'];
                    $teacher['ethnic_group'] = $row['etnia'];

                    $teacher['province'] = $row['provincia'];
                    $teacher['canton'] = $row['canton'];
                    $teacher['parroquia'] = $row['parroquia'];
                    $teacher['district'] = $row['distrito'];
                    $teacher['dist_code'] = $row['cod_distrito'];
                    $teacher['zone'] = $row['zona'];

                    /**
                     * if social_id + inst_email found in teacher table
                     * -> update the data
                     * else
                     * -> create a user with the name, inst_email + add teacher data
                     */
                    $is_teacher_exist = $teacherRepo->isTeacherExist($teacher['social_id'], $teacher['inst_email']);

                    if ($is_teacher_exist == false){

                        $teacherRepo->insert($teacher, USER_CREATION_TYPE_IMPORT);
                        array_push($rows, $teacher);
                    }
//                    @todo update the data on else

                }

            });

            return response()->json(['rows' => $rows, 'success' => true] );

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage(), 'file' => $path]);
        }

    }

    /**
     *
     * @param Request $request
     * @return array
     */
    public function uploadInspection(Request $request) {


        $cloud = Storage::disk('public');

        $filename = "course_".$request->input('course_id').'_inspection_form.'.$request->file('qqfile')->extension();
        $path = $cloud->putFileAs('course/inspection', $request->file('qqfile'), $filename);

        $path = storage_path('app/'.$path);
        $course = Course::find($request->input('course_id'));
        $course->inspection_form_generated  = true;
        $course->save();

        return response()->json(['path'=> $path, 'success' => true]);


    }


    /**
     * @param Request $request
     * @param         $course_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister(Request $request, $course_id){

        $title = 'Register - '.env('APP_NAME') ;

        $teacher = Auth::user()->teacher;

        /**
         * find registration with course_id and teacher id
         *
         * if found( return registration
         * if not found, create registration and return code
         */

        $registration = Registration::where('teacher_id', $teacher->id)
            ->where('course_id', $course_id)
            ->first();


        if ($registration == null){

            $registration = new Registration();
            $registration->course_id = $course_id;
            $registration->teacher_id = $teacher->id;
            $registration->user_social_id = $teacher->social_id;
            $registration->user_first_name = $teacher->user->name;
            $registration->inspection_certificate = '';
            $registration->inspection_certificate_signed = '';
            $registration->reg_date     = null;
            $registration->accept_tc     = REGISTRATION_ACCEPT_TERMS_AND_CONDITION_FALSE;
            $registration->registry_is_generated = REGISTRATION_REGISTRY_IS_NOT_GENERATED;
            $registration->registry_is_generated = REGISTRATION_REGISTRY_IS_NOT_GENERATED;

            $registration->status = REGISTRATION_STATUS_STARTED;
            $registration->is_approved = REGISTRATION_IS_NOT_APPROVED;
            $registration->is_approved = REGISTRATION_IS_NOT_APPROVED;

            $registration->save();
        }


        return view('lms.admin.course.register', ['title'=> $title,
            'teacher' => $teacher,
            'registration' => $registration,
            'course' => $teacher->getRequestedCourse($course_id)->first()]);

    }

    /**
     * @param Request $request
     * @param         $registrationId
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadStudentInspection(Request $request, $registrationId){

        $cloud = Storage::disk('public');

        $filename = "course_".$registrationId.'_teacher_'.$request->input('teacher_id').'_inspection_signed_certificate.'.$request->file('qqfile')->extension();
        $path = $cloud->putFileAs('course/signed_certificates', $request->file('qqfile'), $filename);

        $path = storage_path('app/'.$path);


        $registration = Registration::find($registrationId);

        $current_time = Carbon::now()->toDateTimeString();
        $registration->inspection_certificate_signed = $path;
        $registration->inspection_certificate_upload_time = $current_time;
        $registration->status = REGISTRATION_STATUS_SIGNED;
        $registration->save();


        /**
         * Update the course request status
         */
        DB::table('course_requests')
            ->where('course_id', $registration->course_id)
            ->where('teacher_id', $registration->teacher_id)
            ->update(['status' => COURSE_REQUEST_ACCEPTED]);

        return response()->json(['path'=> $path, 'success' => true]);

    }

    /**
     * @param Request $request
     * @return array
     */
    public function getSearch(Request $request){

        return ['request'=> $request->all()];
    }

}
