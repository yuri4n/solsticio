<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('role_id');

            $table->string('name');
            $table->string('username', 128)->unique()->nullable();
            $table->string('email', 128)->unique();
            $table->string('password');
            $table->string('profile_img', 128)->nullable();
            $table->rememberToken();
            $table->timestamps();

            //Relation
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
