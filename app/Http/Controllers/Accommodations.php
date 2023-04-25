<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationImage;
use App\Http\Requests\StoreAccommodationRequest;
use Inertia\Inertia;
use App\Traits\MicroFunctions;
use Illuminate\Http\Request;


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
        $accommodations = Accommodation::query()
            ->when(request()->input('search'), function ($query, $search) {
                $query->where('location', 'like', "%{$search}%");
            })->with('reviews', 'images')->get()->map(function ($accommodation) {
                // collect all the ratings that are attached to the accommodation and return average
                $accommodation->average_rating = $this->getAvarageValueFromArray(collect($accommodation->reviews), 'rating');
                // check if image exist on collection, and set it on the collection to return, else do not set accommodation->src on the collection
                $this->getImage($accommodation->images) ?  $accommodation->src = $this->getImage($accommodation->images) : null;
                return $accommodation;
            })->paginate(15)->withQueryString();

        return Inertia::render('Accommodations/Index', [
            'accommodations' => $accommodations,
        ]);
    }

    public function show($id, $fromUpdate = false)
    {
        $accommodationImages = $this->accommodation::find($id)->images()->get();
        $accommodationById = Accommodation::where('id', $id)->get();

        $availabilities = (new Availabilities)->index($id);

        if ($fromUpdate) {
            return [
                'accommodation' => $accommodationById->first(),
                'accommodation_images' => $accommodationImages,
                'availabilities' => $availabilities
            ];
        }

        return Inertia::render('Accommodations/Show', [
            'accommodation' => $accommodationById->first(),
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

            (new Availabilities)->store($request, $accommodation->id);

            return redirect(route('home'))->with('success', 'Accommodation created!');
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function accommodationToUpdate($id)
    {
        // retrieve accommodation info;
        $accommodation = $this->show($id, true);

        return Inertia::render('Accommodations/Edit', [
            'accommodation' => $accommodation['accommodation'],
            'accommodation_images' => $accommodation['accommodation_images'],
            'availabilities' => $accommodation['availabilities'],
        ]);
    }

    public function update(Request $request, $accommodationId)
    {
        $accommodation = Accommodation::find($accommodationId);

        if ($request->user()->id !== $accommodation->user_id) {
            return response('You are not authorized to update this booking. Contact us for more informatiion.');
        }
        if (!$accommodation) {
            return response("Accommodation not found");
        }

        try {
            $accommodation->location = $request->location;
            $accommodation->maximum_of_guests = $request->maximum_of_guests;
            $accommodation->bedrooms = $request->bedrooms;
            $accommodation->beds = $request->beds;
            $accommodation->description = $request->description;
            $accommodation->facilities = $request->facilities;
            $accommodation->price = $request->price;

            if ($request->availabilities) {
                (new Availabilities)->update($request->availabilities, $request->id);
            }

            $accommodation->save();
        } catch (\Exception $e) {
            return $e;
        }

        return redirect(route('home'));
    }

    public function search(Request $query)
    {
        $data = Accommodation::where('name', 'LIKE', '%' . $query->keyword . '%')->get();
        return response()->json($data);
    }
}
