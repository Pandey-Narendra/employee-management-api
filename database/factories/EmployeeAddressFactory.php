<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeAddress>
 */
class EmployeeAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address_line' => $this->faker->streetAddress(),
            'city'         => $this->faker->city(),
            'state'        => $this->faker->state(),
            'pincode'      => $this->faker->numerify('######'),
            // 'employee_id' will be passed dynamically
        ];
    }
}
