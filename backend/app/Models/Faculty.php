<?php

namespace App\Models;

use App\Helpers\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;

class Faculty extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'university_id',
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
        'university_id',
    ];


    /**
     * Get University of this faculty.
     */
    public function university() : Relation
    {
        return $this->belongsTo(University::class);
    }


    public function scopeUniversityUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'university', $uuid);
    }

    public function scopeSearch(Builder $query, string $search) : Builder
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhereHas('university', fn ($q) =>
                $q->where('name', 'like', '%' . $search . '%')
            );
    }
}
