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

        if ($user) {
            if (is_array($request->skills)) {
                $user->skills()->sync($request->skills);
            }

            if (is_array($request->hobbies)) {
                $user->hobbies()->sync($request->hobbies);
            }
        }

        $path = null;
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('profile-icons', 'public');
        }

        if ($path) {
            $user->profile_photo_path = $path;
            $user->save();
        }

        $user->update([
            'company_id' => $request->company_id,
            'group_id' => $request->group_id,
            'post_id' => $request->post_id,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard');
    }
}
