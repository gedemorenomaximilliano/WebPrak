<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_code',
        'transaction_id',
        'status',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
