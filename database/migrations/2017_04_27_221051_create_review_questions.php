<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conference_id');
            $table->string('topic_a')->default('Abstract');
            $table->string('question_a')->default('Abstracts compiled reflects the results of the study (abstrak yang disusun mencerminkan hasil penelitian)?');
            $table->string('topic_b')->default('Title');
            $table->string('question_b')->default('The title of the paper included in the theme of the seminar (Judul paper termasuk dalam tema seminar) ?');
            $table->string('topic_c')->default('Novelty');
            $table->string('question_c')->default('The novelty of the content of paper (Kebaruan dari isi paper) ?');
            $table->string('topic_d')->default('Language');
            $table->string('question_d')->default('The presentation language easily understood (Bahasa penyajian mudah dipahami) ?');
            $table->string('topic_e')->default('Eligibility');
            $table->string('question_e')->default(' This paper is eligible to present in the seminar (paper ini layak diikutkan dalam seminar) ?');
            $table->string('recommendation')->default('Recommendation (Rekomendasi)');
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
        Schema::drop('review_questions');
    }
}
