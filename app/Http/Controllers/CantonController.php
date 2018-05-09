<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use Yajra\DataTables\Facades\DataTables;
use App\Canton;

class CantonController extends Controller
{
    public function index(){

        $title = 'Canton Management - '.env('APP_NAME') ;
        return view('lms.admin.location.canton.index', ['title'=> $title]);

    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {

        $cantons = Canton::select([
            'cantons.id as id',
            'provinces.id as province_id',
            'provinces.name as province_name',
            'cantons.name as canton_name',
            'cantons.capital as canton_capital',
            'cantons.dist_name as canton_dist_name',
            'cantons.dist_code as canton_dist_code',
            'cantons.zone as canton_zone',
            ])
            ->join('provinces','cantons.province_id', '=' ,'provinces.id');

        return Datatables::of($cantons)
            ->editColumn('action', 'lms.admin.location.canton.action')
            ->setRowId(function ($cantons){
                return 'canton_id_'.$cantons->id;
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

}
