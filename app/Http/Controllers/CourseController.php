<?php

namespace App\Http\Controllers;

use App\Course;
use App\Events\DiplomaUploaded;
use App\Http\Requests\CourseInsertRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Registration;
use App\Repository\CourseRepository;
use App\Repository\UniversityRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

use App\Canton;
use ZipArchive;

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
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {

        $user = Auth::user();

        if ($user->role == 'admin'){

            $course = Course::get();

        } elseif ($user->role == 'university'){

            $course = Course::where('university_id', $user->university->id)
                            ->get();
        }

        return Datatables::of($course)
            ->editColumn('action', 'lms.admin.course.action')
            ->setRowId(function ($course){
                return 'course_id_'.$course->id;
            })
            ->make(true);

    }


    /**
     * Insert new course from web request
     *
     * @param CourseInsertRequest|Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CourseInsertRequest $request){

        // @todo add authorization check

        $course = new Course();

        $post = $request->all();

        $course['course_code']    = $post['course_code'];
        $course['course_type']    = $post['course_type'];
        $course['modality']       = $post['modality'];

        $course['university_id']                = $post['university_id'];
        $course['short_name']                   = $post['short_name'];

        if (isset($post['start_date'])) {
            $startDate = DateTime::createFromFormat('d/m/Y', $post['start_date']);
            $course['start_date'] = $startDate->format('Y-m-d');
        } else{
            $course['start_date'] =  null;
        }

        if (isset($post['end_date'])) {
            $startDate = DateTime::createFromFormat('d/m/Y', $post['end_date']);
            $course['end_date'] = $startDate->format('Y-m-d');
        } else{
            $course['end_date'] =  null;
        }

        $course['hours']                        = $post['hours'];
        $course['quota']                        = $post['quota'];

        $course['comment']                      = $post['comment'];
        $course['description']                  = $post['description'];
        $course['video_text']                   = $post['video_text'];
        $course['video_type']                   = $post['video_type'];
        $course['video_code']                   = $post['video_code'];
        $course['data_update_brief']            = $post['data_update_text'];

        $course['inspection_form_generated']    = false;

        $courseRepo = new CourseRepository();

        $newCourse = $courseRepo->insert($course);

        return response()->json(['course' => $newCourse])->setStatusCode(201);
    }

    /**
     * @param CourseUpdateRequest|Request $request
     * @param                             $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CourseUpdateRequest $request, $id){

        $course = Course::find($id);

        if ($course){

            $post = $request->all();

            // @todo add different procedure to update course code
//            $course->course_code      = $post['course_code'];
            $course->course_type    = $post['course_type'];
            $course->modality       = $post['modality'];

            $course->university_id  = $post['university_id'];
            $course->short_name     = $post['short_name'];

            if (isset($post['start_date'])) {
                $startDate = DateTime::createFromFormat('d/m/Y', $post['start_date']);
                $course->start_date = $startDate->format('Y-m-d');
            } else{
                $course->start_date =  null;
            }

            if (isset($post['end_date'])) {
                $startDate = DateTime::createFromFormat('d/m/Y', $post['end_date']);
                $course->end_date = $startDate->format('Y-m-d');
            } else{
                $course->end_date =  null;
            }

            $course->hours          = $post['hours'];
            $course->quota          = $post['quota'];

            $course->comment        = $post['comment'];
            $course->description    = $post['description'];

            $course->comment                      = $post['comment'];
            $course->video_text                   = $post['video_text'];
            $course->video_type                   = $post['video_type'];
            $course->video_code                   = $post['video_code'];
            $course->data_update_brief            = $post['data_update_text'];

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

        $cloud = Storage::disk();
        $path = $cloud->putFile('course/new_course_list', $request->file('qqfile'));

        $path = storage_path('app/'.$path);

        $uniRepo = new UniversityRepository();

        $courseRepository = new CourseRepository();

        try {
            $rows = [];

            Excel::load($path, function ($reader) use(&$rows, $courseRepository, $uniRepo){

                foreach ($reader->toArray() as $row) {


                    $course['course_code']          = $row['course_code'];
                    $course['course_type']          = $row['course_type'];
                    $course['modality']             = $row['modality'];

                    $university = $uniRepo->getUniversityByName($row['university']);
                    if ($university !== null){
                        $course['university_id']        = $university->id;
                    }

                    $course['short_name']           = $row['short_name'];
                    $course['start_date']           = $row['start_date'];
                    $course['end_date']             = $row['end_date'];
                    $course['hours']                = $row['hours'];
                    $course['quota']                = $row['quota'];
                    $course['comment']              = $row['comment'];

                    $course['description']          = $row['description'];

                    $course['video_text']           = $row['video_information'];
                    $course['video_type']           = $row['video_type'];
                    $course['video_code']           = $row['embed_code'];
                    $course['data_update_text']     = $row['data_update'];


                    array_push($rows, $course);

                    $courseRepository->insert($course);

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


        $cloud = Storage::disk();

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(Request $request) {


        $course = Course::find($request->input('course_id'));

        $root_path = 'course/university_'.$course->university->id;
        $path = '';

        $type = $request->input('type');

        if ($type == 'terms_and_condition'){

            $path = $root_path.'/terms_and_condition';
            $filename = "course_".$request->input('course_id').'_tnc.'.$request->file('qqfile')->extension();

            $cloud = Storage::disk('public');
            $path = $cloud->putFileAs($path, $request->file('qqfile'), $filename);

            $course->tc_file_path  = $path;
            $course->save();


        } elseif ($type == 'lor'){

            $path = $root_path.'/lor';
            $filename = "course_".$request->input('course_id').'_lor.'.$request->file('qqfile')->extension();

            $cloud = Storage::disk();
            $path = $cloud->putFileAs($path, $request->file('qqfile'), $filename);

            $course->lor_file_path  = storage_path('app/'.$path);
            $course->save();

        } elseif ($type == 'diploma'){

            $path = $root_path.'/course_'.$course->id.'/diploma';
            $filename = "course_".$request->input('course_id').'_diploma.'.$request->file('qqfile')->extension();

            $cloud = Storage::disk();
            $pathFile = $cloud->putFileAs($path, $request->file('qqfile'), $filename);

            if ($request->file('qqfile')->extension() == 'zip'){

                // extract the file in the event
                event(new DiplomaUploaded($path, $pathFile, $course->id));

                return response()->json(['path'=> $path, 'success' => true]);
            }

        }


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
            $registration->inspection_certificate_signed = false;
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
     * @return array
     */
    public function getSearch(Request $request){

        return ['request'=> $request->all()];
    }


    /**
     * @param $courseId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddMarkPage($courseId){


        $user = Auth::user();
        $course = Course::find($courseId);

        if ($user->can('addmark', $course)){

            $title = 'Course Grade Upload - '.env('APP_NAME') ;
            return view('lms.admin.course.grade', ['title' => $title, 'course' => $course]);

        } else {

            return response()->redirectTo('unauthorized');
        }
    }

    /**
     * @param Request $request
     * @param         $course_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddMark(Request $request, $course_id){

        $user = Auth::user();
        $course = Course::find($course_id);

        if ($user->can('addmark', $course)){

            $cloud = Storage::disk();

            $filename = 'grade_of_'.$course->course_code.'_'.date('Ymdhi', strtotime('now'));
            $path = $cloud->putFileAs('course/grade/university_'.$course->university->id,
                        $request->file('qqfile'), $filename.'.'.$request->file('qqfile')->extension());

            $path = storage_path('app/'.$path);


            $courseRepository = new CourseRepository();

            try {
                $rows = [];

                Excel::load($path, function ($reader) use(&$rows, $courseRepository, $user){

                    foreach ($reader->toArray() as $row) {

                        $getCourse = Course::where('course_code', trim($row['course_code']))->first();


                        // if the course id received from the file has permission for this user to update mark
                        if ($user->can('update_grade', $getCourse)){

                            $newRegistration = $courseRepository->updateGrade(
                                trim($getCourse->id),
                                trim($row['cedula']),
                                $row['grade'],
                                $row['approved'],
                                $user);

                            array_push($rows, $newRegistration);
                        }

                    }

                });

                return response()->json(['rows' => $rows, 'success' => true] );

            } catch (\Exception $e) {

                return response()->json(['error' => $e->getMessage(),'rows' => $rows, 'file' => $path])->setStatusCode(422);
            }

        } else {
            //send 403 json response
            return response()->json(['error'=> 'Unauthorized'])->setStatusCode(403);
        }

    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function downloadLor($id){

        if(Auth::check()) {

            $course = Course::find($id);

            if ($course) {

                return response()->file($course->lor_file_path);

            } else {
                return response()->redirectTo('admin/unauthorized');

            }

        }

    }


}
