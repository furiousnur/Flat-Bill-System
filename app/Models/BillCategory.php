<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\HouseOwner;
use App\Models\Bill;

class BillCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_owner_id',
        'name',
    ];

    public function scopeForOwner($query, $ownerId = null)
    {
        return $query->where('house_owner_id', $ownerId ?? auth()->user()->houseOwner->id);
    }

    public function houseOwner()
    {
        return $this->belongsTo(HouseOwner::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
