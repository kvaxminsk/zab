<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AdvertModel;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\Input;

class AdvertsController extends Controller
{
    public function showUserAdverts(\Request $request)
    {
        $user = \Auth::user();
        $adverts = AdvertModel::where('user_id', $user->id)->paginate(10);
//        var_dump($user->adverts);
//        die();
        return view('dashboard.adverts.showUserAdvert', ['adverts' => $adverts]);
    }

    public function deleteAdvert(\Request $request, $advert_id)
    {
//        AdvertModel::withTrashed()->where('id', $advert_id)->get();
        $advertModel = AdvertModel::where('id', $advert_id)->first();
        AdvertModel::destroy($advert_id);

        $advertModel->status = 4;
        $advertModel->save();
//        die('ffff');
        return \Redirect::back();
    }

    public function editAdvert(\Request $request, $advert_id)
    {
        $advert = AdvertModel::find($advert_id);
        $categories = CategoryModel::whereNotNull('parent_id')->pluck('name', 'id');
//        var_dump($categories);
        return view('dashboard.adverts.editUserAdvert', ['advert' => $advert, 'categories' => $categories]);
    }

    public function postEditAdvert(\Request $request)
    {
//        if ($request::has('images'))
        {
            $files = $request::file('images');
            foreach ($files as $file){
//                $filename = $file::getClientOriginalName();
                \Storage::put('fff/'.$file->getClientOriginalName(), file_get_contents($file));
            }
        }
die();
//        $rules = array(
//            'title' => 'required:min:4',
//            'description' => 'required|min:10',
//            'advert_id' => 'required|integer',
////            'email' => 'required|email|unique:users'
//        );
//        $validator = \Validator::make(
////            Input::all(),
//            Input::all(),
//            $rules
//        );
//        $user = \Auth::user();
        $advert = AdvertModel::find(Input::get('advert_id'));
//        $input  = Input::except('advert_id');
//        if ($validator->passes()) {
//            $advert->update($input);
//            $advert->save();
//        }
        return redirect(route('editAdvert', ['advert_id' => $advert->id]));
    }
}
