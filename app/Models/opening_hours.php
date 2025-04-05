<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class opening_hours extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function fields()
    {
        return $this->belongsTo(Field::class);
    }
}
