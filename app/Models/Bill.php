<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\HouseOwner;
use App\Models\Flat;
use App\Models\BillCategory;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_owner_id',
        'flat_id',
        'bill_category_id',
        'month',
        'amount',
        'due_amount',
        'notes',
        'status',
    ];

    public function houseOwner()
    {
        return $this->belongsTo(HouseOwner::class);
    }

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }

    public function billCategory()
    {
        return $this->belongsTo(BillCategory::class);
    }

    public function payments()
    {
        return $this->hasMany(BillPayment::class, 'bill_id');
    }
}
