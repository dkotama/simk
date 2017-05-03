<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConferencesDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferences_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conference_id');
            $table->date('submission_deadline');
            $table->date('acceptance');
            $table->date('camera_ready');
            $table->date('registration');
            $table->date('start_conference');
            $table->date('end_conference');
            $table->boolean('is_visible')->default(true);
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
        Schema::drop('conferences_dates');
    }
}
