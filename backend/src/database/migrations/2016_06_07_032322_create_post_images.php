<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_images', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');

            $table->bigInteger('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');


            $table->string('image', 60);
            $table->string('title', 255)->nullable();


            $table->enum('position', ['left' , 'right' , 'center'])->nullable()->default(null);
            $table->enum('type', ['display', 'detail'])->default('detail');

            $table->bigInteger('user_ip');

            $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
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
        Schema::table('post_images', function(Blueprint $table){
            $table->dropForeign('post_images_post_id_foreign');
            $table->dropForeign('post_images_user_id_foreign');
        });

        Schema::dropIfExists('post_un_images');
    }
}
