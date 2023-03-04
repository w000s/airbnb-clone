<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
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
        $accommodationWithAverageRatingandImage = Accommodation::with('reviews', 'images')->get()->map(function ($accommodation) {
            $accommodation->average_rating = $this->getAvarageValueFromArray(collect($accommodation->reviews), 'rating');
            $accommodation->src = $this->getImage($accommodation->images);
            return $accommodation;
        });



        // hier pagination gebruiken
        return Inertia::render('Accommodations/Index', [
            'accommodations' => $accommodationWithAverageRatingandImage,
        ]);
    }
}
