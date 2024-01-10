<?php

namespace App\Http\Controllers;

use App\Mail\MeetingCreated;
use App\Models\Group;
use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\MeetingAttendanceType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MeetingController extends Controller
{
    public function create()
    {
        $user_id = auth()->id();
        $users = User::where('id', '!=', $user_id)->get(); // 自分以外のユーザー取得
        $groups = Group::with('groupUsers')->get(); // Groupモデルに定義されたgroupUsers()メソッドを使って関連するユーザを取得する

        return view('meeting.create')->with([
            'users' => $users,
            'groups' => $groups // グループの情報をビューに渡す
        ]);
    }

    public function store(Request $request)
    {
        // バリデーションは割愛します

        $result = false;

        DB::beginTransaction();

        try {

            $meeting = new Meeting();
            $meeting->user_id = auth()->id();
            $meeting->name = $request->name;
            $meeting->description = $request->description;
            $result = $meeting->save();
            $group_ids = $request->input('group_ids'); // グループIDの配列を取得
            $user_ids = $request->input('user_ids'); // ユーザーIDの配列を取得（グループIDをキーとした多次元配列）

            foreach ($group_ids as $group_id) {
                if (isset($user_ids[$group_id])) {
                    foreach ($user_ids[$group_id] as $user_id) {
                        $attendance = new MeetingAttendance();
                        $attendance->group_id = $group_id;
                        $attendance->user_id = $user_id;
                        $attendance->meeting_id = $meeting->id;
                        $attendance->type_id = MeetingAttendanceType::TYPE_NOT_YET;
                        $attendance->save();
                    }
                }
            }

            DB::commit();
            $result = true;

            $this->sendMail($meeting, $user_ids);
        } catch (\Exception $e) {

            DB::rollBack();
        }

        return ['result' => $result];
    }

    private function sendMail(Meeting $meeting, array $user_ids)
    {
        $users = User::whereIn('id', $user_ids)->get();
        Mail::cc($users)->send(new MeetingCreated($meeting));
    }
}
