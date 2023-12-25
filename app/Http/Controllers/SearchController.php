<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = $request->category;
        $keyword = $request->keyword;
        if ($category == 'name'){
            $users =User ::where($category, 'like', '%'.$keyword.'%')->get();
        }
        else if ($category =='group'){
            $users =User ::whereHas('group', function($query) use ($keyword){
                $query->where('name', 'like', '%'.$keyword.'%');
            })->get();
        }
        else if ($category =='company'){
            $users =User ::whereHas('company', function($query) use ($keyword){
                $query->where('name', 'like', '%'.$keyword.'%');
            })->get();
        }
        else if ($category =='post'){
            $users =User ::whereHas('post', function($query) use ($keyword){
                $query->where('name', 'like', '%'.$keyword.'%');
            })->get();
        }
        else if ($category =='skill'){
            $users =User ::whereHas('skills', function($query) use ($keyword){
                $query->where('name', 'like', '%'.$keyword.'%');
            })->get();
        }
        else if ($category =='hobby'){
            $users =User ::whereHas('hobbies', function($query) use ($keyword){
                $query->where('name', 'like', '%'.$keyword.'%');
            })->get();
        }
        
        if (count($users) == 0) {
            return response()-> view('search.result', compact('users'));
        }else if (count($users) ==1){
            $user=$users[0];
            $company=$user->company;
            $group=$user->group;
            $post=$user->post;
            $skills=$user->skills;
            $hobbies=$user->hobbies;
            $followers=$user->followers;
            return response()->view('employees.show', compact('user','company','group','post','skills','hobbies','followers'));
        }
        return response()->view('search.result', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('search.input');
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
