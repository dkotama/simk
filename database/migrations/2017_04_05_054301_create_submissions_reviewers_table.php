<?php

/*
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsReviewersTable extends Migration
{
    public function up()
    {
        Schema::create('submissions_reviewers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paper_id');
            $table->integer('user_id');
            $table->integer('review_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('submissions_reviewers');
    }
}
*/
