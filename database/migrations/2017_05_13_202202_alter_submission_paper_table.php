<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSubmissionPaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submissions_papers', function (Blueprint $table) {
          $table->string('blind_version');
          $table->boolean('is_camera_ready');
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
          $table->dropColumn(['blind_version', 'is_camera_ready']);
        });
    }
}
