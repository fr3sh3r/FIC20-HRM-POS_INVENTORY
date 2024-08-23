<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\LeaveType::factory()->count(15)->create();
        //max 15, karena di factory hanya ada 16 daftar dan dibuat harus unik
    }
}
