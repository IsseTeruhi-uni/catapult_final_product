<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            ['name' => '開発'],
            ['name' => '営業'],
            ['name' => '製造'],
            ['name' => '管理'],

        ];

        // groups テーブルにデータを挿入
        DB::table('groups')->insert($groups);
    }
}
