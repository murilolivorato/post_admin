<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostGlImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_gl_images', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');

            $table->bigInteger('gallery_id')->unsigned();
            $table->foreign('gallery_id')->references('id')->on('post_image_galleries')->onDelete('cascade');


            $table->string('image', 255);
            $table->string('title', 255);
            $table->smallInteger('order')->nullable();

            $table->bigInteger('user_ip');

            $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('user_admins');

            $table->timestamps();

            $table->unique(['image','gallery_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_gl_images', function(Blueprint $table){
            $table->dropForeign('post_gl_images_gallery_id_foreign');
            $table->dropForeign('post_gl_images_user_id_foreign');

        });

        Schema::dropIfExists('post_gl_images');
    }
}
