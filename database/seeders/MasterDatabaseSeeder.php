<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // 追加
use Spatie\Permission\Models\Permission; // 追加
use App\Models\User; // 追加
use Illuminate\Support\Facades\Auth;

class MasterDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $president = User::find(2);


        // ロール作成
        $adminRole = Role::create(['name' => 'admin']);

        // 権限作成
        $registerPermission = Permission::create(['name' => 'register']);


        // admin役割にregister権限を付与
        $adminRole->givePermissionTo($registerPermission);

        // 社長にadminを割り当て
        $president->assignRole($adminRole);
    }
}
