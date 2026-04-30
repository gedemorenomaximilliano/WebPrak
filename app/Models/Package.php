<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'destination',
        'price',
        'image',
        'description',
        'itinerary',
        'is_popular',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'itinerary' => 'array',
        'is_popular' => 'boolean',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
