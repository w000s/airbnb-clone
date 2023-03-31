<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
    ];

    public function availabilites(): BelongsToMany
    {
        return $this->belongsToMany(Availability::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'foreign_key');
    }
}
