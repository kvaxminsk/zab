<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

//        var_dump(User::getCurrentUser()->isRoleAdmin());die();
        $request->user()->authorizeRoles(['user', 'manager', 'admin']);
        $user = User::getCurrentUser();
        return view('home', []);
    }
}
