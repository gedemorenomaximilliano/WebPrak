<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'pax_count',
        'payment_method',
        'phone',
        'first_name',
        'last_name',
        'email',
        'status',
        'amount',
        'travel_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }
}
