<?php

namespace App\Http\Controllers;

use App\Models\AdvertModel;
use App\Models\AdvertsStatusModel;
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
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $advertsFirst = AdvertModel::take(6)->where('adverts_status_id', AdvertsStatusModel::getAdvertsStatusPublish())->orderBy('updated_at','DESC')->get();
//        $advertsSecond = AdvertModel::take(3)->where('adverts_status_id', AdvertsStatusModel::getAdvertsStatusPublish())->orderBy('updated_at','DESC')->get();
//        $advertsSecond = AdvertModel::skip(3)->take(3)->get();
//        $advertsThird = AdvertModel::skip(6)->take(3)->get();
////        var_dump(User::getCurrentUser()->isRoleAdmin());die();
//        $request->user()->authorizeRoles(['user', 'manager', 'admin']);
//        $user = User::getCurrentUser();
//        var_dump('ddd');
        return view('welcome', [
            'adverts_first' => $advertsFirst,
//            'adverts_second' => $advertsSecond,
//            'adverts_third' => $advertsThird,
        ]);
    }
}
