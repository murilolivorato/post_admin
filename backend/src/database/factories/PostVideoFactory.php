<?php

namespace Database\Factories;

use App\Models\PostVideo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostVideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostVideo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $video_website_ids   = \DB::table('video_websites')->select('id')->pluck('id')->toArray();
        $post_ids            = \DB::table('posts')->select('id')->pluck('id')->toArray();
        $user_ids            = \DB::table('user_admins')->select('id')->pluck('id')->toArray();

        return [
            'video_website_id' => $this->faker->randomElement($video_website_ids) ,
            'post_id'          => $this->faker->randomElement($post_ids) ,
            'title'            => $this->faker->sentence(4) ,
            'reference'        => $this->faker->word() ,
            'user_ip'          => ip2long($this->faker->ipv4),
            'user_id'          => $this->faker->randomElement($user_ids)

        ];
    }
}
