<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Group;
use App\Models\Hobby;
use App\Models\Post;
use App\Models\Skill;
use App\Models\User;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->view('employees.index', compact('users'));
    }
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

        if ($request->post_id == 4 && User::where('group_id', $request->group_id)->where('post_id', 4)->count() == 1) {
            $adminRole = Role::where('name', 'admin')->first();
            $user->assignRole($adminRole);
        }

        return redirect()->route('dashboard');
    }
    public function show($id)
    {
        $user = User::find($id);
        $company = $user->company;
        $group = $user->group;
        $post = $user->post;
        $skills = $user->skills;
        $hobbies = $user->hobbies;
        // ターゲットユーザのフォロワー一覧
        $followers = $user->followers;
        // ターゲットユーザのフォローしている人一覧
        $followings  = $user->followings;
        return response()->view('employees.show', compact('user', 'company', 'group', 'post', 'skills', 'hobbies', 'followers', 'followings'));
    }
}
