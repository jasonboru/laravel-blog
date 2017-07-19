<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvatarToWeeksComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('weekcomments', function (Blueprint $table) {
          $table->string('avatar')->default('default.jpg');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('weekcomments', function (Blueprint $table) {
          $table->string('avatar')->default('default.jpg');
      });
    }
}
