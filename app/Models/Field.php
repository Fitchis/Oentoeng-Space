<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Field extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'availability'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
