<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AdvertModel;

class AdvertsController extends Controller
{
    public function showUserAdverts(\Request $request)
    {
        $user = \Auth::user();
        $adverts = AdvertModel::where('user_id', $user->id)->paginate(10);
//        var_dump($user->adverts);
//        die();
        return view('dashboard.adverts.showUserAdvert', ['adverts' => $adverts, 'user' => $user]);
    }
    public function deleteAdvert(\Request $request, $id)
    {
        var_dump('dafr');die();
    }
}
