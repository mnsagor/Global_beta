<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            AssetStatusTableSeeder::class,


            ProcedureTypeSeeder::class,
            WorkOrderStatusSeeder::class,
            ModalitySeeder::class,
            ProcedureSeeder::class,
            DefaultMacrosSeeder::class,
        ]);

    }
}
