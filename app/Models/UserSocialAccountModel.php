<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialAccountModel extends Model
{
    protected $table = "user_social_account";
    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
