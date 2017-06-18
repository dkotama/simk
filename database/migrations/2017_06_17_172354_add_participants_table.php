<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->integer('conference_id');
            $table->integer('user_id');
        });

        Schema::create('user_participant_proofs', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('user_id');
            $table->integer('conference_id');
            $table->string('payment_proof');
            $table->string('payment_notes');
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
        Schema::drop('participants');
        Schema::drop('user_participant_proofs');
    }
}
