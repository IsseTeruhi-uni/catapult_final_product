<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Follow;
use App\Models\Meeting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::getAllOrderByUpdated_at();

        $userId = auth()->user()->id; // ログインしているユーザーのIDを取得

        // モデルを使ってメソッドを呼び出す
        $items = Follow::getAllOrderByUpdated($userId);

        $meetings = Meeting::getAllOrderByUpdated_at();

        return view('dashboard', compact('blogs', 'items', 'meetings'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
