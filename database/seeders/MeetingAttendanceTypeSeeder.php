<?php

namespace Database\Seeders;

use App\Models\MeetingAttendanceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetingAttendanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            MeetingAttendanceType::TYPE_YES => '出席',
            MeetingAttendanceType::TYPE_NO => '欠席',
            MeetingAttendanceType::TYPE_NOT_YET => '未回答',
        ];

        foreach ($names as $id => $name) {

            $meeting_attendance_type = new MeetingAttendanceType();
            $meeting_attendance_type->id = $id;
            $meeting_attendance_type->name = $name;
            $meeting_attendance_type->save();
        }
    }
}
