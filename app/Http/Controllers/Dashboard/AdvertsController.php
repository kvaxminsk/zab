<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AdvertModel;
use App\Models\AdvertsImageModel;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\Input;

class AdvertsController extends Controller
{
    public function showUserAdverts(\Request $request)
    {
        $user = \Auth::user();
        $adverts = AdvertModel::where('user_id', $user->id)->paginate(10);
        return view('dashboard.adverts.showUserAdvert', ['adverts' => $adverts]);
    }

    public function deleteAdvert(\Request $request, $advert_id)
    {
        $advertModel = AdvertModel::where('id', $advert_id)->first();
        AdvertModel::destroy($advert_id);

        $advertModel->status = 4;
        $advertModel->save();
        return \Redirect::back();
    }

    public function deleteAdvertImage(\Request $request, $image_id)
    {
        AdvertsImageModel::destroy($image_id);
        return \Redirect::back();
    }

    public function editAdvert(\Request $request, $advert_id)
    {
        $advert = AdvertModel::find($advert_id);
        $categories = CategoryModel::whereNotNull('parent_id')->pluck('name', 'id');
        $images = AdvertsImageModel::where('advert_id', $advert_id)->get();
        return view('dashboard.adverts.editUserAdvert', ['advert' => $advert, 'categories' => $categories, 'images' => $images]);
    }

    public function addAdvert(\Request $request)
    {
        $categories = CategoryModel::whereNotNull('parent_id')->pluck('name', 'id');
        return view('dashboard.adverts.addUserAdvert', ['categories' => $categories]);
    }

    public function postAddAdvert(\Request $request)
    {
        $categories = CategoryModel::whereNotNull('parent_id')->pluck('name', 'id');

        $rules = array(
            'title' => 'required:min:4',
            'description' => 'required|min:10',
            'images' => 'required',
        );
        $input = Input::all();
        $validator = \Validator::make(
//            Input::all(),
            $input,
            $rules
        );

        if ($validator->passes()) {
            $user = \Auth::user();

            $advert = AdvertModel::create(
                [
                    'title' => $input['title'],
                    'description' => $input['description'],
                    'category_id' => $input['category_id'],
                    'user_id' => $user->id,
                ]
            );
            $files = $request::file('images');
            foreach ($files as $file) {

                $userHash = base64url_encode(strcode($user->email, 'zabiraydarom_user'));
                $path = $userHash . '/' . $advert->id . '/' . base64url_encode(strcode($file->getClientOriginalName(), 'zabiraydarom_advert')) . '.' . $file->getClientOriginalExtension();
                \Storage::put($path, file_get_contents($file));
                AdvertsImageModel::create([
                    'advert_id' => $advert->id,
                    'filename' => $path,
                    'user_id' => $user->id,
                ]);
            }
        }
        else {
            return redirect(route('addAdvert'));
        }
        return redirect(route('editAdvert', ['advert_id' => $advert->id]));
    }

    public function postEditAdvert(\Request $request)
    {
//    $categories = CategoryModel::whereNotNull('parent_id')->pluck('name', 'id');
//        var_dump();
//        die();
        $rules = array(
            'title' => 'required:min:4:max:50',
            'description' => 'required|min:10',
        );
        $advert_id = (int)$request::get('advert_id');
        $input = Input::all();
        $validator = \Validator::make(
//            Input::all(),
            $input,
            $rules
        );
//        var_dump($validator->messages());die();
        $advert = AdvertModel::find( $advert_id);
        if ($validator->passes()) {
            $user = \Auth::user();

            $advert->update($input);
            $advert->save();
            $files = $request::file('images');
            if ($files) {
                foreach ($files as $file) {

                    $userHash = base64url_encode(strcode($user->email, 'zabiraydarom_user'));
                    $path = $userHash . '/' . $advert->id . '/' . base64url_encode(strcode($file->getClientOriginalName(), 'zabiraydarom_advert')) . '.' . $file->getClientOriginalExtension();
                    \Storage::put($path, file_get_contents($file));
                    AdvertsImageModel::create([
                        'advert_id' => $advert->id,
                        'filename' => $path,
                        'user_id' => $user->id,
                    ]);
                }
            }
        }
        else {
            return redirect(route('editAdvert', ['advert_id' => $advert->id]));
        }
        return redirect(route('editAdvert', ['advert_id' => $advert->id]));
    }
}
