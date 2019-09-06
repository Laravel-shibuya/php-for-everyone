<?php

namespace App\Domain\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Domain\Eloquent\Post
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domain\Eloquent\User $author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Eloquent\Post whereUserId($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];

    public function isWrittenBy(User $user): bool
    {
        return $this->user_id === $user->id;
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
