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
        $accommodationWithRatingandImage = Accommodation::with('reviews', 'images')->get()->map(function ($accommodation) {
            // collect all the ratings that are attached to the accommodation and return average
            $accommodation->average_rating = $this->getAvarageValueFromArray(collect($accommodation->reviews), 'rating');
            // check if image exist on collection, and set it on the collection to return, else do not set accommodation->src on the collection
            $this->getImage($accommodation->images) ?  $accommodation->src = $this->getImage($accommodation->images) : null;
            return $accommodation;
        });

        // hier pagination gebruiken
        return Inertia::render('Accommodations/Index', [
            'accommodations' => $accommodationWithRatingandImage,
        ]);
    }
}
