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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'forumable_id',
    ];


    /**
     * Get City/University to which this Forum concerns.
     */
    public function forumable() : ?Relation
    {
        return $this->morphTo('forumable');
    }

    /**
     * Get Posts of this Forum.
     */
    public function posts() : ?Relation
    {
        return $this->hasMany(Post::class);
    }


    public function scopeCityUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'city', $uuid);
    }

    public function scopeSearch(Builder $query, string $search) : Builder
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhereHas('city', fn ($q) =>
                $q->where('name', 'like', '%' . $search . '%')
            );
    }
}
