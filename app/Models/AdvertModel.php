<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AdvertModel
 *
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property int $category_id
 * @property string $description
 * @property string $deleted_at
 * @property int $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\CategoryModel $category
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertModel whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertModel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertModel whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AdvertModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AdvertModel withoutTrashed()
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AdvertModel onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertModel whereDeletedAt($value)
 */
class AdvertModel extends Model
{
    use SoftDeletes;

    protected $table = "adverts";

    protected $dates = ['deleted_at'];

    public $fillable = ['title', 'user_id', 'category_id', 'description', 'address', 'adverts_status_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\CategoryModel', 'category_id');
    }

    public function status()
    {
        return $this->belongsTo(AdvertsStatusModel::class, 'adverts_status_id', 'id');
    }

    public function image_latest()
    {
        return $this->hasOne(AdvertsImageModel::class, 'advert_id')->latest();
//        return $this->hasOne(UsersImageModel::class, 'user_id')->latest();
    }
}
