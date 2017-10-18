<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\AdvertModel;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class AdvertsController extends Controller
{
    public function category(Request $request,$categoryId)
    {
        if($categoryId) {
            $adverts = AdvertModel::where('category_id', $categoryId)->paginate(10);
        }else {

            $adverts = AdvertModel::paginate(10);
        }

        $categories = CategoryModel::whereNotNull('parent_id')->get();
//        var_dump($categories);die();
//        var_dump(User::getCurrentUser()->isRoleAdmin());die();
//        $request->user()->authorizeRoles(['user', 'manager', 'admin']);
//        $user = User::getCurrentUser();
//        var_dump('ddd');
        return view('category', [
            'adverts' => $adverts,
            'categories' => $categories,
            'category_id' => $categoryId,
        ]);
    }

    public function showAdvert(Request $request,$advert_id)
    {

        if($advert_id) {
            $advert = AdvertModel::where('id', $advert_id)->first();
        }else {

           return \Redirect::back();
        }
//        var_dump($advert->images);die();
        $categories = CategoryModel::whereNotNull('parent_id')->get();
//        var_dump($categories);die();
//        var_dump(User::getCurrentUser()->isRoleAdmin());die();
//        $request->user()->authorizeRoles(['user', 'manager', 'admin']);
//        $user = User::getCurrentUser();
//        var_dump('ddd');
        return view('advert', [
            'advert' => $advert,
        ]);
    }
}
