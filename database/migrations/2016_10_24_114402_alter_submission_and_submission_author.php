<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSubmissionAndSubmissionAuthor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('title');
            $table->text('abstract');
            $table->text('keywords');
            $table->tinyInteger('active_version');
        });

        Schema::table('submissions_authors', function (Blueprint $table) {
            $table->boolean('is_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('abstract');
            $table->dropColumn('keywords');
            $table->dropColumn('active_version');
        });

        Schema::table('submissions_authors', function (Blueprint $table) {
            $table->dropColumn('is_primary');
        });
        //
    }
}
