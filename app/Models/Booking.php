<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
     use HasFactory, SoftDeletes;

     protected $fillable = [
        'date',
        'start_at',
        'duration',
        'user_id',
        'field_id',
        'payment_method',
        'card_number',
        'card_expiry',
        'card_cvc',
        'paypal_email',
        'total_price',
        'status',
        'total_price',
    ];




    protected $casts = [
        'total_price'=> 'float',
        'duration' => 'integer',
        'user_id' => 'integer',
        'field_id' => 'integer',
        'status' => 'string',
        'date' => 'date',
        'start_at' => 'datetime',

        // other casts...
    ];

    protected $guarded = [];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }


    public function fieldHistories()
    {
        return $this->hasMany(Field_history::class);
    }
}
