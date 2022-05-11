<?php

namespace Database\Factories;

use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_ids       = \DB::table('user_admins')->select('id')->pluck('id')->toArray();
        $post_types_id  = \DB::table('post_types')->select('id')->pluck('id')->toArray();
        $title          = $this->faker->unique()->word();

        return [
            'title'           => $this->faker->unique()->word() ,
            'type_id'         => $post_types_id ,
            'url_title'       => url_title($title) ,
            'user_ip'         => ip2long($this->faker->ipv4),
            'user_id'         => $this->faker->randomElement($user_ids)
        ];
    }
}
