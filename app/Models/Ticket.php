<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

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

    public static function createWithRetry(array $data, int $maxAttempts = 5): self
    {
        for ($i = 0; $i < $maxAttempts; $i++) {
            try {
                return static::create($data);
            } catch (QueryException $e) {
                if (str_contains($e->getMessage(), 'tickets_ticket_code_unique') || $e->getCode() === '23000') {
                    $data['ticket_code'] = 'TKT-' . strtoupper(Str::random(8));
                    continue;
                }
                throw $e;
            }
        }

        throw new \RuntimeException("Failed to generate a unique ticket code after {$maxAttempts} attempts.");
    }
}
