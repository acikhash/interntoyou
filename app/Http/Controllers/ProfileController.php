<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

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

    public function index()
    {
        //
        $list = User::all();
        return view('user.index', compact('list'));
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
    /**
     * View the user's profile information.
     */
    public function adminedit(Request $request): View
    {
        $user = User::find($request->id);
        $companies = Company::all();
        return view('user.edit', [
            'user' => $user, 'companies' => $companies,
        ]);
    }
    /**
     * update the user's account by admin.
     */
    public function adminupdate(Request $request): RedirectResponse
    {
        $user = User::find($request->user);
        $user->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'company_id' => $request->company,
                'role' => $request->role,
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]
        );
        $id = $user->id;
        return redirect()->route('user.edit', $id)->with('success', 'Record Successfully Updated');
    }
    /**
     * Delete the user's account by admin.
     */
    public function admindestroy(Request $request): RedirectResponse
    {
        $user = User::find($request->user);
        $user->update(
            [
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]
        );
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Record Deleted');
    }
}
