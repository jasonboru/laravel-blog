<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('posts', function($table){
        $table->string('method');
        $table->string('location');
        $table->string('lighting');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('posts', function($table){
        $table->dropColumn('method');
        $table->dropColumn('location');
        $table->dropColumn('lighting');
      });
    }
}
