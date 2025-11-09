<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeContact>
 */
class EmployeeContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contact_number' => $this->faker->numerify('+91##########'), // +91 10 digit
            // 'employee_id' will be passed dynamically
        ];
    }
}
