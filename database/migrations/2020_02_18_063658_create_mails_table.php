<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 80);
            $table->text('content');
            $table->string('sender');
            $table->string('reciever');
            $table->boolean('read_check')->default(0);
            $table->boolean('sender_delete')->default(0);
            $table->boolean('reciever_delete')->default(0);
            $table->timestamps();

            $table->foreign('sender')->references('name')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('reciever')->references('name')->on('users')
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
        Schema::dropIfExists('mails');
    }
}
