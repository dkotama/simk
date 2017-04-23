<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsReviewersTable extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions_reviewers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('submission_id');
            $table->integer('user_id');
            $table->tinyInteger('score_a')->nullable();
            $table->tinyInteger('score_b')->nullable();
            $table->tinyInteger('score_c')->nullable();
            $table->tinyInteger('score_d')->nullable();
            $table->tinyInteger('score_e')->nullable();
            $table->tinyInteger('score_f')->nullable();
            $table->string('comments')->nullable();
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
        Schema::drop('submissions_reviewers');
    }
}
