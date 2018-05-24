<?php

namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
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
        $course->video_text     = $post['video_text'];
        $course->video_type     = $post['video_type'];
        $course->video_code     = $post['video_code'];
        $course->terms_and_conditions    = $post['terms_condition'];
        $course->data_update_brief    = $post['data_update_text'];

        $course->inspection_form_generated = false;

        $course->created_by     = Auth::user()->id;
        $course->updated_by     = Auth::user()->id;
        $course->save();

        return response()->json(['course' => $course])->setStatusCode(201);
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
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function uploadCourseRequest(Request $request) {

        $cloud = Storage::disk('public');
        $path = $cloud->putFile('course/request', $request->file('qqfile'));

        $path = storage_path('app/public/'.$path);

        try {
            $rows = [];

            Excel::load($path, function ($reader) use(&$rows){

                foreach ($reader->toArray() as $row) {


                    $teacher['course_id']       = $this->getCourseId($row['course_code']);
                    $teacher['course_code']     = $row['course_code'];
                    $teacher['teacher_id']      = $this->getTeacherId($row['teacher_social_id']);
                    $teacher['teacher_social_id'] = $row['teacher_social_id'];
                    $teacher['created_by']      = Auth::user()->id;
                    $teacher['status']          = COURSE_REQUEST_CREATED;

                    array_push($rows, $teacher);

                }

            });

            // batch insert
            DB::table('course_requests')->insert($rows);

            // @todo after adding all items into an array, add the array to database in batch
            return response()->json(['rows' => $rows, 'success' => true] );

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage(), 'file' => $path]);
        }

    }

    /**
     * @param $social_id
     * @return mixed
     */
    private function getTeacherId($social_id) {


        $teacher = Teacher::where('social_id', $social_id)->first();

        return $teacher->id;

    }

    /**
     * @param $course_code
     * @return mixed
     */
    private function getCourseId($course_code) {

        $course = Course::where('course_code', $course_code)->first();

        return $course->id;

    }


    /**
     * @param Request $request
     * @param         $course_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister(Request $request, $course_id){

        $title = 'Register - '.env('APP_NAME') ;
        return view('lms.admin.course.register', ['title'=> $title]);

    }

}
