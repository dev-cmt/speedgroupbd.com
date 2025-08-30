<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*__________________________________________________________ */
        /*__________________________________________________________ */
        $super_admin_role = Role::create(['name' => 'Super-Admin']);

        $permissions = [
            /*_____MENU ACCESS_____*/
            ['name' => 'Continent create'],
            ['name' => 'Payment menu access'],
            ['name' => 'Post menu access'],
            ['name' => 'Setting menu access'],

            //---POST => Gallery
            ['name' => 'Gallery access'],
            ['name' => 'Gallery create'],
            ['name' => 'Gallery edit'],
            ['name' => 'Gallery delete'],

            //---POST => Blog
            ['name' => 'Blog access'],
            ['name' => 'Blog create'],
            ['name' => 'Blog edit'],
            ['name' => 'Blog delete'],
            
            //---SETTING => Contact
            ['name' => 'Contact access'],
            ['name' => 'Contact reply'],
            ['name' => 'Contact delete'],
            
            //---SETTING => Role
            ['name' => 'Role access'],
            ['name' => 'Role create'],
            ['name' => 'Role edit'],
            ['name' => 'Role delete'],

            //---SETTING => User
            ['name' => 'User access'],
            ['name' => 'User create'],
            ['name' => 'User edit'],
            ['name' => 'User delete'],

            /*_____ WEB ACCESS _____*/
            ['name' => 'Super-Admin'],
            ['name' => 'Admin'],
            ['name' => 'Member'],
            ['name' => 'Data Setting'],

            //-----MEMBER TYPE
            ['name' => 'Student Member'],
            ['name' => 'Candidate Member'],
            ['name' => 'Professional Member'],
            ['name' => 'Associate Member'],
            ['name' => 'Trade Member'],
            ['name' => 'Corporate Member'],

        ];

        foreach ($permissions as $item) {
            Permission::create($item);
        }
        
        $super_admin = User::findOrFail(1);
        $super_admin->assignRole($super_admin_role);

        // Give permissions to roles
        $permissions = Permission::all(); // Get all permissions
        $super_admin_role->syncPermissions($permissions);
    }
}
