<?php

namespace App\Http\Controllers;

use App\University;
use Illuminate\Http\Request;
use App\Province;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Canton;

/**
 * Class UniversityController
 *
 * @package App\Http\Controllers
 */
class UniversityController extends Controller
{
    public function index(){

        $title = 'University Management - '.env('APP_NAME') ;
        return view('lms.admin.university.index', ['title'=> $title]);

    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUniversityList(){

        $universities = University::all();
        return response()->json(['universities' => $universities]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {

        $universities = University::select([
            'universities.id as id',
            'universities.name as name',
            'universities.created_by as created_by_id',
            'users.name as created_by_name',
            'universities.created_at as created_at',
            ])
            ->join('users','universities.created_by', '=' ,'users.id')
            ->orderBy('universities.created_at', 'desc');

        return Datatables::of($universities)
            ->editColumn('action', 'lms.admin.university.action')
            ->setRowId(function ($universities){
                return 'university_id_'.$universities->id;
            })
            ->make(true);

    }


    /**
     * @todo add validation rule
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){

        $university = new University();

        $post = $request->all();

        $university->name           = $post['name'];
        $university->created_by        = Auth::user()->id;
        $university->updated_by        = Auth::user()->id;
        $university->save();
        $university->created_by_name = Auth::user()->name;

        return response()->json(['university' => $university])->setStatusCode(201);
    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){

        $university = University::find($id);

        if ($university){

            // todo add university update validation
            $post = $request->all();

            $university->name               = $post['name'];
            $university->updated_by         = Auth::user()->id;
            $university->save();
            $university->created_by_name    = Auth::user()->name;


            return response()->json(['university' => $university])->setStatusCode(200);
        } else{

            return response()->json(['error' => 'Not found'])->setStatusCode(404);
        }


    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){

        $university = University::findOrFail($id);
        $university->delete();

        return response()->json()->setStatusCode(204);

    }

}
