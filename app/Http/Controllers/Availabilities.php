<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\AvailabilityBooking;

class Availabilities extends Controller
{
    protected $availability;

    public function __construct(Availability $availability)
    {
        $this->availability = $availability;
    }

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
        $availabilityWithBooking = Availability::with('bookings')->find(7);

        $availability = $this->index($availabilityWithBooking->accommodation_id);

        return $availabilityWithBooking;
    }
}
