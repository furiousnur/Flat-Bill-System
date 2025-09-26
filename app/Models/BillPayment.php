<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Bill;

class BillPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_owner_id',
        'bill_id',
        'amount',
        'payment_method',
        'paid_at',
    ];

    public function scopeForOwner($query, $ownerId = null)
    {
        return $query->where('house_owner_id', $ownerId ?? auth()->user()->houseOwner->id);
    }
    
    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
