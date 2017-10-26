<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdvertsImageModel
 *
 * @property int $id
 * @property int $advert_id
 * @property string $path
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\AdvertModel $advert
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertsImageModel whereAdvertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertsImageModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertsImageModel wherePath$value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertsImageModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertsImageModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertsImageModel whereUserId($value)
 * @mixin \Eloquent
 */
class AdvertsImageModel extends Model
{
    protected $table = "adverts_images";
    protected $fillable = ['advert_id', 'path', 'user_id','path_resize_image'];

    public function advert()
    {
        return $this->belongsTo(AdvertModel::class);
    }
}
