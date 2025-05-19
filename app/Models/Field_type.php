<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field_type extends Model
{
 use HasFactory, SoftDeletes;

    protected $fillable = ['field_type'];
    protected $casts = [
    'field_price' => 'float',
    'field_avilable' => 'boolean',
];

    // Relationships
    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
