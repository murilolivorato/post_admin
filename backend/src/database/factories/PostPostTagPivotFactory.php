<?php

namespace Database\Factories;

use App\Models\PostPostTagPivot;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostPostTagPivotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostPostTagPivot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $post_ids     = \DB::table('posts')->select('id')->pluck('id')->toArray();
        $post_tag_id  = \DB::table('post_tags')->select('id')->pluck('id')->toArray();

        return [
            'post_id'             => $this->faker->unique()->randomElement($post_ids) ,
            'post_tag_id'         => $this->faker->randomElement($post_tag_id)
        ];
    }
}
