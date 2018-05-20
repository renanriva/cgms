<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use App\Province;
use Illuminate\Support\Facades\Auth;
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
            'users.email as teacher_email',
            'teachers.social_id as social_id',
            'teachers.cc as cc',
            'teachers.moodle_id as moodle_id',
            'teachers.university_name as university',
            'teachers.function as function',
            'teachers.gender as gender',
            'teachers.province as province',
            'teachers.canton as canton',
            'teachers.parroquia as parroquia',
            'teachers.district as district',
            'teachers.district_code as district_code',
            'teachers.zone as zone',
            'teachers.amie as amie',
            ])
            ->join('users','teachers.user_id', '=' ,'users.id');

        return Datatables::of($teachers)
            ->editColumn('action', 'lms.admin.teacher.action')
            ->setRowId(function ($teachers){
                return 'teacher_id_'.$teachers->id;
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

//        $canton = Canton::find($id);
//
//        if ($canton){
//
//            // todo add canton update validation
//            $post = $request->all();
//
//            $canton->province_id    = $post['province_id'];
//            $canton->name           = $post['name'];
//            $canton->capital        = $post['capital'];
//            $canton->dist_name        = $post['dist_name'];
//            $canton->dist_code        = $post['dist_code'];
//            $canton->zone        = $post['zone'];
//            $canton->save();
//
//            return response()->json(['canton' => $canton])->setStatusCode(200);
//        } else{
//
//            return response()->json(['error' => 'Not found'])->setStatusCode(404);
//        }


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

             Excel::load($path, function ($reader) use(&$rows){

                foreach ($reader->toArray() as $row) {


                    $teacher['name'] = $row['nombres'];
                    $teacher['gender'] = ucfirst($row['genero']);
                    $teacher['social_id'] = $row['cedula'];

                    $teacher['cc'] = $row['c_c'];

                    $teacher['date_of_birth'] = date('Y-m-d', strtotime($row['fecha_nacimiento']));
                    $teacher['telephone'] = $row['telefono'];
                    $teacher['mobile'] = $row['celular'];
                    $teacher['moodle_id'] = '';
                    $teacher['inst_email'] = $row['correo_electronico'];
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
                    $teacher['district_code'] = $row['cod_distrito'];
                    $teacher['zone'] = $row['zona'];

                    /**
                     * if social_id + inst_email found in teacher table
                     * -> update the data
                     * else
                     * -> create a user with the name, inst_email + add teacher data
                     */
                    $is_teacher_exist = $this->isTeacherExist($teacher['social_id'], $teacher['inst_email']);

                    if ($is_teacher_exist == false){

                        $this->insertNewTeacher($teacher);
                        array_push($rows, $teacher);
                    }

                }

            });

            // @todo after adding all items into an array, add the array to database in batch

            return response()->json(['rows' => $rows, 'success' => true] );

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage(), 'file' => $path]);
        }


        return $path;

    }

    public function showProfile($id){


        $teacher = Teacher::find($id);
        $title = $teacher->user->name . ' - ' . env('APP_NAME');

        return view('lms.admin.teacher.profile', ['teacher'=> $teacher, 'title' =>  $title]);

    }


    /**
     * Insert Teacher and user
     *
     * @param $teacher []
     * @return Teacher
     */
    private function insertNewTeacher($teacher){

        $user = new User();
        $user->name = $teacher['name'];
        $user->email    = $teacher['inst_email'];
        $user->password = bcrypt($teacher['inst_email']);
        $user->role     = USER_ROLE_STUDENT;
        $user->status   = USER_STATUS_ACTIVE;
        $user->creation_type = USER_CREATION_TYPE_IMPORT;
        $user->created_by = Auth::user()->id;
        $user->updated_by = Auth::user()->id;
        $user->save();

        $newTeacher = new Teacher();
        $newTeacher->social_id = $teacher['social_id'];
        $newTeacher->cc = $teacher['cc'];
        $newTeacher->date_of_birth = $teacher['date_of_birth'];
        $newTeacher->gender = $teacher['gender'];
        $newTeacher->telephone = $teacher['telephone'];
        $newTeacher->mobile = $teacher['mobile'];
        $newTeacher->inst_email = $teacher['inst_email'];
        $newTeacher->university_name = $teacher['university_name'];
        $newTeacher->function = $teacher['function'] ;
        $newTeacher->work_area = $teacher['work_area'];
        $newTeacher->category = $teacher['category'];
        $newTeacher->reason_type = $teacher['reason_type'];
        $newTeacher->action_type = $teacher['action_type'] ;
        $newTeacher->action_description = $teacher['action_description'];
        $newTeacher->speciality= $teacher['speciality'];
        $newTeacher->join_date = $teacher['join_date'];
        $newTeacher->end_date = $teacher['end_date'];
        $newTeacher->amie= $teacher['amie'];
        $newTeacher->disability = $teacher['disability'];
        $newTeacher->ethnic_group = $teacher['ethnic_group'];

        $newTeacher->province = $teacher['province'];
        $newTeacher->canton = $teacher['canton'];
        $newTeacher->parroquia = $teacher['parroquia'];
        $newTeacher->district = $teacher['district'];
        $newTeacher->district_code = $teacher['district_code'];
        $newTeacher->zone = $teacher['zone'];

        $newTeacher->user_id = $user->id;
        $newTeacher->created_by = Auth::user()->id;
        $newTeacher->updated_by = Auth::user()->id;
        $newTeacher->save();
        //        $teacher['moodle_id'] = '';//@todo moddle_id


//                @todo add the email to quee


        return $newTeacher;


    }

    /**
     * @param $social_id
     * @param $inst_email
     * @return bool
     */
    private function isTeacherExist($social_id, $inst_email){

        $teacher = Teacher::where([
            'social_id' => $social_id,
            'inst_email'    => $inst_email
        ])->count();

        if ($teacher > 0){
            return true;
        }

        return false;

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
