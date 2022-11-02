<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;

class Rate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'targetable_type',
        'targetable_id',
        'rateable_id',
        'value',
        'comment',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'targetable_id',
        'rateable_id',
        'user_id',
    ];


    /**
     * Get Rateable which this Rate rates.
     */
    public function rateable() : Relation
    {
        return $this->belongsTo(Rateable::class);
    }

    /**
     * Get the target of this Rate.
     */
    public function targetable() : Relation
    {
        return $this->morphTo();
    }

    /**
     * Get User which wrote this Rate.
     */
    public function user() : Relation
    {
        return $this->belongsTo(User::class);
    }
}
