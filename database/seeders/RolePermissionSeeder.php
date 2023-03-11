<?php

namespace Database\Seeders;

use App\Models\Administrator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role create
        $roleAdministrator = Role::create(['name' => 'admin','guard_name' =>'admin']);
        $roleFaculty = Role::create(['name' => 'faculty','guard_name' =>'faculty']);
        $roleUser = Role::create(['name' => 'user','guard_name' =>'user']);

         // Permission List as array
         $permissions = [
            [
                'group_name' => 'Dashboard',
                'permissions' => [
                    'Dashboard view',
                ]
            ],
            [
                'group_name' => 'Admin',
                'permissions' => [
                    // admin Permissions
                    'Admin create',
                    'Admin view',
                    'Admin edit',
                    'Admin delete',
                ]
            ],
            [
                'group_name' => 'Faculty',
                'permissions' => [
                    // faculty Permissions
                    'Faculty create',
                    'Faculty view',
                    'Faculty edit',
                    'Faculty delete',
                ]
            ],
            [
                'group_name' => 'User',
                'permissions' => [
                    //User Permissions
                    'User create',
                    'User view',
                    'User edit',
                    'User delete',
                ]
            ],
            [
                'group_name' => 'Course',
                'permissions' => [
                    //customer Permissions
                    'Course create',
                    'Course view',
                    'Course edit',
                    'Course delete',
                ]
            ],
            [
                'group_name' => 'Registration Schedule',
                'permissions' => [
                    //Registration Schedule Permissions
                    'Registration Schedule create',
                    'Registration Schedule view',
                    'Registration Schedule edit',
                    'Registration Schedule delete',
                ]
            ],
            
        ];

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'guard_name'=>'admin', 'group_name' => $permissionGroup]);
                $roleAdministrator->givePermissionTo($permission);
                $permission->assignRole($roleAdministrator);

               
            }
        }
        $user =  Administrator::create([

            "user_id"              => "123-45379-32",
            "first_name"           => "Dr",
            "last_name"            => "dean",
            "email"                => "admin@admin.com",
            "dob"                  => "1975-01-02",
            "password"             => bcrypt("admin@admin.com"),
            
        ]);
        
    }
    
}
