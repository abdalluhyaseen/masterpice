<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field_images extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
