<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserSocialAccountModel
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider_user_id
 * @property string $provider
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSocialAccountModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSocialAccountModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSocialAccountModel whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSocialAccountModel whereProviderUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSocialAccountModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSocialAccountModel whereUserId($value)
 * @mixin \Eloquent
 */
class UserSocialAccountModel extends Model
{
    protected $table = "user_social_account";
    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
