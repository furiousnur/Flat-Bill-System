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
        'user_id'
    ];

    public function houses()
    {
        return $this->hasMany(Building::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
