<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\AdvertModel;
use App\Models\AdvertsStatusModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = \Auth::user();
        $adverts = AdvertModel::where('adverts_status_id', AdvertsStatusModel::getAdvertsStatusPublish())->paginate(10);
        return view('dashboard.adverts.showNewAdverts', ['adverts' => $adverts]);

    }
}
