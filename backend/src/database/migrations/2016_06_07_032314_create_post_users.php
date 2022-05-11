<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');

            $table->string('title', 255)->unique();
            $table->string('url_title', 255)->unique();

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

        Schema::table('post_users', function(Blueprint $table){
            $table->dropForeign('post_users_user_id_foreign');
        });

        Schema::drop('post_users');

    }
}
