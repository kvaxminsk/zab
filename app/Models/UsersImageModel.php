<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UsersImageModel
 *
 * @property int $id
 * @property int $user_id
 * @property string $path
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersImageModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersImageModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersImageModel wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersImageModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersImageModel whereUserId($value)
 * @mixin \Eloquent
 */
class UsersImageModel extends Model
{
    protected $table = 'users_images';

    protected $fillable = ['path', 'user_id'];
}
