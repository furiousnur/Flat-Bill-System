<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Building;

class HouseOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact',
    ];

    public function houses()
    {
        return $this->hasMany(Building::class);
    }
}
