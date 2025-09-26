<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\HouseOwner;
use App\Models\Flat;
use App\Models\Tenant;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_owner_id',
        'name',
        'address',
    ];

    public function scopeForOwner($query, $ownerId = null)
    {
        return $query->where('house_owner_id', $ownerId ?? auth()->user()->houseOwner->id);
    }

    public function houseOwner()
    {
        return $this->belongsTo(HouseOwner::class);
    }

    public function flats()
    {
        return $this->hasMany(Flat::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }
}
