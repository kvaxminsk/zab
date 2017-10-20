<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\RegionModel;
use App\Models\User;
use App\Models\UsersImageModel;
use Illuminate\Support\Facades\Input;


class ProfileController extends Controller
{
    public function showProfilePage(\Request $request, $id = null)
    {
        if ($id) {
            $user = User::find($id);
//            var_dump($user->social_vk);
//            die();
            if ($user) {
                return view('dashboard.profile.profilePage', [
                    'user' => $user,

                ]);
            } else {
                return redirect(route('dashboard'));
            }
        } else {
            $user = \Auth::user();

            return view('dashboard.profile.profilePage', [
                'user' => $user,

            ]);
        }


    }



    public function editProfilePage(\Request $request)
    {
//        $request->user()->authorizeRoles(['user', 'manager', 'admin']);
        $user = \Auth::user();
        try {
            $usersImagePath = UsersImageModel::where('user_id', $user->id)->orderBy('id', 'desc')->first()->path;
        } catch (\ErrorException $e) {
            $usersImagePath = null;
        }

        $countries = CountryModel::all(['title_ru', 'country_id'])->sortBy('title_ru')->pluck('title_ru', 'country_id')->toArray();
        if ($user->country_id) {
            $regions[0] = 'Выберите регион';
            $regions += RegionModel::where('country_id', $user->country_id)->get(['title_ru', 'region_id'])->sortBy('title_ru')->pluck('title_ru', 'region_id')->toArray();
//            array_unshift($regions, 'Выберите регион');
//            asort($regions);
        } else {
            $regions = ['0' => 'Выберите регион'];
        }

        if ($user->region_id) {
            $cities[0] = 'Выберите город';
            $cities += CityModel::where('region_id', $user->region_id)->get(['title_ru', 'city_id'])->sortBy('title_ru')->pluck('title_ru', 'city_id')->toArray();
        } else {
            $cities[0] = 'Выберите город';
        }

//        var_dump($cities);
//        die('fdsaf');
//        return redirect('showProfilePages');
        return view('dashboard.profile.editProfilePage', [
            'user' => $user,
            'image_path' => $usersImagePath,
            'countries' => $countries,
            'regions' => $regions,
            'cities' => $cities,
        ]);
    }

    public function postEditProfile(\Request $request)
    {
        $user = \Auth::user();

        $rules = array(
            'name' => 'required:min:6:max50',
            'username' => 'required:min:6:max50',
            'phone' => 'integer',
            'country_id' => 'integer',
            'region_id' => 'integer',
            'city_id' => 'integer'
        );

        $validation = \Validator::make(Input::all(), $rules);
        if ($validation->passes()) {

            $userModel = User::find($user->id);

            $userModel->update(Input::all());
            $userModel->save();
//            var_dump(Input::all());die();
//            var_dump($userModel->phone);die();
            $image = $request::file('image');
//            var_dump($image);die();
            if ($image) {

                $userHash = base64url_encode(strcode($user->email, 'zabiraydarom_user'));


                $path = $userHash . '/profile/' . base64url_encode(strcode($image->getClientOriginalName(), 'zabiraydarom_user_image')) . '.' . $image->getClientOriginalExtension();
                $storageImage = \Storage::put($path, file_get_contents($image));
                $imgResize = \Image::make($image->getRealPath());
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('img/products/' . $filename);

                $imgResize->resize(150, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path);
                $pathResize = $userHash . '/profile/' . base64url_encode(strcode($image->getClientOriginalName(), 'zabiraydarom_user_image')) . '_resize.' . $image->getClientOriginalExtension();
                $storageImageResize = \Storage::put($pathResize, file_get_contents($path));
                if ($storageImageResize) {
                    UsersImageModel::create(
                        [
                            'user_id' => $userModel->id,
                            'path' => $pathResize
                        ]
                    );
                }
            }

            return redirect(route('editUserProfilePage'));
        } else {
            var_dump($validation->messages());
//            die();
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
