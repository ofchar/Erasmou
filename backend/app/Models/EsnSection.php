<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class EsnSection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city_id',
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
        'city_id',
        'city_university',
    ];


    /**
     * Get City in which EsnSection operates.
     */
    public function city() : ?Relation
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get University in which EsnSection operates.
     */
    public function university() : ?Relation
    {
        return $this->belongsTo(University::class);
    }
}
