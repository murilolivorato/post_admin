<?php

namespace Database\Factories;

use App\Models\PostType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title     = $this->faker->unique()->word();

        return [
            'title'           => $this->faker->unique()->word() ,
            'url_title'       => url_title($title)
        ];
    }
}
