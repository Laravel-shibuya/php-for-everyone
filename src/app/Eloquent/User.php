<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Eloquent\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Eloquent\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Eloquent\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Eloquent\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Eloquent\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Eloquent\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Eloquent\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Eloquent\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Eloquent\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Eloquent\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Eloquent\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Eloquent\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $screen_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Eloquent\Post[] $posts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Eloquent\User whereScreenName($value)
 * @property string $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Eloquent\User whereProfile($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'screen_name', 'password', 'profile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
