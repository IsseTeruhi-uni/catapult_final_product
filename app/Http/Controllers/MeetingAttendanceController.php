<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\MeetingAttendanceType;
use Illuminate\Http\Request;

class MeetingAttendanceController extends Controller
{

    public function index(Meeting $meeting, $type_id)
    {
        // ミーティングに関する全ての出欠情報を取得
        $users = $meeting->attendances->where('type_id', $type_id)->pluck('user');

        return view('meeting_attendance.index', compact('users'));
    }

    public function create(Meeting $meeting)
    {
        $grouped_attendances = $meeting->attendances->groupBy('type_id');
        $attendance_types = MeetingAttendanceType::pluck('name', 'id');

        // 各参加タイプごとにユーザーIDを保存するための配列を作成
        $user_ids_by_type = [];

        foreach ($grouped_attendances as $id => $attendances) {
            // 各参加タイプごとにユーザーIDを抽出
            $user_ids_by_type[$id] = $attendances->pluck('user_id')->toArray();
        }

        return view('meeting_attendance.create')->with([
            'meeting' => $meeting,
            'grouped_attendances' => $grouped_attendances,
            'attendance_types' => $attendance_types,
            'user_ids_by_type' => $user_ids_by_type
        ]);
    }

    public function update(Meeting $meeting, Request $request)
    {
        // バリデーションは割愛します

        $result = false;
        $user_id = auth()->id();
        $attendance = MeetingAttendance::where('meeting_id', $meeting->id)
            ->where('user_id', $user_id)
            ->first();

        if (!is_null($attendance)) {

            $attendance->type_id = $request->type_id;
            $result = $attendance->save();
        }

        return redirect()->route('meeting.index');
    }
}
