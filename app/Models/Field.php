<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
    use Carbon\Carbon;


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
    public function getAvailableHours()
{
    $opensAt = Carbon::parse($this->opens_at);
    $closesAt = Carbon::parse($this->closes_at);

    $availableHours = [];
    while ($opensAt->lt($closesAt)) {
        $availableHours[] = $opensAt->format('H:i');
        $opensAt->addMinutes(30);
    }

    return $availableHours;
}


    public function fieldImages()
    {
        return $this->hasMany(Field_images::class);
    }
}
