<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSubmissionsPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submissions_papers', function (Blueprint $table) {
          $table->string('status');
          $table->datetime('checked');
          $table->float('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submissions_papers', function (Blueprint $table) {
          $table->dropColumn(['status', 'checked', 'score']);
        });
    }
}
