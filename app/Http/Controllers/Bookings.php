<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;


class Bookings extends Controller
{
    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $booking = $request->user()->bookings()->create($request->all());

        $booking->availabilities()->sync($booking->id);

        return redirect(route('home'));
    }

    public function index()
    {
        $userBookings = Booking::where('user_id', Auth::id())->get();

        return Inertia::render('Bookings/Index', [
            'bookings' => $userBookings,
        ]);
    }

    public function update(StoreBookingRequest $request)
    {
        $request->user()->bookings()->update($request->all());
    }
}
