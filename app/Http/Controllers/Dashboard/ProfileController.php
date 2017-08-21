<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfilePage(Request $request, $id = null)
    {

//        $request->user()->authorizeRoles(['user', 'manager', 'admin']);
        $id = ($id) ? $id : User::getCurrentUser()->id;

        $user = User::find($id);
//        var_dump($user);
//        die();
//        if (!$user) {
//            App::abort(404);
//        }
//        die('fdsaf');
        return view('dashboard.profile.profilePage', [
            'user' => $user
        ]);

    }


    public function editProfilePage(Request $request)
    {
//        $request->user()->authorizeRoles(['user', 'manager', 'admin']);
        \Auth::user();

        var_dump('fads');die();
//        return redirect('showProfilePages');
    }
//    public function showProfilePage($id = null)
//    {
//        $id = ($id) ? $id : $this->getAuthUserId();
//        $user = Blogger::with('blogs')->find($id);
//
//        if(!$user) {
//            App::abort(404);
//        }
//
//        return view('dashboard.blogger.pages.profile.profilePage', [
//            'user' => $user,
//            'blogs' => $user->blogs
//        ]);
//    }
}
