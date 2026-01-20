<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayTime extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function rentDetails()
    {
        return $this->hasMany(RentDetail::class);
    }
}
