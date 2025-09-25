<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\HouseOwner;
use App\Models\Building;
use App\Models\Tenant;
use App\Models\Bill;
use App\Models\BillPayment;

class Flat extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_owner_id',
        'building_id',
        'flat_number',
        'flat_owner_name',
        'flat_owner_contact',
    ];

    public function houseOwner()
    {
        return $this->belongsTo(HouseOwner::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function billPayments()
    {
        return $this->hasMany(BillPayment::class);
    }
}
