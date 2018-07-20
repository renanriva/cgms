<?php

namespace App\Http\Controllers;

use App\Repository\MasterCourseRepository;
use Illuminate\Http\Request;

class MasterCourseController extends Controller
{
    private  $repo ;

    public function __construct()
    {
        $this->repo = new MasterCourseRepository();
    }

    public function index(Request $request){


        //@todo
        $page= 1;
        $master_courses = $this->repo->getListByPagination($page);

        return view('lms.admin.master_course.index', ['masterCourses' => $master_courses, 'title'=> 'Master Courses']);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(){

        $list = $this->repo->getListAll();

        return response()->json(['master_course' => $list]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){

//        dd('eee');
        return view('lms.admin.master_course.create', [ 'title'=> 'Master Course']);

    }

    public function insert(Request $request){

        $post = $request->all();

        $type = $this->repo->insert($post);

        return response()->redirectTo('/admin/master-course');


    }

    public function update(Request $request, $id){


        $post = $request->all();

        $this->repo->update($post, $id);

        return response()->redirectTo('/admin/master-course');


    }


    public function show($id){

        $course = $this->repo->findById($id);

        return view('lms.admin.master_course.create', ['master' => $course, 'title'=> 'Edit Course']);


    }

    public function delete($id){

        $this->repo->delete($id);

        return response()->redirectTo('/admin/master-course');


    }
}
