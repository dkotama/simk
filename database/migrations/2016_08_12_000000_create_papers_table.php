<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('papers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('conference_id');
            $table->integer('payment_id');
            $table->string('title');
            $table->string('description');
            $table->string('file_path');
            $table->boolean('approved')->default(false);
            $table->rememberToken();
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
        Schema::drop('papers');
    }
}
