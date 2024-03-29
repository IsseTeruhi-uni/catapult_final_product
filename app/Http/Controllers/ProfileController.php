<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary; 


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
        // $request->user()->fill($request->validated());
        $request->user()->fill($request->safe()->only(['name', 'email']));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $path = null;
        if ($request->hasFile('picture')) {
            $file=$request->file('picture');
            $uploadpath = Cloudinary::upload ( $file->getRealPath(), [
                // ここの設定は各々で数値をいじって下さい
                    "height" => 800,
                    "width" => 800,
                    "crop" => "fit",
                    "border" => "20px_solid_rgb:ffffff",
                    "quality" => "auto",
                    "fetch_format" => "auto",
            ])->getSecurePath();
             //$id = $update->getPublicId();
             $request->user()->profile_photo_path = $uploadpath;
        }

        $request->user()->save();

        /*$user = User::find(Auth::user()->id);

        if ($user && is_array($request->skills)) {
            $user->skills()->sync($request->skills);
        }

        if ($user && is_array($request->hobbies)) {
            $user->hobbies()->sync($request->hobbies);
        }*/

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
