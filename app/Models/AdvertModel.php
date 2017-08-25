<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AdvertModel extends Model
{
    protected $table = "adverts";

    public $fillable = ['title', 'user_id', 'category_id', 'description', 'status'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\CategoryModel','category_id');
    }
}
