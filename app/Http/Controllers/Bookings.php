<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Http\Controllers\Availabilities;
use App\Traits\MicroFunctions;
use Illuminate\Http\Request;

class Bookings extends Controller
{
    use MicroFunctions;

    public function index()
    {
        $userBookings = Booking::where('user_id', Auth::id())->get();

        return Inertia::render('Bookings/Index', [
            'bookings' => $userBookings,
        ]);
    }

    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $availabilityAccommodation = (new Availabilities)->index($request->accommodation_id);

        $availabilities = $availabilityAccommodation->where('start_date', '<=', $request->start_date)
            ->where('end_date', '>', $request->end_date);

        if (count($availabilities) > 0) {
            $booking = $request->user()->bookings()->create($request->all());
            $booking->availabilities()->sync($availabilities->first()->id);
        } else {
            $booking = $request->user()->bookings()->create($request->all());
            $availability = $request->user()->availabilities()->store($request->all());
            $booking->availabilities()->sync($availability->id);
        }

        return redirect(route('home'));
    }


    public function update(Request $request, $bookId)
    {
        $booking = Booking::find($bookId);

        if ($request->user()->id !== $booking->user_id) {
            return response('You are not authorized to update this booking. Contact us for more informatiion.');
        }

        if (!$booking) {
            return response("Booking not found");
        }

        $booking->start_date = $request->start_date;
        $booking->end_date = $request->end_date;
        $booking->status = 'Booked';
        $booking->save();

        return redirect(route('home'));
    }

    public function destroy(Request $request, $bookId)
    {
        $booking = Booking::find($bookId);
        if ($request->user()->id !== $booking->user_id) {
            return response('You are not authorized to delete this booking. Contact us for more informatiion.');
        }

        $booking->destroy($bookId);

        return redirect()->back()->with('success', 'Booking cancelled!');
    }

    public function viewBooking($id)
    {
        $availabilityArray = [];
        $availabilities = (new Availabilities)->index($id);

        foreach ($availabilities as $availability) {
            $availabilityArray[] = $availability->id;
        }

        $bookings = Booking::query()->whereHas('availabilities', function ($query) use ($availabilityArray) {
            // return $query->whereIn('availability_id', [4, 25, 35]);
            return $query->whereIn('availability_id', $availabilityArray);
        })->get();

        return Inertia::render('Bookings/AccommodationBookings', ['bookings' => $bookings]);
    }
}
