<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationImage;
use App\Http\Requests\StoreAccommodationRequest;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
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

        return Inertia::render('Accommodations/Index', [
            'accommodations' => $accommodations->paginate(15),
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

    public function createAccommodationPage()
    {
        return Inertia::render('Accommodations/Create');
    }

    public function create(StoreAccommodationRequest $request)
    {
        try {
            $accommodation = $request->user()->accommodations()->create($request->all());

            // accommodation image
            foreach ($request->file('images') as $image) {
                $name = now()->timestamp . ".{$image->getClientOriginalName()}";

                $image->storeAs('', $name);

                AccommodationImage::create([
                    'src' => $name,
                    'description' => $name,
                    'accommodation_id' => $accommodation->id
                ]);
            }

            return redirect()->back()->with('success', 'File Upload Successfully!!');
        } catch (\Exception $e) {
            return $e;
        }
    }
}
