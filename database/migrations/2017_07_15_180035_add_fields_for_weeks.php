<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForWeeks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('weeks', function($table){
        $table->string('additives');
        $table->string('tds');
        $table->string('ph');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('weeks', function($table){
        $table->dropColumn('additives');
        $table->dropColumn('tds');
        $table->dropColumn('ph');
      });
    }
}
