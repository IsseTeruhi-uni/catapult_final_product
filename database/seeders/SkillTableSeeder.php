<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['name' => 'C'],
            ['name' => 'C#'],
            ['name' => 'C++'],
            ['name' => 'Java'],
            ['name' => 'JavaScript'],
            ['name' => 'Ruby'],
            ['name' => 'Python'],
            ['name' => 'PHP'],

        ];

        // skills テーブルにデータを挿入
        DB::table('skills')->insert($skills);
    }
}
