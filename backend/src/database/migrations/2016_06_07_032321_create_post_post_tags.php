<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostPostTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_post_tags', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigInteger('post_id')->unsigned()->index();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            $table->bigInteger('post_tag_id')->unsigned()->index();
            $table->foreign('post_tag_id')->references('id')->on('post_tags')->onDelete('cascade');

            $table->unique(['post_id','post_tag_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_post_tags', function(Blueprint $table){
            $table->dropForeign('post_post_tags_post_id_foreign');
            $table->dropForeign('post_post_tags_post_tag_id_foreign');
        });


        Schema::drop('post_post_tags');
    }
}
