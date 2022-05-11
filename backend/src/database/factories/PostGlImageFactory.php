<?php

namespace Database\Factories;

use App\Models\PostGlImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostGlImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostGlImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $gallery_ids  = \DB::table('post_image_galleries')->select('id')->pluck('id')->toArray();
        $user_ids     = \DB::table('user_admins')->select('id')->pluck('id')->toArray();

        return [
            'gallery_id'      => $this->faker->randomElement($gallery_ids) ,
            'image'           => $this->faker->md5 . '.jpg',
            'title'           => $this->faker->sentence(2) ,
            'user_ip'         => ip2long($this->faker->ipv4),
            'user_id'         => $this->faker->randomElement($user_ids)
        ];

    }
}
