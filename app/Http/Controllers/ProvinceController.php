<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use Yajra\DataTables\Facades\DataTables;

class ProvinceController extends Controller
{
    public function index(){

        return view('lms.admin.location.province.index');

    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {

        $provinces = Province::select([
            'provinces.id',
            'provinces.name',
            \DB::raw('count(cantons.province_id) as count'),
//            'provinces.created_at',
//            'provinces.updated_at'
        ])->join('cantons','cantons.province_id', '=' ,'provinces.id')
            ->groupBy('cantons.province_id');

        return Datatables::of($provinces)
            ->editColumn('action', 'lms.admin.location.province.action')
            ->make(true);

    }


}
