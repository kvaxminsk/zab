<?php

namespace App\Http\Controllers;

use App\Models\CityModel;
use App\Models\CountryModel;
use App\Models\RegionModel;

class CountryController extends Controller
{

    public function jsonCountries()
    {
        $countries = CountryModel::all(['title_ru'])->sortBy('title_ru')->toArray();
//        var_dump($countries);die();
        foreach ($countries as $country) {
            $countriesTitle[] = $country['title_ru'];
        }
        return response()->json([$countriesTitle]);
    }
    public function jsonCities()
    {
        $cities = CityModel::where('country_id', 3)->get(['title_ru'])->sortBy('title_ru')->toArray();

        foreach ($cities as $city) {
            $citiesTitle[] = $city['title_ru'];
        }
//        var_dump(response()->json([$citiesTitle]));die();
        return response()->json([$citiesTitle]);
    }

    public function regions(\Request $request)
    {
//        die('fff');
        $request::get('country_id');
        $regions = RegionModel::where('country_id', $request::get('country_id'))->get(['title_ru', 'region_id'])->sortBy('title_ru')->toArray();
//        var_dump($regions);
//        die();
        return response()->json([
            'type' => 'success', 'regions' => $regions
        ]);
    }

    public function cities(\Request $request)
    {
        $request::get('country_id');
        $cities = CityModel::where('region_id', $request::get('region_id'))->get(['title_ru', 'city_id'])->sortBy('title_ru')->toArray();
        return response()->json([
            'type' => 'success', 'cities' => $cities
        ]);
    }
}
