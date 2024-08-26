<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker = Faker::create('id_ID');

        return [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => Hash::make('password'), // Password di-hash menggunakan bcrypt
            'username' => $faker->unique()->userName,
            'company_id' => 1, // \App\Models\Company::factory(),
            'is_superadmin' => $faker->boolean(10), // 10% kemungkinan menjadi superadmin
            'role_id' => rand(1, 2), //\App\Models\Role::factory(),
            'user_type' => $faker->randomElement(['employee', 'manager', 'admin']),
            'login_enabled' => $faker->boolean(80), // 80% kemungkinan login diaktifkan
            'profile_image' => $faker->imageUrl(640, 480, 'people', true, 'Faker'),
            'status' => $faker->randomElement(['Enable', 'Disable']),
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'department_id' => null, //  \App\Models\Department::factory()->nullable(),
            'designation_id' => null, //\App\Models\Designation::factory()->nullable(),
            'shift_id' => null, // \App\Models\Shift::factory()->nullable(),
            'remember_token' => Str::random(10),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
