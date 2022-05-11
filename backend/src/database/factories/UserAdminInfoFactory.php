<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAdminInfo>
 */
class UserAdminInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_admin_id' => 1,
            'name'           => $this->faker->unique()->word(),
            'last_name'      => $this->faker->unique()->word(),
            'user_id'        => 1
        ];
    }
}
