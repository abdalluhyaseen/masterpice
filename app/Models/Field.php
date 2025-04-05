<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function sportType()
    {
        return $this->belongsTo(Sport_type::class);
    }

    public function fieldType()
    {
        return $this->belongsTo(Field_type::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    public function opening_hours()
    {
        return $this->hasMany(opening_hours::class);
    }

    public function fieldImages()
    {
        return $this->hasMany(Field_images::class);
    }
}
