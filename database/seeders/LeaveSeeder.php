<?php

namespace Database\Seeders;

use App\Models\Leave;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate a specific number of leave records
        Leave::factory()->count(50)->create(); // Adjust the count as needed
    }
}
