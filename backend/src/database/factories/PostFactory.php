<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_ids           = \DB::table('user_admins')->select('id')->pluck('id')->toArray();
        $post_category_ids  = \DB::table('post_categories')->select('id')->pluck('id')->toArray();
        $post_users_ids     = \DB::table('post_users')->select('id')->pluck('id')->toArray();
        $category_randon    = $this->faker->randomElement($post_category_ids);
        $post_type_id       = \DB::table('post_categories')->where('id', $category_randon  )->select('type_id')->pluck('type_id')->toArray();
        $title              = $this->faker->sentence(4);

        return [
            'status'             => 'active' ,
            'sub_title'          => $this->faker->sentence(4),
            'category_id'        => $category_randon ,
            'type_id'            => $post_type_id[0] ,
            'post_user_id'       => $this->faker->randomElement($post_users_ids) ,
            'key_words'          => $this->faker->sentence(5) ,
            'title'              => $title ,
            'folder'             => $this->faker->md5 ,
            'url_title'          => url_title($title) ,
            'short_description'  => $this->faker->paragraph(2) ,
            'description'        => $this->faker->paragraph(3) ,
            'post_date'          => Carbon::today()->toDateString() ,
            'user_ip'            => ip2long($this->faker->ipv4),
            'user_id'            => $this->faker->randomElement($user_ids)
        ];
    }
}
