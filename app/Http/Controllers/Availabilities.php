<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Booking;
use Illuminate\Http\Request;

class Availabilities extends Controller
{
    /**
     * Index of the availability calendar.
     */
    public function index($id)
    {
        $availabilities = Availability::where('accommodation_id', $id)->get();

        return $availabilities;
    }

    public function getAvailabilityFromBooking($id)
    {
        $availabilityBooking = Booking::find($id)->availabilities;

        return $this->index($availabilityBooking->first()->accommodation_id);
    }

    public function disableAvailabilityByBooking(int $id, string $start_date, string $end_date)
    {
        //Todo
    }

    public function store(Request $request, $accommodationId)
    {

        if ($request->availabilities) {
            $availability = new Availability;
            $availability->start_date = $request->availabilities[0];
            $availability->end_date = $request->availabilities[1];
            $availability->accommodation_id = $accommodationId;
            $availability->status = 1;

            $availability->save();
        } else {

            $availability = new Availability;

            $availability->start_date = '2023-01-01';
            $availability->end_date = '2040-01-01';
            $availability->accommodation_id = $accommodationId;
            $availability->status = 1;

            $availability->save();

            return $availability;
        }
    }

    public function update(array $availabilities, int $accommodationId)
    {
        $availability = Availability::where('accommodation_id', $accommodationId);

        if (count($availabilities) > 0) {

            $availability->update(['start_date' => $availabilities[0], 'end_date' => $availabilities[1], 'accommodation_id' => $accommodationId, 'status' => 1]);
        }
    }
}
