<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::factory()->create([
            'name' => 'Edi',
            'username' => 'edi_superadmin',
            'profile_image' => 'https://via.placeholder.com/150',
            'email' => 'edi@fic20.com',
            'password' => Hash::make('12345678'),
            'shift_id' => null,
            'status' => 'Enable',
            'department_id' => null,
            'designation_id' => null,
            'role_id' => \App\Models\Role::where('name', 'admin')->first()->id,

            'phone' => '081122335566',
            'address' => 'Surabaya, East Java, Indonesia',
            'company_id' => 1,
            'is_superadmin' => 1,
            'user_type' => 'employee',
            'login_enabled' => 1,
            //'created_by' => 1, // Created by Super Admin
        ]);

        User::factory()->create([
            'name' => 'Admin1',
            'username' => 'admin_1',
            'profile_image' => 'https://via.placeholder.com/150',
            'email' => 'admin@fic20.com',
            'password' => Hash::make('12345678'),
            'shift_id' => null,
            'status' => 'Enable',
            'department_id' => null,
            'designation_id' => null,
            'role_id' => \App\Models\Role::where('name', 'admin')->first()->id,
            'phone' => '085895226892',
            'address' => 'Surabaya, East Java, Indonesia',
            'company_id' => 1,
            'is_superadmin' => 1,
            'user_type' => 'employee',
            'login_enabled' => 1,
            // 'created_by' => 1, // Assuming Super Admin is created by itself
            'created_by' => null, // Assuming the Super Admin is created by itself
            'updated_by' => null,
            'deleted_by' => null,
        ]);



        User::factory()->create([
            'name' => 'Guest',
            'username' => 'guest_admin',
            'profile_image' => 'https://via.placeholder.com/150',
            'email' => 'guest@tamu.com',
            'password' => Hash::make('12345678'),
            'shift_id' => null,
            'status' => 'Enable',
            'department_id' => null,
            'designation_id' => null,
            'role_id' => \App\Models\Role::where('name', 'admin')->first()->id,

            'phone' => '087788992211',
            'address' => 'Semarang, Central Java, Indonesia',
            'company_id' => 1,
            'is_superadmin' => 0,
            'user_type' => 'employee',
            'login_enabled' => 1,
            //'created_by' => 1, // Created by Super Admin
            'created_by' => $superAdmin->id,
            'updated_by' => $superAdmin->id,
            'deleted_by' => null,
        ]);


        //Dinamis
        // Generate 10 users using the factory
        User::factory()->count(10)->create();
    }
}
