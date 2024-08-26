<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Mendapatkan tanggal hari ini
        $today = now();
        // Mendapatkan tanggal dua tahun yang lalu
        $twoYearsAgo = $today->copy()->subYears(2);


        return [
            //'user_id' => User::factory(), //pakai factory seperti ini otomatis menciptakan user, sehingga walaupun userseeder menciptakan 10 buah, akan dibuatkan dulu sebanyak seeder dari module ini
            'user_id' => $this->faker->numberBetween(1, 12), // Mengisi user_id antara 1 hingga 10

            // 'company_id' => Company::factory(),
            'company_id' => 1,
            'leave_id' => Leave::factory(),
            'leave_type_id' => LeaveType::factory(),
            'holiday_id' => null, //=>Holiday::factory(),
            //'date' => $this->faker->date(),
            'date' => $this->faker->dateTimeBetween($twoYearsAgo, $today)->format('Y-m-d'),
            'is_holiday' => $this->faker->boolean() ? 1 : 0, // Menggunakan 0 atau 1
            'is_leave' => $this->faker->boolean() ? 1 : 0,   // Menggunakan 0 atau 1
            // 'clock_in_date_time' => $this->faker->dateTime(),
            // 'clock_out_date_time' => $this->faker->dateTime(),
            'clock_in_date_time' => $this->faker->dateTimeBetween($twoYearsAgo, $today)->format('Y-m-d H:i:s'),
            'clock_out_date_time' => $this->faker->dateTimeBetween($twoYearsAgo, $today)->format('Y-m-d H:i:s'),
            'total_duration' => $this->faker->numberBetween(1, 480), // Duration in minutes
            'is_late' => $this->faker->boolean() ? 1 : 0,          // Menggunakan 0 atau 1
            'is_half_day' => $this->faker->boolean() ? 1 : 0,      // Menggunakan 0 atau 1
            'is_paid' => $this->faker->boolean() ? 1 : 0,          // Menggunakan 0 atau 1
            'status' => $this->faker->randomElement(['present', 'absent', 'late']),
            'reason' => $this->faker->sentence(),
        ];
    }
}
