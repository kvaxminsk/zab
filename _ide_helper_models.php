<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models {
    /**
     * App\Models\CategoryModel
     *
     * @property int $id
     * @property string $name
     * @property string|null $description
     * @property int|null $parent_id
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereParentId($value)
     */
    class CategoryModel extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\Role
     *
     * @property int $id
     * @property string $name
     * @property string $description
     * @property \Carbon\Carbon|null $created_at
     * @property \Carbon\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
     */
    class Role extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\User
     *
     * @property int $id
     * @property string $name
     * @property string $email
     * @property string $password
     * @property string|null $remember_token
     * @property \Carbon\Carbon|null $created_at
     * @property \Carbon\Carbon|null $updated_at
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
     */
    class User extends \Eloquent
    {
    }
}

