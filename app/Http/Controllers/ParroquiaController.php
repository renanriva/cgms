<?php

namespace App\Http\Controllers;

use App\Parroquia;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ParroquiaController extends Controller
{
    public function index(){

        return view('lms.admin.location.parroquia.index');

    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {

        $parroquias = Parroquia::select([
            'parroquias.id as id',
            'provinces.name as province_name',
            'cantons.name as canton_name',
            'parroquias.name as parroquia_name',
            ])
            ->leftJoin('cantons','parroquias.canton_id', '=' ,'cantons.id')
            ->leftJoin('provinces','cantons.province_id', '=' ,'provinces.id');

        return Datatables::of($parroquias)
            ->editColumn('action', 'lms.admin.location.parroquia.action')
            ->make(true);

    }


}
