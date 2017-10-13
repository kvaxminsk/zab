<?php

namespace App\Http\Controllers;

use App\Models\CityModel;
use App\Models\RegionModel;
use Illuminate\Http\Request;

class CountryController extends Controller
{
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
