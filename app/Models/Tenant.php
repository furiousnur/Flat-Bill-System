<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\HouseOwner;
use App\Models\Building;
use App\Models\Flat;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact',
        'house_owner_id',
        'building_id',
        'flat_id',
    ];

    public function houseOwner()
    {
        return $this->belongsTo(HouseOwner::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }
}
