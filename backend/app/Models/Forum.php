<?php

namespace App\Models;

use App\Helpers\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;

class Forum extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'forumable_type',
        'forumable_id',
        'name',
        'description',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'forumable_id',
        'user_id',
    ];


    /**
     * Get City/University to which this Forum concerns.
     */
    public function forumable() : ?Relation
    {
        return $this->morphTo();
    }

    /**
     * Get Posts of this Forum.
     */
    public function posts() : ?Relation
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Creator (user) of this Forum.
     */
    public function user() : Relation
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get latest Post of this Forum.
     */
    public function post() : ?Relation
    {
        return $this->hasOne(Post::class)->orderBy('created_at', 'desc');
    }


    public function scopeForumableUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseMorphUuidScope($query, 'forumable', $uuid);
    }

    public function scopeUserUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'user', $uuid);
    }

    public function scopeSearch(Builder $query, string $search) : Builder
    {
        return $query->where('name', 'like', '%' . $search . '%');
            // ->orWhereHas('city', fn ($q) =>
            //     $q->where('name', 'like', '%' . $search . '%')
            // );
    }
}
