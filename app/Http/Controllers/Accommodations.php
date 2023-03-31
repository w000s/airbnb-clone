<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Availability;
use Inertia\Inertia;
use App\Traits\MicroFunctions;

class Accommodations extends Controller
{
    use MicroFunctions;
    protected $accommodation;

    /**
     * Create a new controller instance.
     *
     * @param  Accommodation  $accommodation
     * @return void
     */
    public function __construct(Accommodation $accommodation)
    {
        $this->accommodation = $accommodation;
    }

    public function index()
    {
        $accommodations = Accommodation::with('reviews', 'images')->get()->map(function ($accommodation) {
            // collect all the ratings that are attached to the accommodation and return average
            $accommodation->average_rating = $this->getAvarageValueFromArray(collect($accommodation->reviews), 'rating');
            // check if image exist on collection, and set it on the collection to return, else do not set accommodation->src on the collection
            $this->getImage($accommodation->images) ?  $accommodation->src = $this->getImage($accommodation->images) : null;
            return $accommodation;
        });

        // hier pagination gebruiken
        return Inertia::render('Accommodations/Index', [
            'accommodations' => $accommodations,
        ]);
    }

    public function show($id)
    {
        $accommodationImages = $this->accommodation::find($id)->images()->get();
        $accommodationById = Accommodation::where('id', $id)->get();

        $availabilities = app('App\Http\Controllers\Availabilities')->index($id);

        return Inertia::render('Accommodations/Show', [
            'accommodation' => $accommodationById,
            'accommodation_images' => $accommodationImages,
            'availabilities' => $availabilities
        ]);
    }

    public function store($id)
    {
    }
}
