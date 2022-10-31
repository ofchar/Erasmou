<?php

namespace App\Models;

use App\Helpers\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'city_id',
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
    ];


    /**
     * Get City which this Forum concerns.
     */
    public function city() : ?Relation
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get Posts of this Forum.
     */
    public function posts() : ?Relation
    {
        return $this->hasMany(Post::class);
    }
}
