<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Group;
use App\Models\Hobby;
use App\Models\Post;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function create()
    {
        $companies = Company::all();
        $groups = Group::all();
        $posts = Post::all();
        $skills = Skill::all();
        $hobbies = Hobby::all();

        return response()->view('employees.create', compact('companies', 'groups', 'posts', 'skills', 'hobbies'));
    }

    public function store(EmployeeRequest $request)
    {
        $user = User::find(Auth::user()->id);

        if ($user && is_array($request->skills)) {
            $user->skills()->sync($request->skills);
        }

        if ($user && is_array($request->hobbies)) {
            $user->hobbies()->sync($request->hobbies);
        }

        $user->update([
            'company_id' => $request->company_id,
            'group_id' => $request->group_id,
            'post_id' => $request->post_id,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard');
    }
    public function show($id)
    {
        $user = User::find($id);
        $company = $user->company;
        $group = $user->group;
        $post= $user->post;
        $skills = $user->skills;
        $hobbies = $user->hobbies;
        $followers = $user->followers;
        return response()->view('employees.show', compact('user', 'company', 'group', 'post', 'skills', 'hobbies', 'followers'));
    }

}
