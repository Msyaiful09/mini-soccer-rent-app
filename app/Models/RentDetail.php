<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function rent()
    {
        return $this->belongsTo(Rent::class);
    }

    public function playTime()
    {
        return $this->belongsTo(PlayTime::class);
    }
}
