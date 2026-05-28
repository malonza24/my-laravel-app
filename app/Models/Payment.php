<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'parent_id',
        'child_id',
        'phone_number',
        'amount',
        'payment_method',
        'mpesa_transaction_id',
        'status',
        'paid_at',
        'decline_reason',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function parent()
    {
        return $this->belongsTo(ParentGuardian::class, 'parent_id');
    }

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }
}