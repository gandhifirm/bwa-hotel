<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage countries',
            'manage cities',
            'manage hotels',
            'manage hotel booking',
            'checkout hotels',
            'view booking hotels',
        ];

        foreach ($permissions as $key => $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }

        $customerRole = Role::create([
            'name' => 'customer',
        ]);

        $customerPermissions = [
            'checkout hotels',
            'view booking hotels',
        ];

        $customerRole->syncPermissions($customerPermissions);

        $superAdminRole = Role::create([
            'name' => 'super_admin',
        ]);

        $user = User::create([
            'name'                  => 'Super Admin',
            'email'                 => 'super_admin@bwahotel.com',
            'email_verified_at'     => Carbon::now(),
            'password'              => bcrypt('12345SuperAdmin#'),
            'photo'                 => 'photo-profile/super-admin.jpg',
            'slug'                  => Str::slug('Super Admin').'-'.mt_rand(10000, 99999),
        ]);

        $user->assignRole($superAdminRole);
    }
}