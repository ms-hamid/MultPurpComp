<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            'manage statistics',
            'manage products',
            'manage principles',
            'manage testimonials',
            'manage clients',
            'manage teams',
            'manage abouts',
            'manage appointments',
            'manage hero sections',
        ];

        foreach ($permissions as $permission){
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        $designManagerRole = Role::firstOrCreate([
            'name' => 'designer_manager',
        ]);
        
        $designManagerPermission = [
            'manage products',
            'manage principles',
            'manage testimonials',
        ];
        $designManagerRole->syncPermissions($designManagerPermission);

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
        ]);

        $user = User::firstOrCreate([
            'name' => 'ShaynaComp',
            'email' => 'super@admin.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole($superAdminRole);
    }
}
