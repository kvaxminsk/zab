<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AdvertModel;
use App\Models\AdvertsActiveStatusModel;
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

        $advertModel->status = 5;
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
        $advertsActiveStatuses = AdvertsActiveStatusModel::all()->pluck('title', 'id');
        $images = AdvertsImageModel::where('advert_id', $advert_id)->get();

//        $countries[0] = 'Выберите страну';
//        $countries += CountryModel::all(['title_ru', 'country_id'])->sortBy('title_ru')->pluck('title_ru', 'country_id')->toArray();
//        if ($user->region_id || $advert->region_id) {
//            $user->region_id = $advert->region_id ? $advert->region_id : $user->region_id;
//            $user->country_id = $advert->country_id ? $advert->country_id : $user->country_id;
//            $regions = RegionModel::where('country_id', $user->country_id)->get(['title_ru', 'region_id'])->sortBy('title_ru')->pluck('title_ru', 'region_id')->toArray();
////            $regions[0] += 'Выберите регион';
//        } else {
//            $regions[0] = 'Выберите регион';
//        }
//
//        if ($user->city_id || $advert->city_id) {
//            $user->city_id = $advert->region_id ? $advert->region_id : $user->city_id;
//            $cities = CityModel::where('region_id', $user->region_id)->get(['title_ru', 'city_id'])->sortBy('title_ru')->pluck('title_ru', 'city_id')->toArray();
////            $cities[0] += 'Выберите город';
//        } else {
//            $cities[0] = 'Выберите регион';
//        }
        if ($advert->city_id) {
            $city = CityModel::where('city_id', $advert->city_id)->first(['title_ru', 'city_id'])->title_ru;
        } else {
            $city = '';
        }
        return view('dashboard.adverts.editUserAdvert', [
                'advert' => $advert,
                'categories' => $categories,
                'images' => $images,
//                'countries' => $countries,
//                'regions' => $regions,
                'city' => $city,
                'user' => $user,
                'adverts_active_statuses' => $advertsActiveStatuses,
            ]
        );
    }

    public function addAdvert(\Request $request)
    {
        $user = \Auth::user();
        $categories = CategoryModel::whereNotNull('parent_id')->pluck('name', 'id');
        $countries[0] = 'Выберите страну';
        $advertsActiveStatuses = AdvertsActiveStatusModel::all()->pluck('title', 'id');
        if ($user->city_id) {
            $city = CityModel::where('city_id', $user->city_id)->first(['title_ru', 'city_id'])->title_ru;
        } else {
            $city = '';
        }
        return view('dashboard.adverts.addUserAdvert',
            [
                'categories' => $categories,
                'countries' => json_encode($countries),
                'city' => $city,
                'user' => $user,
                'adverts_active_statuses' => $advertsActiveStatuses,
            ]
        );
    }

    public function postAddAdvert(\Request $request)
    {

        $rules = array(
            'title' => 'required:min:4',
            'description' => 'required|min:10',
//            'images' => 'required',
            'adverts_active_status_id' => 'required:integer',
//            'country_id' => 'required:integer',
//            'region_id' => 'required:integer',
            'city_id' => 'required:string',
        );
        $input = Input::all();
        $input['user_id'] = \Auth::user()->id;
        $validation = \Validator::make(
            $input,
            $rules
        );

        $city = CityModel::where('title_ru', Input::get('city_id'))->first();
        $input['city_id'] = $city->city_id;
        $input['country_id'] = $city->country_id;
        $input['region_id'] = $city->region_id;
        if ($validation->passes()) {
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
            return redirect(route('addAdvert'))->withErrors($validation);
        }
        return redirect(route('editAdvert', ['advert_id' => $advert->id]))->withSucess('Данные успешно сохранены');
    }

    public function postEditAdvert(\Request $request, $advert_id)
    {
        $rules = array(
            'title' => 'required|min:4|max:50',
            'description' => 'required|min:10',
            'address' => 'required',
            'adverts_active_status_id' => 'integer',
//            'country_id' => 'integer',
//            'region_id' => 'required|integer',
            'city_id' => 'required|string',
        );
        $advert_id = (int)$request::get('advert_id');
        $input = Input::all();
        $validation = \Validator::make(
            $input,
            $rules
        );
        $advert = AdvertModel::find($advert_id);

        $city = CityModel::where('title_ru', Input::get('city_id'))->first();
        $input['city_id'] = $city->city_id;
        $input['country_id'] = $city->country_id;
        $input['region_id'] = $city->region_id;
//        var_dump($city->country_id);die();
        if ($validation->passes()) {
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
            return redirect(route('editAdvert', ['advert_id' => $advert->id]))->withErrors($validation);
        }
        return redirect(route('editAdvert', ['advert_id' => $advert->id]))->withSuccess('Данные успешно сохранены');
    }
}
