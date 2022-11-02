<?php

namespace App\Models;

use App\Helpers\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;

class Post extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'forum_id',
        'user_id',
        'title',
        'body',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'forum_id',
        'user_id',
    ];


    /**
     * Get Forum to which this Post belongs.
     */
    public function forum() : Relation
    {
        return $this->belongsTo(Forum::class);
    }

    /**
     * Get User which sent this Post.
     */
    public function user() : Relation
    {
        return $this->belongsTo(User::class);
    }


    public function scopeForumUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'forum', $uuid);
    }

    public function scopeUserUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'user', $uuid);
    }

    public function scopeSearch(Builder $query, string $search) : Builder
    {
        return $query->where('name', 'like', '%' . $search . '%');
    }
}
