<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CategoryModel
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $parent_id
 * @property-read \App\Models\CategoryModel|null $parents
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereParentId($value)
 * @mixin \Eloquent
 */
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
