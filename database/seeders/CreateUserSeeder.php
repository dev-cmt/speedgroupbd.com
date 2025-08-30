<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'name'=>'SG-BD Admin',
            'email_verified_at' => '2022-01-01',
            'email'=>'Admin',
            'status' => '1',
            'is_admin' => '1',
            'password'=>bcrypt('password'),
            'profile_photo_path'=>'fix/admin.jpg',
        ]);

        

    }
}
