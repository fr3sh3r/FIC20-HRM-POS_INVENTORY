<?php

namespace Database\Factories;

use App\Models\Payroll;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayrollFactory extends Factory
{
    protected $model = Payroll::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        // Gaji dasar dalam kelipatan 250,000 antara 3,000,000 hingga 15,000,000
        $basicSalary = $this->faker->numberBetween(12, 60) * 250000;

        // Gaji bersih adalah 20% lebih kecil dari gaji dasar, dalam kelipatan 100,000
        $netSalary = floor($basicSalary * 0.8 / 100000) * 100000;

        return [
            //'user_id' => \App\Models\User::factory(),  //pakai factory seperti ini otomatis menciptakan user, sehingga walaupun userseeder menciptakan 10 buah, akan dibuatkan dulu sebanyak seeder dari module ini
            'user_id' => $this->faker->numberBetween(1, 12), // Mengisi user_id antara 1 hingga 10


            // 'company_id' => \App\Models\Company::factory(),
            'company_id' => 1,
            'month' => $this->faker->numberBetween(1, 12),
            'year' => $this->faker->year(),
            'basic_salary' => $basicSalary,
            'net_salary' => $netSalary,
            'total_days' => $this->faker->numberBetween(28, 31),
            'working_days' => $this->faker->numberBetween(20, 25),
            'present_days' => $this->faker->numberBetween(15, 25),
            'total_office_time' => $this->faker->numberBetween(150, 200), // Dalam jam
            'total_worked_time' => $this->faker->numberBetween(140, 190), // Dalam jam
            'half_day' => $this->faker->numberBetween(0, 2),
            'late_days' => $this->faker->numberBetween(0, 5),
            'paid_leaves' => $this->faker->numberBetween(0, 10),
            'unpaid_leaves' => $this->faker->numberBetween(0, 5),
            'holiday_count' => $this->faker->numberBetween(0, 3),
            'payment_date' => $this->faker->optional()->date(),
            'status' => 'generated', // Nilai default dari model
        ];
    }
}
