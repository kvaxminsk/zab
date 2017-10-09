<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertsImageModel extends Model
{
    protected $table="adverts_images";
    protected $fillable = ['advert_id', 'filename'];

    public function advert()
    {
        return $this->belongsTo(AdvertModel::class);
    }
}
