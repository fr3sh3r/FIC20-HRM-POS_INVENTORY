<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Mr. Edi',
            'email' => 'edi@fic20.com',
            'password' => Hash::make('12345678')
            //jangan pakai bcrypt('password'), tapi HASH
            //seharusnya langsung otomatis keluar use Illuminate\Support\Facades\Hash; kalau tidak keluar, ketik Hash dan pilih dari option kata HASH
        ]);

        User::factory()->create([
            'name' => 'Admin Guest',
            'email' => 'guest@tamu.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
