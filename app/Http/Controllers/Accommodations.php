<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationImage;
use App\Models\AccommodationReview;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Traits\MicroFunctions;


class Accommodations extends Controller
{

    use MicroFunctions;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accommodationWithAverageRating = Accommodation::with('reviews')->get()->map(function ($accommodation) {
            $accommodation->average_rating = $this->getAvarageValueFromArray(collect($accommodation->reviews->all()), 'rating');
            return $accommodation;
        });

        // hier pagination gebruiken
        return Inertia::render('Accommodations/Index', [
            'accommodations' => $accommodationWithAverageRating,
        ]);
    }
}
