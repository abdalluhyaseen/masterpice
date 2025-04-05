<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field_type extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
