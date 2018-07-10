<?php

namespace App\Http\Controllers;

use App\Repository\CategoryRepository;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    private  $repo;

    public function __construct()
    {
        $this->repo = new CategoryRepository();

    }

    public function index(){

    }

    /**
     * @param Request $request
     */
    public function insert(Request $request){

    }

    /**
     * @param Request $request
     * @param         $id
     */
    public function update(Request $request, $id){

    }

    /**
     * @param $id
     */
    public function delete($id){

    }

    /**
     * @return mixed
     */
    public function getTypeList(){

        return $this->repo->getTypeList();
    }

    /**
     * @param $type
     * @param $parent_id
     * @return mixed
     */
    public function getListByType($type, $parent_id){

        return $this->getListByType($type, $parent_id);

    }

}
