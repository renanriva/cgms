<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use App\Province;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Canton;

/**
 * Class TeacherController
 *
 * @package App\Http\Controllers
 */
class TeacherController extends Controller
{
    public function index(){

        $title = 'Teacher Management - '.env('APP_NAME') ;
        return view('lms.admin.teacher.index', ['title'=> $title]);

    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {

        $teachers = Teacher::select([
            'teachers.id as id',
            'users.name as teacher_name',
            'users.email as user_email',
            'teacher.social_id as social_id',
            'teacher.cc as cc',
            'teacher.moodle_id as moodle_id',
            'teacher.university as university',
            'teacher.function as function',
            'teacher.gender as gender',
            'teacher.username as username',
            ])
            ->join('users','teachers.user_id', '=' ,'users.id');

        return Datatables::of($teachers)
            ->editColumn('action', 'lms.admin.teacher.action')
            ->setRowId(function ($cantons){
                return 'teacher_id_'.$cantons->id;
            })
            ->make(true);

    }


    /**
     * @todo add validation rule
     * @param Request $request
     * @return $this
     */
    public function store(Request $request){

        $canton = new Canton();
        $post = $request->all();

        $canton->province_id    = $post['province_id'];
        $canton->name           = $post['name'];
        $canton->capital        = $post['capital'];
        $canton->dist_name        = $post['dist_name'];
        $canton->dist_code        = $post['dist_code'];
        $canton->zone        = $post['zone'];
        $canton->save();

        return response()->json(['canton' => $canton])->setStatusCode(201);
    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){

        $canton = Canton::find($id);

        if ($canton){

            // todo add canton update validation
            $post = $request->all();

            $canton->province_id    = $post['province_id'];
            $canton->name           = $post['name'];
            $canton->capital        = $post['capital'];
            $canton->dist_name        = $post['dist_name'];
            $canton->dist_code        = $post['dist_code'];
            $canton->zone        = $post['zone'];
            $canton->save();

            return response()->json(['canton' => $canton])->setStatusCode(200);
        } else{

            return response()->json(['error' => 'Not found'])->setStatusCode(404);
        }


    }

    /**
     * @param Request $request
     */
    public function upload(Request $request){


        $cloud = Storage::disk('public');
//            $disk = Storage::disk('gcs');
//            $path = $cloud->putFile($event->short_name.'/'.$event->year.'/images/upload', $request->file('qqfile'));
        $path = $cloud->putFile('teacher', $request->file('qqfile'));

        $path = storage_path('app/public/'.$path);

        try {
            $rows = [];

//            $collection = collect();

            $rows = Excel::load($path, function ($reader) use(&$rows){

//                $myrows = [];
                foreach ($reader->toArray() as $row) {
//                    var_dump($rows);

//                    var_dump($row);

//                    $collection->push($row);
//                    if (is_array($row)){
                        array_push($rows, $row);
//                    }
//                    User::firstOrCreate($row);
                }

//                return $myrows;
            });
//            \Session::flash('success', 'Users uploaded successfully.');

            // @todo after adding all items into an array, add the array to database in batch



            return response()->json(['rows' => $rows] );

        } catch (\Exception $e) {
//            \Session::flash('error', $e->getMessage());
//            return redirect(route('teachers.index'));
            return response()->json(['error' => $e->getMessage(), 'file' => $path]);
        }


        return $path;

    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByProvinceId($id){

        $cantons = Canton::where('province_id', $id)->get();

        return response()->json(['cantons'=> $cantons])->setStatusCode(200);
    }

    /**
     * @param $id
     * @return $this
     */
    public function delete($id){

        $canton = Canton::findOrFail($id);

        $canton->delete();

        return response()->json()->setStatusCode(204);

    }

}
