<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'src', 'description', 'accommodation_id'
    ];

    public function accommodations()
    {
        return $this->belongsTo(Accommodation::class, 'foreign_key');
    }

    public function setFilenamesAttribute($value)
    {
        $this->attributes['src'] = json_encode($value);
    }
}
