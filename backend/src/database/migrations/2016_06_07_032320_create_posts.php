<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');

            $table->enum('status', ['active', 'no_active'])->default('active');

            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('post_types');

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('post_categories');

            $table->bigInteger('post_user_id')->unsigned();
            $table->foreign('post_user_id')->references('id')->on('post_users');

            $table->string('title', 255)->unique();
            $table->string('url_title')->unique();

            $table->string('sub_title', 255)->nullable();

            $table->mediumText('short_description')->nullable();
            $table->text('description');
            $table->text('key_words')->nullable();

            $table->string('folder' , '60')->unique();

            $table->date('post_date');

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

        Schema::table('posts', function(Blueprint $table){
            $table->dropForeign('posts_type_id_foreign');
            $table->dropForeign('posts_category_id_foreign');
            $table->dropForeign('posts_post_user_id_foreign');
            $table->dropForeign('posts_user_id_foreign');

        });

        Schema::drop('posts');


    }
}
