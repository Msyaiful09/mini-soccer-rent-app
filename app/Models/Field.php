<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // relation to Play Time Model 
    public function playTimes()
    {
        return $this->hasMany(PlayTime::class);
    }

    public function rents()
    {
        return $this->hasMany(Rent::class);
    }
}
