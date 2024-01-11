<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['name' => '株式会社A'],
            ['name' => '株式会社B'],
            ['name' => '株式会社C'],

        ];

        // companies テーブルにデータを挿入
        DB::table('companies')->insert($companies);
    }
}
