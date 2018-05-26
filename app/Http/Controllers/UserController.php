<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{


    public function index(){

        $title = 'User Management - '. env('APP_NAME');
        return view('lms.admin.user.index',
            ['title' => $title]);

    }


    public function getTableData(){

        $users = User::latest()->get();

        return Datatables::of($users)
            ->editColumn('action', 'lms.admin.user.action')
            ->setRowId(function ($users){
                return 'user_id_'.$users->id;
            })
            ->make(true);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){

        $user = new User();

        $post = $request->all();

        $user->name           = $post['name'];
        $user->email        = $post['email'];
        $user->role        = $post['role'];
        $user->status        = $post['status'];
        $user->password     = bcrypt($post['email']);
        $user->creation_type        = USER_CREATION_TYPE_CMS;
        $user->save();

        return response()->json(['user' => $user])->setStatusCode(201);

    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){

        $user = User::find($id);

//        return response()->json(['user' => $id])->setStatusCode(200);


        if ($user){

            $post = $request->all();

            $user->name     = $post['name'];
            $user->email    = $post['email'];
            $user->status   = $post['status'] == 'active' ? USER_STATUS_ACTIVE : USER_STATUS_INACTIVE;
            $user->save();

            return response()->json(['user' => $user])->setStatusCode(200);


        }

        return response()->json(['message' => 'User not found'])->setStatusCode(404);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){


        $user = User::findOrFail($id);
        $user->delete();

        return response()->json()->setStatusCode(204);

    }

    public function updateStatus(){

    }

    /**
     * Admin change uses password
     */
    public function changePassword(){

    }

}
