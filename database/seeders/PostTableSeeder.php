<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            ['name' => '一般社員'],
            ['name' => '係長'],
            ['name' => '課長'],
            ['name' => '部長'],

        ];

        // posts テーブルにデータを挿入
        DB::table('posts')->insert($posts);
    }
}
