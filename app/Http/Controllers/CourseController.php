<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

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

        $course->course_id      = $post['course_id'];
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

            $course->course_id      = $post['course_id'];
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
     * @return $this
     */
    public function delete($id){

//        @todo add authorization check
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json()->setStatusCode(204);

    }

}
