<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Landlord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city_id',
        'user_id',
        'phone',
        'email',
        'website',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'city_id',
        'user_id',
    ];


    /**
     * Get main City in which this Landlord operates.
     */
    public function city() : Relation
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get User which added this Landlord
     */
    public function user() : Relation
    {
        return $this->belongsTo(User::class);
    }
}
