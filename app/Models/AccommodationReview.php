<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccommodationReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating', 'review_comment', 'accommodation_id'
    ];

    public function accommodations(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class, 'foreign_key');
    }
}
