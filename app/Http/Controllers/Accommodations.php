<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationImage;
use App\Models\AccommodationReview;
use Illuminate\Http\Request;
use Inertia\Inertia;


class Accommodations extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accommodations = Accommodation::all();

        $reviewCollection = Accommodation::with('reviews')->get()->map(function ($accommodation) {
            return $accommodation->reviews;
        });

        $averageRating = $reviewCollection->map(function ($review) {
            return $review->avg('rating');
        });


        // hier pagination gebruiken
        return Inertia::render('Accommodations/Index', [
            'accommodations' => Accommodation::latest()->get(),
            // 'accommodation_image' => AccommodationImage::with('accommodation:id')->latest()->get(),
            // 'accommodation_review' => AccommodationReview::latest()->get()
        ]);
    }
}
