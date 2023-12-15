<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function create()
    {
        return response()->view('employees.create');
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
}
