<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['sport_type', 'sport_image'];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
