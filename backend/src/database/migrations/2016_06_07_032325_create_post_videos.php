<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_videos', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');

            $table->bigInteger('video_website_id')->unsigned();
            $table->foreign('video_website_id')->references('id')->on('video_websites');


            $table->bigInteger('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            $table->string('title', 300);
            $table->text('description')->nullable();
            $table->string('reference', 60);

            /* user create  information */
            $table->bigInteger('user_ip');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user_admins');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_videos', function(Blueprint $table){
            $table->dropForeign('post_videos_post_id_foreign');
            $table->dropForeign('post_videos_video_website_id_foreign');
            $table->dropForeign('post_videos_user_id_foreign');
        });

        Schema::dropIfExists('post_videos');
    }
}
