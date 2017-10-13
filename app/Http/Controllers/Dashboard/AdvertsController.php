<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AdvertModel;
use App\Models\AdvertsImageModel;
use App\Models\CategoryModel;
use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\RegionModel;
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
        $user = \Auth::user();
        $advert = AdvertModel::find($advert_id);
        $categories = CategoryModel::whereNotNull('parent_id')->pluck('name', 'id');
        $images = AdvertsImageModel::where('advert_id', $advert_id)->get();

        $countries[0] = 'Выберите страну';
        $countries += CountryModel::all(['title_ru', 'country_id'])->sortBy('title_ru')->pluck('title_ru', 'country_id')->toArray();
        if ($user->region_id) {

            $regions = RegionModel::where('country_id', $user->country_id)->get(['title_ru', 'region_id'])->sortBy('title_ru')->pluck('title_ru', 'region_id')->toArray();
//            $regions[0] += 'Выберите регион';
        } else {
            $regions[0] = 'Выберите регион';
        }

        if ($user->city_id) {

            $cities = CityModel::where('region_id', $user->region_id)->get(['title_ru', 'city_id'])->sortBy('title_ru')->pluck('title_ru', 'city_id')->toArray();
//            $cities[0] += 'Выберите город';
        } else {
            $cities[0] = 'Выберите регион';
        }

        return view('dashboard.adverts.editUserAdvert', [
                'advert' => $advert,
                'categories' => $categories,
                'images' => $images,
                'countries' => $countries,
                'regions' => $regions,
                'cities' => $cities,
                'user' => $user,
            ]
        );
    }

    public function addAdvert(\Request $request)
    {
        $user = \Auth::user();
        $categories = CategoryModel::whereNotNull('parent_id')->pluck('name', 'id');
        $countries[0] = 'Выберите страну';
        $countries += CountryModel::all(['title_ru', 'country_id'])->sortBy('title_ru')->pluck('title_ru', 'country_id')->toArray();
//        var_dump($regions);
        if ($user->region_id) {

            $regions = RegionModel::where('country_id', $user->country_id)->get(['title_ru', 'region_id'])->sortBy('title_ru')->pluck('title_ru', 'region_id')->toArray();
//            $regions[0] += 'Выберите регион';
        } else {
            $regions[0] = 'Выберите регион';
        }

        if ($user->city_id) {

            $cities = CityModel::where('region_id', $user->region_id)->get(['title_ru', 'city_id'])->sortBy('title_ru')->pluck('title_ru', 'city_id')->toArray();
//            $cities[0] += 'Выберите город';
        } else {
            $cities[0] = 'Выберите регион';
        }
        return view('dashboard.adverts.addUserAdvert',
            [
                'categories' => $categories,
                'countries' => $countries,
                'regions' => $regions,
                'cities' => $cities,
                'user' => $user,
            ]
        );
    }

    public function postAddAdvert(\Request $request)
    {

        $rules = array(
            'title' => 'required:min:4',
            'description' => 'required|min:10',
            'images' => 'required',
            'country_id' => 'required:integer',
            'region_id' => 'required:integer',
            'city_id' => 'required:integer',
        );
        $input = Input::all();
        $input['user_id'] = \Auth::user()->id;
        $validator = \Validator::make(
//            Input::all(),
            $input,
            $rules
        );

        if ($validator->passes()) {
            $user = \Auth::user();

            $advert = AdvertModel::create(
                $input
            );
            $files = $request::file('images');
            foreach ($files as $file) {

                $userHash = base64url_encode(strcode($user->email, 'zabiraydarom_user'));
                $path = $userHash . '/' . $advert->id . '/' . base64url_encode(strcode($file->getClientOriginalName(), 'zabiraydarom_advert')) . '.' . $file->getClientOriginalExtension();
                \Storage::put($path, file_get_contents($file));
                AdvertsImageModel::create([
                    'advert_id' => $advert->id,
                    'path' => $path,
                    'user_id' => $user->id,
                ]);
            }
        } else {
            return redirect(route('addAdvert'));
        }
        return redirect(route('editAdvert', ['advert_id' => $advert->id]));
    }

    public function postEditAdvert(\Request $request)
    {
        $rules = array(
            'title' => 'required:min:4:max:50',
            'description' => 'required|min:10',
            'address' => 'string',
        );
        $advert_id = (int)$request::get('advert_id');
        $input = Input::all();
        $validator = \Validator::make(
//            Input::all(),
            $input,
            $rules
        );
//        var_dump($validator->messages());die();
        $advert = AdvertModel::find($advert_id);
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
                        'path' => $path,
                        'user_id' => $user->id,
                    ]);
                }
            }
        } else {
            return redirect(route('editAdvert', ['advert_id' => $advert->id]));
        }
        return redirect(route('editAdvert', ['advert_id' => $advert->id]));
    }
}
