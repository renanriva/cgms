<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{


    public function index(){


        $title = 'Profile '.env('APP_NAME') ;

//        dd($title);
        return view('lms.admin.profile.account', ['title'=> $title]);

    }

    public function changePassword(){


        $title = 'Change Password '.env('APP_NAME') ;

        return view('lms.admin.profile.password', ['title'=> $title]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request){


        $v = $this->validate($request, [
            'password' => 'required|max:20|min:3|confirmed',
            'password_confirmation' => 'required|min:3',
        ]);

        if ($v){

            $posts  = $request->all();

            $user = Auth::user();

            $user->password = bcrypt($posts['password']);
            $user->save();

            return redirect()->back()->with('message', 'Password Changed');


            // update password
        } else {


            return redirect()->back()->withErrors($v)->withInput();

        }

    }

    public function restPassword(){

    }
}
