<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('title', 80);
            $table->string('author');
            $table->text('content');
            $table->string('board');
            $table->string('file')->nullable();
            $table->integer('views_number')->default(0);
            $table->integer('replies_number')->default(0);
            $table->integer('like_number')->default(0);
            $table->timestamps();
            $table->foreign('author')->references('name')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
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
