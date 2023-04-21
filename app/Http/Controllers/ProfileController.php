<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Traits\MicroFunctions;


use App\Models\Accommodation;

class ProfileController extends Controller
{
    use MicroFunctions;

    public function index(Request $request)
    {
        $accommodations = Accommodation::where('user_id', $request->user()->id)->with('reviews', 'images')->get()->map(function ($accommodation) {
            // collect all the ratings that are attached to the accommodation and return average
            $accommodation->average_rating = $this->getAvarageValueFromArray(collect($accommodation->reviews), 'rating');
            // check if image exist on collection, and set it on the collection to return, else do not set accommodation->src on the collection
            $this->getImage($accommodation->images) ?  $accommodation->src = $this->getImage($accommodation->images) : null;
            return $accommodation;
        });

        return Inertia::render('Profile/ProfileAccommodation', [
            'accommodations' => $accommodations->paginate(15),
        ]);
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
