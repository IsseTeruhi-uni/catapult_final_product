<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user)
    {
        Auth::user()->followings()->attach($user->id);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function followers_show($id)
    {
        $user = User::find($id);
        $users = $user->followers;

        return response()->view('follow.show1', compact('users'));
    }

    public function followings_show($id)
    {
        $user = User::find($id);
        $users = $user->followings;

        return response()->view('follow.show2', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Auth::user()->followings()->detach($user->id);
        return redirect()->back();
    }
}