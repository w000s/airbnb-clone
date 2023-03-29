<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreAvailabilityRequest;


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
}
