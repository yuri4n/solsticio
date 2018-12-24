<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            
            $table->string('title', 128);
            $table->string('slug', 128)->unique();
            $table->mediumText('excerpt')-nullable();            
            $table->text('body');
            $table->string('file', 128)->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default(['DRAFT']);
            
            $table->timestamps();

            //Relation
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
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
        Schema::dropIfExists('posts');
    }
}
