<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');

        App::setLocale('en');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::check()){
            $user = Auth::user()->toArray();
            
            if ($user['role'] == 'teacher') {
                return redirect(url('/admin/portfolio'));
            } else {
                return view('home');
            }

        } else{
            return response()->redirectTo(url('login'));
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unauthorized(){

        return view('lms.admin.error.403');
    }
}
