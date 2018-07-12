<?php

namespace App\Http\Controllers;

use App\Category;
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

        $all = $this->repo->getAll();

        $category['type'] = $all->where('type', true);

//        dd($category);

        return view('lms.admin.category.index', [ 'title'=> 'Category', 'category' => $category]);

    }

    public function create(){


        $all = $this->repo->getAll();

        $category['type'] = $all->where('type', true);

//        dd($category);


        return view('lms.admin.category.create', [ 'title'=> 'Category', 'category' => $category]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function insert(Request $request){

        $post = $request->all();


        $category = null;

        if ($post['type'] == 'type'){

            $data['title'] = $post['title'];
            $data['type'] = true;
            $data['label'] = false;
            $data['sub_label'] = false;
            $data['knowledge'] = false;
            $data['subject'] = false;

            $category = $this->repo->insert($data);

        }


        return response()->json(['data' => $category])->setStatusCode(201);

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
