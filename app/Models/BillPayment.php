<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Bill;

class BillPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'amount',
        'payment_method',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
