<?php

namespace Database\Factories;

use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $reasons = [
            'Personal Health',
            'Family Health',
            'Education or Training',
            'Personal Travel',
            'Family or Personal Issues',
            'Self-Development',
            'Volunteering',
            'Legal Issues'
        ];




        // Tentukan start_date
        $startDate = $this->faker->dateTimeBetween('-1 year', 'now');

        // Tambahkan antara 1 hingga 30 hari ke start_date
        $daysToAdd = $this->faker->numberBetween(1, 30);
        $endDate = (clone $startDate)->modify("+{$daysToAdd} days");



        return [
            //'user_id' => User::factory(), //pakai factory seperti ini otomatis menciptakan user, sehingga walaupun userseeder menciptakan 10 buah, akan dibuatkan dulu sebanyak seeder dari module ini
            'user_id' => $this->faker->numberBetween(1, 12), // Mengisi user_id antara 1 hingga 10

            'leave_type_id' => LeaveType::factory(),
            'company_id' => 1,
            // 'start_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            // 'end_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'is_half_day' => $this->faker->boolean ? 1 : 0,
            'total_days' => $this->faker->numberBetween(1, 30),
            'is_paid' => $this->faker->boolean ? 1 : 0,
            // 'reason' => $this->faker->sentence,
            'reason' => $this->faker->randomElement($reasons), // Pilih alasan cuti secara acak
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),  //Case sensitive dengan LeaveController
            // 'created_by' => 1, // Assuming the creator is the first user or admin
            // 'updated_by' => null, // Can be filled with the same value as created_by if needed
        ];
    }
}
