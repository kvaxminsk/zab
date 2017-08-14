<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{

    protected $table = "categories";

    public $fillable = ['name', 'description', 'parent_id'];

    public $timestamps = false;


    public function parents()
    {
        return $this->belongsTo(CategoryModel::class, 'parent_id', 'id');
    }

}
