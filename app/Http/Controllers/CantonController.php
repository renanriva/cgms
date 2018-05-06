<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use Yajra\DataTables\Facades\DataTables;
use App\Canton;

class CantonController extends Controller
{
    public function index(){

        return view('lms.admin.location.canton.index');

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
            ->make(true);

    }


}
