<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Accommodation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'location',
        'maximum_of_guests',
        'bedrooms',
        'beds',
        'description',
        'facilities',
        'price',
    ];

    public function availabilities(): HasMany
    {
        return $this->hasMany(Availability::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(AccommodationImage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'foreign_key');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(AccommodationReview::class);
    }
}
