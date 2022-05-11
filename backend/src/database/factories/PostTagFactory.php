<?php

namespace Database\Factories;

use App\Models\PostTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_ids  = \DB::table('user_admins')->select('id')->pluck('id')->toArray();
        $title     = $this->faker->unique()->word();

        return [
            'title'           => $title ,
            'url_title'       => url_title($title) ,
            'user_ip'         => ip2long($this->faker->ipv4),
            'user_id'         => $this->faker->randomElement($user_ids)
        ];
    }
}
