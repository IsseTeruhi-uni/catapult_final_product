<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Group;
use App\Models\Hobby;
use App\Models\Post;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserHistory;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary; 


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
             $user()->profile_photo_path = $uploadpath;
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
            $registerPermission = Permission::where('name', 'register')->first();
            $adminRole->givePermissionTo($registerPermission);
            $user->assignRole($adminRole);
        }

        return redirect()->route('dashboard');
    }
    public function show($id)
    {
        $user = User::find($id);

        $viewerId = Auth::user()->id;

        $userHistory = UserHistory::where('user_id', $viewerId)
            ->where('viewed_user_id', $user->id)
            ->first();

        if ($userHistory) {
            // 既に閲覧履歴が存在する場合は更新
            $userHistory->update([
                'viewed_at' => now(), // 更新したいフィールドや値に合わせて変更
            ]);
        } else {
            // 閲覧履歴が存在しない場合は新しいインスタンスを作成
            UserHistory::create([
                'user_id' => $viewerId,
                'viewed_user_id' => $user->id,
                'viewed_at' => now(), // 初回の閲覧時刻
            ]);
        }



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
