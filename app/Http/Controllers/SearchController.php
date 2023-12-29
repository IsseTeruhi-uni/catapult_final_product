<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class SearchController extends Controller
{
    /**
     * 会社名での絞り込みに苦戦中
     * Display a listing of the resource.
     * else if ($category =='company'){
     *      $users =User ::whereHas('company', function($query) use ($keyword){
     *           $query->where('name', 'like', '%'.$keyword.'%');
     *      })->get();
     *   }
     */
    public function index(Request $request)
    {
        $category = $request->category;
        $keyword = $request->keyword;
        $my_company = Auth::user()->company;
        if ($category == 'name'){
            $users=User::where('company_id', $my_company->id)->where('name', 'like', '%'.$keyword.'%')->get();
        }
        else if ($category =='group'){
            $users =User ::where('company_id', $my_company->id)->whereHas('group', function($query) use ($keyword){
                $query->where('name', 'like', '%'.$keyword.'%');
            })->get();
        }
        else if ($category =='post'){
            $users =User ::where('company_id', $my_company->id)->whereHas('post', function($query) use ($keyword){
                $query->where('name', 'like', '%'.$keyword.'%');
            })->get();
        }
        else if ($category =='skill'){
            $users =User ::where('company_id', $my_company->id)->whereHas('skills', function($query) use ($keyword){
                $query->where('name', 'like', '%'.$keyword.'%');
            })->get();
        }
        else if ($category =='hobby'){
            $users =User ::where('company_id', $my_company->id)->whereHas('hobbies', function($query) use ($keyword){
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
        return response()->view('employees.index', compact('users'));
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
