<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableToSampleProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function ($table) {
        $table->renameColumn('title', 'salutation');
        $table->string('country');
        $table->string('status');
        $table->string('address');
        $table->string('phone');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function ($table) {
        $table->renameColumn('salutation', 'title');
        $table->dropColumn(['country', 'status', 'address', 'phone']);
      });
    }
}
