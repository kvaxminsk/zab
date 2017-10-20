<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertsStatusModel extends Model
{
    protected $table = 'adverts_statuses';

    public $timestamps = false;

    public static function getAdvertsStatusPublish()
    {
        return AdvertsStatusModel::find(3)->id;
    }

    public static function getAdvertsStatusDeleted()
    {
        return AdvertsStatusModel::find(5)->id;
    }

}
