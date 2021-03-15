<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\UserManagement
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $api_token
 * @property string $username
 * @property string $role
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserManagement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserManagement whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserManagement withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserManagement withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $avatar
 * @method static \Illuminate\Database\Eloquent\Builder|UserManagement whereAvatar($value)
 */
class UserManagement extends Model
{
    protected $table = "users";

    protected $primaryKey = "id";

}
