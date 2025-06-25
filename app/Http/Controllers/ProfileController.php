<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
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

    public function change_image(Request $request, $id)
    {
        $request->validate([
            'image' => "required|file|mimes:png,jpg,jpeg,webp"
        ]);

        $user = User::find($id);
        if ($user->image == null) {
            $image_data = $request->file('image');
            $image_name = time() . $image_data->getClientOriginalName();
            $location = public_path('upload/');
            $image_data->move($location, $image_name);
        } else {
            $old_image = $user->image;
            $old_image_path = public_path('upload/') .  $old_image;
            unlink($old_image_path);

            $image_data = $request->file('image');
            $image_name = time() . $image_data->getClientOriginalName();
            $location = public_path('upload/');
            $image_data->move($location, $image_name);
        }


        $user->update([
            'image' => $image_name
        ]);

        return redirect()->back()->with("success", "Change Image Success");
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
}
