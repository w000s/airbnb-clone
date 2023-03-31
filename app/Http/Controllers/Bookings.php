<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use Illuminate\Http\RedirectResponse;

class Bookings extends Controller
{
    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $newRequest = $request->user()->bookings();

        $newRequest->create($request->all());

        return redirect(route('home'));
    }
}
