<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsersImageModel;
use Illuminate\Support\Facades\Input;


class ProfileController extends Controller
{
    public function showProfilePage(\Request $request, $id = null)
    {
        $user = \Auth::user();
        return view('dashboard.profile.profilePage', [
            'user' => $user
        ]);

    }


    public function editProfilePage(\Request $request)
    {
//        $request->user()->authorizeRoles(['user', 'manager', 'admin']);
        $user = \Auth::user();
        try {
            $usersImagePath = UsersImageModel::where('user_id', $user->id)->orderBy('id','desc')->first()->path;
        }
        catch (\ErrorException $e){
            $usersImagePath = 'https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png';
        }

//        var_dump($usersImagePath);die();
//        return redirect('showProfilePages');
        return view('dashboard.profile.editProfilePage', [
            'user' => $user,
            'image_path' => $usersImagePath,
        ]);
    }

    public function postEditProfile(\Request $request)
    {
        $user = \Auth::user();

        $rules = array(
            'name' => 'required:min:6:max50',
            'username' => 'required:min:6:max50',
//            'phone' => 'integer',
//            'country_id' => 'integer:min:1',
//            'city_id' => 'integer:min:1'
        );

        $validation = \Validator::make(Input::all(), $rules);
        if ($validation->passes()) {

            $userModel = User::find($user->id);
            $userModel->save();

            $image = $request::file('image');
//            var_dump($image);die();
            $userHash = base64url_encode(strcode($user->email, 'zabiraydarom_user'));


            $path = $userHash . '/profile/' . base64url_encode(strcode($image->getClientOriginalName(), 'zabiraydarom_user_image')) . '.' . $image->getClientOriginalExtension();
            $storageImage = \Storage::put($path, file_get_contents($image));
            $imgResize = \Image::make(\Storage::url($path));
            $imgResize->resize(100,100);
            $pathResize = $userHash . '/profile/' . base64url_encode(strcode($image->getClientOriginalName(), 'zabiraydarom_user_image')) . '_resize.' . $image->getClientOriginalExtension();
            $imgResize->save( '/public/images/' . $pathResize);

            if ($image) {
                UsersImageModel::create(
                    [
                        'user_id' => $userModel->id,
                        'path' => $pathResize
                    ]
                );
            }

            return redirect(route('editUserProfilePage'));
        } else {
            var_dump($validation->messages());
            die();
            return redirect(route('editUserProfilePage'))->withErrors('проверьте данные');
        }
//        return $request;
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
