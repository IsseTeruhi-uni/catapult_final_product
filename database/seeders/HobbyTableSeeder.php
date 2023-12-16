<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HobbyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hobbies = [
            ['name' => '映画鑑賞'],
            ['name' => '音楽鑑賞'],
            ['name' => 'キャンプ'],
            ['name' => '筋トレ'],
            ['name' => 'ヨガ'],
            ['name' => 'ランニング'],
            ['name' => 'ゲーム'],
            ['name' => '旅行'],
            ['name' => '読書'],
            ['name' => '料理'],
            ['name' => '野球観戦'],
            ['name' => '釣り'],
            ['name' => '麻雀'],
            ['name' => 'ゴルフ'],
            ['name' => 'カメラ'],

        ];

        // hobbies テーブルにデータを挿入
        DB::table('hobbies')->insert($hobbies);
    }
}
