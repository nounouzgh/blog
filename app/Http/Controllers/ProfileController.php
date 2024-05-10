<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    
    public function updateProfileImage(Request $request)
{
    try {
        // Retrieve the authenticated compte and its associated user
        $compte = Auth::guard('compte')->user();

        // Check if the compte exists
        if (!$compte) {
            throw new \Exception('Compte not found', 404);
        }

        // Retrieve the associated user
        $user = $compte->user;

        // Check if the user exists
        if (!$user) {
            throw new \Exception('User not found', 404);
        }

        // Retrieve the image link from the request
        $imageLink = $request->input('profile_image_src');

        // Remove any part of the URL before the "storage" directory  for remouve sever and port
        $storageIndex = strpos($imageLink, 'storage');
        if ($storageIndex !== false) {
            $imageLink = substr($imageLink, $storageIndex);
        }
        // Update the user's profile image
        $user->update([
            'image' => $imageLink
        ]);
    

        // Redirect back to the previous page
        return back()->with('success', 'Profile image updated successfully');
    } catch (\Exception $e) {
        // Handle exceptions
        return back()->with('error', $e->getMessage());
    }
}
}
