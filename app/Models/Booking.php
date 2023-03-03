<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Booking extends Model
{
    use HasFactory;

    public function availabilites(): BelongsToMany
    {
        return $this->belongsToMany(Availability::class);
    }
}
