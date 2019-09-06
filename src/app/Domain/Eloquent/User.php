<?php

namespace App\Domain\Eloquent;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Domain\Eloquent\User
 *
 * @property int $id
 * @property string $screen_name
 * @property string $name
 * @property string $profile
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Eloquent\Post[] $posts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\User whereProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\User whereScreenName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\User whereUpdatedAt($value)
 * @mixin \Eloquent
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
