<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('post_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');

            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('post_types');

            $table->string('title', 255)->unique();
            $table->string('url_title', 255)->unique();

            $table->bigInteger('user_ip');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user_admins');

            $table->unique(['type_id','title']);

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


        Schema::table('post_categories', function(Blueprint $table){
            $table->dropForeign('post_categories_user_id_foreign');
            $table->dropForeign('post_categories_type_id_foreign');
        });

        Schema::drop('post_categories');
    }
}
