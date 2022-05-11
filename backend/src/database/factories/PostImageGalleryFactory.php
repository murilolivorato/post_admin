<?php

namespace Database\Factories;

use App\Models\PostImageGallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostImageGalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostImageGallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $post_ids     = \DB::table('posts')->select('id')->pluck('id')->toArray();
        $user_ids     = \DB::table('user_admins')->select('id')->pluck('id')->toArray();

        return [
            'post_id'         => $this->faker->randomElement($post_ids) ,
            'folder'          => $this->faker->md5  ,
            'user_ip'         => ip2long($this->faker->ipv4),
            'user_id'         => $this->faker->randomElement($user_ids)
        ];
    }
}
