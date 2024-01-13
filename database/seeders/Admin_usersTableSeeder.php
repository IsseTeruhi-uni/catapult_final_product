<?php

namespace Database\Seeders;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Admin_usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrator::truncate();
        Administrator::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name'     => 'Administrator',
        ]);
    }
}
